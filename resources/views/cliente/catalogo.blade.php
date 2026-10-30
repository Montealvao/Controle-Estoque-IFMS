@extends('layouts.portal')
@section('titulo', 'Catálogo')
@section('conteudo')
<h1 class="h3 mb-3">Catálogo de produtos</h1>
<div class="card card-body mb-4"><div class="row g-3">
  <div class="col-md-5"><label class="form-label" for="q">Buscar</label><input id="q" class="form-control" placeholder="Nome do produto"></div>
  <div class="col-md-4"><label class="form-label" for="tp">Categoria</label><select id="tp" class="form-select"><option>Todas</option>@foreach(config('demo.categorias_nomes') as $t)<option>{{ $t }}</option>@endforeach</select></div>
  <div class="col-md-3"><label class="form-label" for="od">Ordenar por</label><select id="od" class="form-select"><option>Nome</option><option>Menor preço</option><option>Maior preço</option></select></div>
</div></div>
<div class="row g-4">
@foreach(config('demo.produtos') as $p)
  <div class="col-sm-6 col-xl-3"><div class="card h-100">
    <div class="foto"><i class="bi bi-box-seam"></i></div>
    <div class="card-body"><span class="badge text-bg-light border">{{ $p['categoria'] }}</span><h2 class="h6 mt-2">{{ $p['descricao'] }}</h2><p class="fs-5 fw-bold mb-1">{{ $p['valor_venda'] }}</p><small class="text-muted">{{ $p['qtde_estoque'] > 0 ? 'Em estoque' : 'Indisponível' }}</small></div>
    <div class="card-footer bg-white"><a class="btn btn-outline-success w-100" href="{{ url('/cliente/produtos/'.$p['id']) }}">Ver detalhes</a></div>
  </div></div>
@endforeach
</div>
@endsection
