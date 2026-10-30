<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo') · Estoque IFMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('ui.css') }}" rel="stylesheet">
</head>
<body>
@php($menu = config('demo.menus')[$perfil ?? 'entrada'] ?? [])
<nav class="navbar topo navbar-dark px-3" style="height:56px">
  @if($menu)<button class="btn btn-outline-light d-lg-none me-2" data-bs-toggle="collapse" data-bs-target="#menu" aria-label="Abrir menu"><i class="bi bi-list"></i></button>@endif
  <a class="navbar-brand" href="{{ url('/telas') }}"><i class="bi bi-boxes"></i> Estoque IFMS</a>
  <div class="dropdown ms-auto">
    <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i> Perfil: {{ ['cliente'=>'Cliente','loja'=>'Loja (Admin)','fornecedor'=>'Fornecedor'][$perfil ?? ''] ?? 'Selecionar' }}</button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="{{ url('/cliente') }}">Cliente</a></li>
      <li><a class="dropdown-item" href="{{ url('/loja') }}">Loja (Administrador)</a></li>
      <li><a class="dropdown-item" href="{{ url('/fornecedor') }}">Fornecedor</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="{{ url('/') }}"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
    </ul>
  </div>
</nav>
<div class="d-flex flex-column flex-lg-row">
  @if($menu)
  <aside class="lateral collapse d-lg-block" id="menu">
    @foreach($menu as [$rotulo, $u, $ico])
      @php($p = trim($u, '/'))
      @php($ativo = count(explode('/', $p)) == 1 ? request()->is($p) : request()->is($p, $p.'/*'))
      <a href="{{ url($u) }}" class="{{ $ativo ? 'ativo' : '' }}"><i class="bi {{ $ico }} me-2"></i>{{ $rotulo }}</a>
    @endforeach
  </aside>
  @endif
  <main class="flex-grow-1 p-3 p-lg-4">@yield('conteudo')</main>
</div>
<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="tExcluir" aria-hidden="true"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h2 class="modal-title fs-5" id="tExcluir">Confirmar exclusão</h2><button class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button></div>
  <div class="modal-body">Deseja excluir <strong id="nomeExcluir"></strong>? (Simulação: nada será apagado.)</div>
  <div class="modal-footer"><button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button><button class="btn btn-danger" data-bs-dismiss="modal" data-demo="Registro excluído (simulação).">Excluir</button></div>
</div></div></div>
<div class="toast-container position-fixed bottom-0 end-0 p-3" id="toasts"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/ui.js') }}"></script>
@stack('js')
</body>
</html>
