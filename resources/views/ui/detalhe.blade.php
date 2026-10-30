@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
<h1 class="h3 mb-3">{{ $titulo }} · #{{ $r['id'] }}</h1>
<div class="card"><div class="card-body">
  <dl class="row mb-0">
    @foreach($cols as $k => $l)
      <dt class="col-sm-3">{{ $l }}</dt><dd class="col-sm-9">@if($k === 'estado')<x-estado :v="$r[$k]" />@else{{ $r[$k] }}@endif</dd>
    @endforeach
  </dl>
</div>
<div class="card-footer bg-white d-flex flex-wrap gap-2">
  <a class="btn btn-outline-secondary" href="{{ url($base) }}"><i class="bi bi-arrow-left"></i> Voltar</a>
  @foreach($acoes as [$rot, $cls, $msg])<button class="btn btn-{{ $cls }}" data-demo="{{ $msg }}">{{ $rot }}</button>@endforeach
  @if($editar)
    <a class="btn btn-success" href="{{ url($base.'/'.$r['id'].'/editar') }}">Editar</a>
    <button class="btn btn-outline-danger" data-excluir="{{ $r['nome'] ?? $r['descricao'] ?? '#'.$r['id'] }}">Excluir</button>
  @endif
</div></div>
@endsection
