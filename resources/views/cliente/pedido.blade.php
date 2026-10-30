@extends('layouts.portal')
@section('titulo', $modo === 'compra' ? 'Compra direta' : 'Solicitação de orçamento')
@section('conteudo')
@php($compra = $modo === 'compra')
<h1 class="h3">{{ $compra ? 'Compra direta' : 'Solicitação de orçamento de venda' }}</h1>
<ol class="passos"><li data-p="1" class="ativo">1 Itens de venda</li><li data-p="2">2 {{ $compra ? 'Pagamento e conferência' : 'Forma de pagamento e observações' }}</li><li data-p="3">3 Confirmação</li></ol>
<div class="card mb-3" data-passo="1">
  <div class="card-header bg-white d-flex justify-content-between align-items-center"><strong>Itens</strong><button type="button" class="btn btn-sm btn-outline-success" id="add"><i class="bi bi-plus"></i> Adicionar item</button></div>
  <x-itens-tabela modo="venda" />
  <div class="card-footer bg-white d-flex justify-content-between align-items-center"><span class="fs-5">Valor: <strong id="total"></strong></span><span><a class="btn btn-outline-secondary" href="{{ url('/cliente') }}">Voltar ao catálogo</a> <button type="button" class="btn btn-success" data-ir="2">Continuar</button></span></div>
</div>
<div class="card card-body" data-passo="2" hidden>
  <h2 class="h5">Conferir itens</h2><ul id="resumo"></ul>
  <div class="row g-3 mb-3">
    <div class="col-md-6"><label class="form-label" for="pg">{{ $compra ? 'Forma de pagamento' : 'Forma de pagamento desejada' }}</label><select id="pg" class="form-select">@foreach(config('demo.formas_pagamento') as $i => $f)<option value="{{ $i }}">{{ $f['descricao'] }}</option>@endforeach</select></div>
    @if($compra)<div class="col-md-6"><label class="form-label" for="en">Endereço de entrega</label><input id="en" class="form-control" value="Rua das Palmeiras, 100 - Campo Grande/MS"></div>
    @else<div class="col-12"><label class="form-label" for="ob">Observações para a loja</label><textarea id="ob" class="form-control" rows="2"></textarea></div>@endif
  </div>
  <p class="mb-1"><strong>{{ $compra ? 'Parcelas (contas a receber)' : 'Parcelas previstas, se aprovado' }}:</strong></p>
  <table class="table table-sm"><thead><tr><th>Parcela</th><th>Data de vencimento</th><th>Porcentagem</th><th>Valor</th></tr></thead><tbody id="parc"></tbody></table>
  <div class="d-flex gap-2"><button class="btn btn-outline-secondary" data-ir="1">Voltar</button><button class="btn btn-success" data-ir="3">{{ $compra ? 'Confirmar compra' : 'Enviar solicitação' }}</button></div>
</div>
<div class="card card-body text-center py-5" data-passo="3" hidden>
  <i class="bi bi-check-circle-fill text-success display-3"></i>
  <h2 class="h4 mt-2">{{ $compra ? 'Compra registrada (simulação)' : 'Solicitação enviada (simulação)' }}</h2>
  <p class="text-muted">Documento PV-1050 · Estado: <x-estado v="Pendente" />{{ $compra ? '' : ' · a loja avaliará os itens' }}</p>
  <div><a class="btn btn-success" href="{{ url('/cliente/solicitacoes') }}">Ver minhas solicitações</a></div>
</div>
@push('js')
<script src="{{ asset('js/itens.js') }}"></script>
<script>
const F = @json(config('demo.formas_pagamento')); let TOT = 0;
const T = itensTabela(document.getElementById('itens'), @json(config('demo.produtos')), 'venda', @json($ini), (it, tot) => { TOT = tot; document.getElementById('total').textContent = brl(tot); parc(it); });
function parc(it) {
  document.getElementById('parc').innerHTML = parcelasHtml(F, document.getElementById('pg').value, '2026-10-28', TOT);
  document.getElementById('resumo').innerHTML = (it || T.ler()).map(x => '<li>' + x.q + ' × ' + x.p.descricao + ' — ' + brl(x.q * x.u) + '</li>').join('');
}
document.getElementById('add').onclick = T.add; document.getElementById('pg').onchange = () => parc();
document.querySelectorAll('[data-ir]').forEach(b => b.onclick = () => {
  const n = b.dataset.ir;
  document.querySelectorAll('[data-passo]').forEach(s => s.hidden = s.dataset.passo !== n);
  document.querySelectorAll('.passos li').forEach(l => l.classList.toggle('ativo', +l.dataset.p <= +n));
});
</script>
@endpush
@endsection
