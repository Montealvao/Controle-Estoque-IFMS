@extends('layouts.portal')
@section('titulo', 'Início')
@section('conteudo')
<div class="container py-4" style="max-width:960px">
  <h1 class="h2">Controle de Estoque IFMS</h1>
  <p class="text-muted">Protótipo visual com dados fictícios. Escolha um perfil para navegar pelas telas.</p>
  <div class="row g-4">
    @foreach([['Cliente','/cliente','bi-shop','Catálogo, compra direta, orçamento de venda e acompanhamento.'],['Loja (Administrador)','/loja','bi-speedometer2','Cadastros, vendas, orçamentos de compra e análise de propostas.'],['Fornecedor','/fornecedor','bi-truck','Produtos próprios, solicitações recebidas e envio de propostas.']] as [$t,$u,$i,$d])
    <div class="col-md-4"><a class="card h-100 text-decoration-none text-reset" href="{{ url($u) }}"><div class="card-body"><i class="bi {{ $i }} fs-1 text-success"></i><h2 class="h5 mt-2">{{ $t }}</h2><p class="text-muted mb-0">{{ $d }}</p></div></a></div>
    @endforeach
  </div>
</div>
@endsection
