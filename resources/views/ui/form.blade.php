@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
<h1 class="h3 mb-3">{{ $titulo }}</h1>
<form class="card card-body" novalidate data-demo="{{ $msg ?? 'Registro salvo (simulação).' }}" data-vai="{{ url($base) }}">
  <div class="row g-3">
  @foreach($campos as $c)
    @php($req = $c[4] ?? true)
    @php($val = $r[$c[0]] ?? '')
    <div class="{{ in_array($c[2], ['textarea','checks']) ? 'col-12' : 'col-md-6' }}">
      <label class="form-label" for="f_{{ $c[0] }}">{{ $c[1] }}@if($req) <span class="text-danger">*</span>@endif</label>
      @if($c[2] === 'select')
        <select class="form-select" id="f_{{ $c[0] }}" @required($req)>@foreach($c[3] as $o)<option @selected($val === $o)>{{ $o }}</option>@endforeach</select>
      @elseif($c[2] === 'checks')
        <div>@foreach($c[3] as $o)<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="f_{{ $c[0] }}_{{ $loop->index }}" @checked(str_contains($val, $o))><label class="form-check-label" for="f_{{ $c[0] }}_{{ $loop->index }}">{{ $o }}</label></div>@endforeach</div>
      @elseif($c[2] === 'textarea')
        <textarea class="form-control" id="f_{{ $c[0] }}" rows="3" @required($req)>{{ $val }}</textarea>
      @else
        <input type="{{ $c[2] }}" class="form-control" id="f_{{ $c[0] }}" value="{{ $val }}" @required($req)>
      @endif
      <div class="invalid-feedback">Campo obrigatório.</div>
    </div>
  @endforeach
  </div>
  <div class="mt-4 d-flex gap-2"><button class="btn btn-success">Salvar</button><a class="btn btn-outline-secondary" href="{{ url($base) }}">Cancelar</a></div>
</form>
@endsection
