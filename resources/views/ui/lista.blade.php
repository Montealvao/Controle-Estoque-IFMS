@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">{{ $titulo }}</h1>
  @if($novo)<a class="btn btn-success" href="{{ url($novo) }}"><i class="bi bi-plus-lg"></i> Novo</a>@endif
</div>
<div class="card"><div class="card-body">
  <div class="row g-2 mb-3">
    <div class="col-md-6"><input class="form-control" placeholder="Pesquisar" aria-label="Pesquisar"></div>
    <div class="col-md-3"><select class="form-select" aria-label="Filtrar por estado"><option>Todos os estados</option><option>Pendente / Em aberto</option><option>Aprovada / Pago</option><option>Recusada / Vencida</option></select></div>
  </div>
  <div class="table-responsive"><table class="table align-middle">
    <thead><tr>@foreach($cols as $l)<th>{{ $l }}</th>@endforeach<th><span class="visually-hidden">Ações</span></th></tr></thead>
    <tbody>
    @forelse($rows as $r)
      <tr>
        @foreach($cols as $k => $l)<td>@if($k === 'estado')<x-estado :v="$r[$k]" />@else{{ $r[$k] }}@endif</td>@endforeach
        <td class="text-end text-nowrap">
          <a class="btn btn-sm btn-outline-secondary" href="{{ url($base.'/'.$r['id']) }}" aria-label="Ver"><i class="bi bi-eye"></i></a>
          @if($editar)
          <a class="btn btn-sm btn-outline-success" href="{{ url($base.'/'.$r['id'].'/editar') }}" aria-label="Editar"><i class="bi bi-pencil"></i></a>
          <button class="btn btn-sm btn-outline-danger" data-excluir="{{ $r['nome'] ?? $r['descricao'] ?? '#'.$r['id'] }}" aria-label="Excluir"><i class="bi bi-trash"></i></button>
          @endif
        </td>
      </tr>
    @empty
      <tr><td colspan="{{ count($cols) + 1 }}" class="text-center text-muted py-5"><i class="bi bi-inbox fs-1 d-block"></i>Nenhum registro encontrado.</td></tr>
    @endforelse
    </tbody></table></div>
  <nav aria-label="Paginação"><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><span class="page-link">Anterior</span></li><li class="page-item active"><span class="page-link">1</span></li><li class="page-item"><a class="page-link" href="#" data-demo="Paginação demonstrativa.">2</a></li><li class="page-item"><a class="page-link" href="#" data-demo="Paginação demonstrativa.">Próxima</a></li></ul></nav>
</div></div>
@endsection
