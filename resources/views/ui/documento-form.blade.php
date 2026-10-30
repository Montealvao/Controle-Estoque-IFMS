@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
@php($compra = $modo === 'compra')
<h1 class="h3 mb-3">{{ $titulo }}</h1>
@if($pre ?? null)<div class="alert alert-success"><i class="bi bi-check2-circle"></i> Compra gerada a partir do orçamento <strong>{{ $pre['orc'] }}</strong> (fornecedor, itens, quantidades e valores já preenchidos).</div>@endif
<form novalidate data-demo="{{ $compra ? 'Compra registrada; contas a pagar geradas e valores de compra atualizados (simulação).' : 'Venda registrada; contas a receber geradas (simulação).' }}" data-vai="{{ url($base) }}">
  <div class="card card-body mb-3"><div class="row g-3">
    <div class="col-md-4"><label class="form-label" for="parte">{{ $compra ? 'Fornecedor' : 'Cliente' }} *</label>
      <select id="parte" class="form-select" required>@foreach(config('demo.'.($compra ? 'fornecedores' : 'clientes')) as $x)<option @selected(($pre['parte'] ?? '') === $x['nome'])>{{ $x['nome'] }}</option>@endforeach</select></div>
    <div class="col-md-3"><x-campo id="documento" label="Documento" value="{{ $compra ? 'NF 8900' : 'PV-1050' }}" /></div>
    <div class="col-md-2"><x-campo id="data" label="Data" type="date" value="2026-10-28" /></div>
    <div class="col-md-3"><label class="form-label" for="forma">Forma de pagamento *</label>
      <select id="forma" class="form-select">@foreach(config('demo.formas_pagamento') as $i => $f)<option value="{{ $i }}">{{ $f['descricao'] }}</option>@endforeach</select></div>
  </div></div>
  <div class="card mb-3"><div class="card-header bg-white d-flex justify-content-between"><strong>Itens {{ $compra ? 'de compra' : 'de venda' }}</strong><button type="button" class="btn btn-sm btn-outline-success" id="add"><i class="bi bi-plus"></i> Adicionar item</button></div>
    <x-itens-tabela :modo="$modo" />
    <div class="card-footer bg-white text-end fs-5">Valor {{ $compra ? 'da compra' : 'da venda' }}: <strong id="total"></strong></div></div>
  @if($compra)
  <div class="card mb-3"><div class="card-header bg-white"><strong>Atualização do valor de compra</strong> <span class="text-muted">(média aritmética entre o valor atual e o da compra)</span></div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Produto</th><th>Valor atual</th><th>Valor desta compra</th><th>Novo valor de compra</th><th>Novo valor de venda (margem da categoria)</th></tr></thead><tbody id="media"></tbody></table></div></div>
  @else
  <div class="alert alert-info"><i class="bi bi-info-circle"></i> O valor de venda segue a margem de lucro da categoria do produto e não é editável.</div>
  @endif
  <div class="card mb-3"><div class="card-header bg-white"><strong>{{ $compra ? 'Contas a pagar' : 'Contas a receber' }} geradas pela forma de pagamento</strong></div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Parcela</th><th>Data de vencimento</th><th>Porcentagem</th><th>Valor</th></tr></thead><tbody id="parc"></tbody></table></div></div>
  <button class="btn btn-success">Registrar {{ $compra ? 'compra' : 'venda' }}</button> <a class="btn btn-outline-secondary" href="{{ url($base) }}">Cancelar</a>
</form>
@push('js')
<script src="{{ asset('js/itens.js') }}"></script>
<script>
const modo = '{{ $modo }}', P = @json(config('demo.produtos')), F = @json(config('demo.formas_pagamento')), PRE = @json($pre ?? null);
const T = itensTabela(document.getElementById('itens'), P, modo, PRE ? PRE.itens : null, (it, tot) => {
  document.getElementById('total').textContent = brl(tot);
  if (modo === 'compra') document.getElementById('media').innerHTML = it.map(x => { const nv = (x.p.compra_n + x.u) / 2; return '<tr><td>' + x.p.descricao + '</td><td>' + brl(x.p.compra_n) + '</td><td>' + brl(x.u) + '</td><td>' + brl(nv) + '</td><td>' + brl(nv * (1 + x.p.margem / 100)) + '</td></tr>'; }).join('');
  document.getElementById('parc').innerHTML = parcelasHtml(F, document.getElementById('forma').value, document.getElementById('data').value, tot);
});
document.getElementById('add').onclick = T.add;
document.getElementById('forma').onchange = document.getElementById('data').oninput = T.recalc;
</script>
@endpush
@endsection
