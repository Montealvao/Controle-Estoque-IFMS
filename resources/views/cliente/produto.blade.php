@extends('layouts.portal')
@section('titulo', $p['descricao'])
@section('conteudo')
<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ url('/cliente') }}">Catálogo</a></li><li class="breadcrumb-item active">{{ $p['descricao'] }}</li></ol></nav>
<div class="row g-4">
  <div class="col-md-6"><div class="foto rounded" style="height:380px;font-size:5rem"><i class="bi bi-box-seam"></i></div></div>
  <div class="col-md-6"><div class="card card-body">
    <span class="badge text-bg-light border align-self-start">{{ $p['categoria'] }}</span>
    <h1 class="h3 mt-2">{{ $p['descricao'] }}</h1>
    <p class="fs-3 fw-bold mb-1">{{ $p['valor_venda'] }}</p>
    <p class="text-muted">Embalagem: {{ $p['embalagem'] }} · Código de barras: {{ $p['codigo_barra'] }} · {{ $p['qtde_estoque'] > 0 ? $p['qtde_estoque'].' un em estoque' : 'Indisponível' }}</p>
    <label class="form-label" for="qt">Quantidade</label><input id="qt" type="number" min="1" value="1" class="form-control mb-3" style="max-width:160px">
    <div class="d-flex flex-wrap gap-2">
      <a class="btn btn-success" href="{{ url('/cliente/compra/'.$p['id']) }}"><i class="bi bi-bag-check"></i> Comprar agora</a>
      <a class="btn btn-outline-success" href="{{ url('/cliente/orcamento/'.$p['id']) }}"><i class="bi bi-chat-left-text"></i> Solicitar orçamento</a>
    </div>
    <p class="small text-muted mt-3 mb-0">Compra direta: escolha a forma de pagamento e confirme. Orçamento: a loja avalia e responde com valores.</p>
  </div></div>
</div>
@endsection
