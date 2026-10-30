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
<div class="container min-vh-100 d-flex align-items-center py-4">
  <div class="row w-100 g-0 shadow rounded overflow-hidden mx-auto bg-white" style="max-width:960px">
    <div class="col-lg-5 d-none d-lg-flex flex-column justify-content-center p-5 text-white" style="background:#14213d">
      <i class="bi bi-boxes display-4"></i><h1 class="h3 mt-3">Estoque IFMS</h1>
      <p class="mb-0">Controle de produtos, fornecedores, compras, vendas e orçamentos.</p>
    </div>
    <div class="col-lg-7 p-4 p-md-5">@yield('conteudo')</div>
  </div>
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3" id="toasts"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/ui.js') }}"></script>
@stack('js')
</body>
</html>
