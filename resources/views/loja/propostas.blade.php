@extends('layouts.portal')
@section('titulo', 'Propostas do orçamento')
@section('conteudo')
@php($min = collect(config('demo.propostas'))->where('estado', '!=', 'Recusada')->min('num'))
<h1 class="h3">Orçamento de compra #{{ $r['id'] }}</h1>
<div class="card card-body mb-4"><div class="row">
  <div class="col-md-3"><small class="text-muted">Produto</small><div>{{ $r['produto'] }}</div></div>
  <div class="col-md-2"><small class="text-muted">Quantidade</small><div>{{ $r['qtd'] }}</div></div>
  <div class="col-md-3"><small class="text-muted">Tipo / fornecedores consultados</small><div>{{ $r['tipo'] }} · {{ $r['fornecedores'] }}</div></div>
  <div class="col-md-4"><small class="text-muted">Estado</small><div><x-estado :v="$r['estado']" /></div></div>
</div></div>
<div class="card"><div class="card-header bg-white"><strong>Comparação de propostas</strong></div>
<div class="table-responsive"><table class="table align-middle mb-0">
  <thead><tr><th>Fornecedor</th><th>Preço unit.</th><th>Total</th><th>Prazo</th><th>Estado</th><th>Decisão</th></tr></thead>
  <tbody>
  @foreach(config('demo.propostas') as $p)
    <tr class="{{ $p['num'] == $min ? 'menor' : '' }}">
      <td>{{ $p['fornecedor'] }} @if($p['num'] == $min)<span class="badge text-bg-success">Menor preço</span>@endif</td>
      <td>{{ $p['preco'] }}</td><td>{{ $p['total'] }}</td><td>{{ $p['prazo'] }}</td><td><x-estado :v="$p['estado']" /></td>
      <td class="text-nowrap">@if($p['estado'] === 'Recusada')<span class="text-muted">Decidido</span>@else
        <button class="btn btn-sm btn-success" data-demo="Proposta de {{ $p['fornecedor'] }} aprovada; compra gerada (simulação).">Aprovar</button>
        <button class="btn btn-sm btn-outline-danger" data-demo="Proposta recusada (simulação).">Recusar</button>@endif</td>
    </tr>
  @endforeach
  </tbody></table></div>
<div class="card-footer bg-white"><a class="btn btn-outline-secondary" href="{{ url('/loja/orcamentos') }}">Voltar</a> <a class="btn btn-outline-success" href="{{ url('/loja/compras') }}">Ver compras</a></div></div>
@endsection
