@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
@php($compra = $modo === 'compra')
<h1 class="h3 mb-3">{{ $compra ? 'Compra' : 'Venda' }} · {{ $r['documento'] }}</h1>
<div class="card card-body mb-3"><dl class="row mb-0">
  <dt class="col-sm-3">{{ $compra ? 'Fornecedor' : 'Cliente' }}</dt><dd class="col-sm-9">{{ $r[$compra ? 'fornecedor' : 'cliente'] }}</dd>
  @unless($compra)<dt class="col-sm-3">Tipo</dt><dd class="col-sm-9">{{ $r['tipo'] }}</dd><dt class="col-sm-3">Estado</dt><dd class="col-sm-9"><x-estado :v="$r['estado']" /></dd>@endunless
  <dt class="col-sm-3">Data</dt><dd class="col-sm-9">{{ $r['data'] }}</dd>
  <dt class="col-sm-3">Forma de pagamento</dt><dd class="col-sm-9">{{ $r['forma_pagamento'] }}</dd>
  <dt class="col-sm-3">Valor</dt><dd class="col-sm-9 fw-bold">{{ $r['valor'] }}</dd>
</dl></div>
<div class="card mb-3"><div class="card-header bg-white fw-semibold">Itens</div><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Produto</th><th>Quantidade</th><th>Valor unitário</th><th>Valor total</th></tr></thead><tbody>
@foreach($r['itens'] as [$prod, $q, $u, $t])<tr><td>{{ $prod }}</td><td>{{ $q }}</td><td>{{ $u }}</td><td>{{ $t }}</td></tr>@endforeach</tbody></table></div></div>
<div class="card mb-3"><div class="card-header bg-white fw-semibold">{{ $compra ? 'Contas a pagar geradas' : 'Contas a receber geradas' }}</div><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Vencimento</th><th>Valor</th><th>Situação</th></tr></thead><tbody>
@forelse($r['contas'] as [$venc, $val, $est])<tr><td>{{ $venc }}</td><td>{{ $val }}</td><td><x-estado :v="$est" /></td></tr>
@empty<tr><td colspan="3" class="text-center text-muted py-4">As contas são geradas quando a venda é aprovada.</td></tr>@endforelse</tbody></table></div></div>
@if($compra)<div class="alert alert-info"><i class="bi bi-info-circle"></i> Ao registrar a compra, o valor de compra de cada produto foi atualizado pela média aritmética.</div>@endif
<div class="d-flex flex-wrap gap-2"><a class="btn btn-outline-secondary" href="{{ url($base) }}"><i class="bi bi-arrow-left"></i> Voltar</a>@foreach($acoes as [$rot, $cls, $msg])<button class="btn btn-{{ $cls }}" data-demo="{{ $msg }}">{{ $rot }}</button>@endforeach</div>
@endsection
