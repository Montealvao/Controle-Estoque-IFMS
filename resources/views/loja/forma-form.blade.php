@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
<h1 class="h3 mb-3">{{ $titulo }}</h1>
<form id="ff" class="card card-body" novalidate data-demo="Forma de pagamento salva (simulação)." data-vai="{{ url($base) }}">
  <div class="row g-3"><div class="col-md-8"><x-campo id="descricao" label="Descrição" :value="$r['descricao'] ?? ''" /></div>
  <div class="col-md-4"><x-campo id="parcelas" label="Número de parcelas" readonly :value="$r['parcelas'] ?? 1" /></div></div>
  <div class="d-flex justify-content-between align-items-center mb-2"><strong>Itens da forma de pagamento</strong><button type="button" class="btn btn-sm btn-outline-success" id="add"><i class="bi bi-plus"></i> Adicionar item</button></div>
  <table class="table align-middle"><thead><tr><th>Porcentagem (%)</th><th>Dia (vencimento após a data)</th><th></th></tr></thead><tbody id="it"></tbody></table>
  <p>Soma das porcentagens: <span id="soma" class="badge"></span> <span class="text-muted">(deve totalizar 100%)</span></p>
  <div class="d-flex gap-2"><button class="btn btn-success">Salvar</button><a class="btn btn-outline-secondary" href="{{ url($base) }}">Cancelar</a></div>
</form>
@push('js')
<script>
const it = document.getElementById('it');
function add(pc, dia) {
  const tr = document.createElement('tr');
  tr.innerHTML = '<td><input type="number" min="1" max="100" class="form-control pc" value="' + pc + '" aria-label="Porcentagem"></td><td><input type="number" min="0" class="form-control dia" value="' + dia + '" aria-label="Dia"></td><td><button type="button" class="btn btn-sm btn-outline-danger x" aria-label="Remover"><i class="bi bi-x"></i></button></td>';
  it.appendChild(tr); soma();
}
function soma() {
  const s = [...it.querySelectorAll('.pc')].reduce((a, i) => a + (+i.value || 0), 0), b = document.getElementById('soma');
  b.textContent = s + '%'; b.className = 'badge text-bg-' + (s === 100 ? 'success' : 'danger');
  document.getElementById('parcelas').value = it.rows.length; return s;
}
it.addEventListener('input', soma);
it.addEventListener('click', e => { const x = e.target.closest('.x'); if (x && it.rows.length > 1) { x.closest('tr').remove(); soma(); } });
document.getElementById('add').onclick = () => add(0, 30);
document.getElementById('ff').addEventListener('submit', e => { if (soma() !== 100) { e.preventDefault(); e.stopPropagation(); toast('A soma das porcentagens deve ser 100%.', 'danger'); } });
@foreach(($r['itens'] ?? [[100, 0]]) as [$pc, $dia]) add({{ $pc }}, {{ $dia }}); @endforeach
</script>
@endpush
@endsection
