@extends('layouts.portal')
@section('titulo', 'Nova solicitação de orçamento de compra')
@section('conteudo')
<h1 class="h3">Nova solicitação de orçamento de compra</h1>
<ol class="passos"><li class="ativo">1 Itens de compra</li><li class="ativo">2 Fornecedores da categoria de cada item</li><li>3 Enviar</li><li>4 Comparar orçamentos</li></ol>
<form class="row g-4" novalidate data-demo="Solicitação SOL-0015 criada: um orçamento por fornecedor compatível, com os itens das categorias que ele atende (simulação)." data-vai="{{ url('/loja/orcamentos') }}">
  <div class="col-lg-7"><div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center"><strong>Itens da solicitação · SOL-0015 · 28/10/2026</strong><button type="button" class="btn btn-sm btn-outline-success" id="add"><i class="bi bi-plus"></i> Adicionar item</button></div>
    <x-itens-tabela modo="solicitacao" />
    <div class="card-footer bg-white text-muted small">O fornecedor informa o valor unitário de cada item; o valor total é calculado a partir da quantidade solicitada.</div>
  </div></div>
  <div class="col-lg-5"><div class="card card-body">
    <h2 class="h5">Fornecedores compatíveis: <span id="cont"></span></h2>
    <p class="text-muted small">Cada fornecedor recebe um orçamento apenas com os itens das categorias que atende.</p>
    <ul class="list-group mb-3" id="dest"></ul>
    <div class="alert alert-warning" id="sem" hidden></div>
    <button class="btn btn-success">Gerar orçamentos</button>
  </div></div>
</form>
@push('js')
<script src="{{ asset('js/itens.js') }}"></script>
<script>
const FN = @json(config('demo.fornecedores'));
const T = itensTabela(document.getElementById('itens'), @json(config('demo.produtos')), 'solicitacao', null, it => {
  let h = '', n = 0;
  FN.forEach(f => {
    const cats = f.categorias.split(', '), mine = it.filter(x => cats.includes(x.p.categoria));
    if (mine.length) { n++; h += '<li class="list-group-item"><strong>' + f.nome + '</strong> <span class="text-muted">· ' + f.categorias + '</span><br><small>' + mine.map(x => x.q + ' × ' + x.p.descricao).join('; ') + '</small></li>'; }
  });
  document.getElementById('dest').innerHTML = h; document.getElementById('cont').textContent = n + ' de ' + FN.length;
  const sem = it.filter(x => !FN.some(f => f.categorias.split(', ').includes(x.p.categoria))).map(x => x.p.descricao);
  const a = document.getElementById('sem'); a.hidden = !sem.length; a.textContent = 'Nenhum fornecedor atende a categoria de: ' + sem.join(', ');
});
document.getElementById('add').onclick = T.add;
</script>
@endpush
@endsection
