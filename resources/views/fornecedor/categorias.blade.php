@extends('layouts.portal')
@section('titulo', 'Categorias atendidas')
@section('conteudo')
<h1 class="h3">Categorias atendidas</h1>
<p class="text-muted">Você recebe orçamentos de compra apenas dos produtos das categorias marcadas.</p>
<form class="card" data-demo="Categorias atualizadas (simulação).">
  <div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Atendo</th><th>Categoria</th><th>Produtos da loja</th></tr></thead><tbody>
  @foreach(config('demo.categorias') as $c)<tr><td><input class="form-check-input" type="checkbox" id="c{{ $c['id'] }}" @checked($c['descricao'] === 'Fixação') aria-label="Atender {{ $c['descricao'] }}"></td><td><label for="c{{ $c['id'] }}">{{ $c['descricao'] }}</label></td><td>{{ $c['produtos'] }}</td></tr>@endforeach</tbody></table></div>
  <div class="card-footer bg-white"><button class="btn btn-success">Salvar</button></div>
</form>
@endsection
