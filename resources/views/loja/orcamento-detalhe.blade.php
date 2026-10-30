@extends('layouts.portal')
@section('titulo', 'Orçamento de compra')
@section('conteudo')
@php
  $grupo = collect(config('demo.orcamentos'))->where('solicitacao', $r['solicitacao'])->values();
  $prods = $grupo->flatMap(fn ($o) => collect($o['itens'])->pluck(0))->unique()->values();
  $cel = fn ($o, $p) => collect($o['itens'])->first(fn ($i) => $i[0] === $p);
@endphp
<h1 class="h3 mb-3">Orçamento de compra · {{ $r['documento'] }}</h1>
<div class="card card-body mb-3"><dl class="row mb-0">
  <dt class="col-sm-3">Solicitação</dt><dd class="col-sm-9">{{ $r['solicitacao'] }}</dd>
  <dt class="col-sm-3">Fornecedor</dt><dd class="col-sm-9">{{ $r['fornecedor'] }}</dd>
  <dt class="col-sm-3">Data</dt><dd class="col-sm-9">{{ $r['data'] }}</dd>
  <dt class="col-sm-3">Valor total</dt><dd class="col-sm-9 fw-bold">{{ $r['valor'] }}</dd>
  <dt class="col-sm-3">Estado</dt><dd class="col-sm-9"><x-estado :v="$r['estado']" /></dd>
</dl></div>
<div class="card mb-3"><div class="card-header bg-white fw-semibold">Itens de compra do orçamento</div><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Produto</th><th>Quantidade</th><th>Valor unitário</th><th>Valor total</th></tr></thead><tbody>
@foreach($r['itens'] as [$prod, $q, $u, $t])<tr><td>{{ $prod }}</td><td>{{ $q }}</td><td>{{ $u }}</td><td>{{ $t }}</td></tr>@endforeach</tbody></table></div></div>
<div class="card mb-3"><div class="card-header bg-white fw-semibold">Comparação dos orçamentos da solicitação {{ $r['solicitacao'] }} (valor unitário por item)</div><div class="table-responsive"><table class="table align-middle mb-0">
  <thead><tr><th>Produto (quantidade)</th>@foreach($grupo as $o)<th>{{ $o['fornecedor'] }}<br><small class="text-muted fw-normal">{{ $o['documento'] }}</small></th>@endforeach</tr></thead>
  <tbody>
  @foreach($prods as $p)
    @php($vals = $grupo->where('estado', '!=', 'Recusada')->map(fn ($o) => ($cel($o, $p)[4] ?? null))->filter()->values())
    @php($min = $vals->min())
    <tr><td>{{ $p }} <small class="text-muted">({{ $cel($grupo->first(fn ($o) => $cel($o, $p)), $p)[1] }})</small></td>
    @foreach($grupo as $o)
      @php($i = $cel($o, $p))
      <td class="{{ $i && ($i[4] ?? null) !== null && $i[4] == $min && $o['estado'] !== 'Recusada' ? 'menor' : '' }}">{{ $i ? $i[2] : 'não cotado' }}@if($i && ($i[4] ?? null) !== null && $i[4] == $min && $o['estado'] !== 'Recusada' && $vals->count() > 1) <span class="badge text-bg-success">Menor valor</span>@endif</td>
    @endforeach</tr>
  @endforeach
  <tr class="table-light"><th>Valor total do orçamento</th>@foreach($grupo as $o)<th>{{ $o['valor'] }}</th>@endforeach</tr>
  <tr><th>Estado</th>@foreach($grupo as $o)<td><x-estado :v="$o['estado']" /></td>@endforeach</tr>
  </tbody></table></div>
  <div class="card-footer bg-white small text-muted">Cada fornecedor cota apenas os itens das categorias que atende; por isso os totais não cobrem necessariamente os mesmos itens.</div></div>
<div class="d-flex flex-wrap gap-2"><a class="btn btn-outline-secondary" href="{{ url('/loja/orcamentos') }}"><i class="bi bi-arrow-left"></i> Voltar</a>
@if($r['estado'] === 'Em análise')<a class="btn btn-success" href="{{ url('/loja/compras/novo?orcamento='.$r['id']) }}">Aprovar e registrar compra</a><button class="btn btn-outline-danger" data-demo="Orçamento {{ $r['documento'] }} recusado (simulação).">Recusar este orçamento</button>@endif</div>
@endsection
