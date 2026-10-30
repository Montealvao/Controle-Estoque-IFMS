@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
<h1 class="h3 mb-3">{{ $titulo }}</h1>
<div class="row g-3 mb-4">
  @foreach($kpis as [$rot, $val, $ico])
  <div class="col-6 col-xl-3"><div class="card card-body"><i class="bi {{ $ico }} fs-3 text-success"></i><div class="fs-2 fw-bold">{{ $val }}</div><div class="text-muted">{{ $rot }}</div></div></div>
  @endforeach
</div>
<div class="card">
  <div class="card-header bg-white d-flex justify-content-between"><strong>{{ $tabTitulo }}</strong><a href="{{ url($link) }}">Ver todas</a></div>
  <div class="table-responsive"><table class="table mb-0 align-middle">
    <thead><tr>@foreach($cols as $l)<th>{{ $l }}</th>@endforeach<th></th></tr></thead>
    <tbody>@foreach($rows as $r)<tr>@foreach($cols as $k => $l)<td>@if($k === 'estado')<x-estado :v="$r[$k]" />@else{{ $r[$k] }}@endif</td>@endforeach<td class="text-end"><a class="btn btn-sm btn-outline-success" href="{{ url($link.'/'.$r['id']) }}">Abrir</a></td></tr>@endforeach</tbody>
  </table></div>
</div>
@endsection
