@extends('layouts.portal')
@section('titulo', 'Orçamento recebido')
@section('conteudo')
@php($aberto = $r['estado'] === 'Aguardando proposta')
<h1 class="h3 mb-3">Orçamento · {{ $r['documento'] }}</h1>
<div class="card card-body mb-3"><dl class="row mb-0">
  <dt class="col-sm-3">Data</dt><dd class="col-sm-9">{{ $r['data'] }}</dd>
  <dt class="col-sm-3">Itens solicitados</dt><dd class="col-sm-9">{{ count($r['itens']) }} (apenas das categorias que você atende)</dd>
  <dt class="col-sm-3">Estado</dt><dd class="col-sm-9" id="estado"><x-estado :v="$r['estado']" /></dd>
</dl></div>
<form class="card" novalidate>
  <div class="card-header bg-white fw-semibold">{{ $aberto ? 'Informe o valor unitário de cada item' : 'Itens da proposta enviada' }}</div>
  <div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Produto</th><th>Quantidade</th><th style="width:200px">Valor unitário{{ $aberto ? ' (R$) *' : '' }}</th><th>Valor total</th></tr></thead><tbody>
  @foreach($r['itens'] as [$p, $q, $u, $t])
    <tr><td>{{ $p }}</td><td class="q">{{ $q }}</td>
    <td>@if($aberto)<input class="form-control v" placeholder="0,00" required aria-label="Valor unitário de {{ $p }}"><div class="invalid-feedback">Informe o valor.</div>@else{{ $u }}@endif</td>
    <td class="t">{{ $aberto ? '—' : $t }}</td></tr>
  @endforeach</tbody></table></div>
  <div class="card-footer bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
    <span>Valor total do orçamento: <strong id="total">{{ $aberto ? '—' : $r['valor'] }}</strong></span>
    <span><a class="btn btn-outline-secondary" href="{{ url('/fornecedor/orcamentos') }}">Voltar</a>@if($aberto) <button type="button" class="btn btn-success" id="revisar">Revisar e enviar</button>@endif</span>
  </div>
</form>
<div class="modal fade" id="mRev" tabindex="-1" aria-labelledby="tRev" aria-hidden="true"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h2 class="modal-title fs-5" id="tRev">Revisar proposta</h2><button class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button></div>
  <div class="modal-body"><ul id="rvl"></ul><strong id="rv"></strong></div>
  <div class="modal-footer"><button class="btn btn-outline-secondary" data-bs-dismiss="modal">Editar</button><button class="btn btn-success" id="enviar" data-bs-dismiss="modal" data-demo="Proposta enviada à loja (simulação).">Confirmar envio</button></div>
</div></div></div>
@if($aberto)
@push('js')
<script>
const rows = [...document.querySelectorAll('tbody tr')], brl = n => n.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
const val = tr => { let s = tr.querySelector('.v').value.trim(); if (s.includes(',')) s = s.replace(/\./g, '').replace(',', '.'); return parseFloat(s) || 0; };
const calc = () => { let s = 0; rows.forEach(tr => { const t = val(tr) * +tr.querySelector('.q').textContent; s += t; tr.querySelector('.t').textContent = brl(t); }); document.getElementById('total').textContent = brl(s); return s; };
rows.forEach(tr => tr.querySelector('.v').oninput = calc);
document.getElementById('revisar').onclick = () => {
  const f = rows[0].closest('form');
  if (!f.checkValidity()) { f.classList.add('was-validated'); return; }
  document.getElementById('rvl').innerHTML = rows.map(tr => '<li>' + tr.cells[0].textContent + ': ' + tr.querySelector('.q').textContent + ' × ' + brl(val(tr)) + '</li>').join('');
  document.getElementById('rv').textContent = 'Valor total: ' + brl(calc());
  new bootstrap.Modal('#mRev').show();
};
document.getElementById('enviar').onclick = () => { document.getElementById('estado').innerHTML = '<span class="badge text-bg-primary">Em análise</span>'; };
</script>
@endpush
@endif
@endsection
