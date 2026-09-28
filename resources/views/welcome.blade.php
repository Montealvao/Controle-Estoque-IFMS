<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
    </nav>

    {{-- Conteúdo principal --}}
    <main>
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card shadow-sm">
                        <div class="card-body text-center p-5">

                            <h1 class="display-5 fw-bold mb-3">
                                Bem-vindo!
                            </h1>

                            <p class="lead text-muted mb-4">
                                Esta é a página inicial da aplicação.
                            </p>

                            <p class="mb-4">
                                Laravel está funcionando corretamente e esta
                                página está utilizando Blade e Bootstrap.
                            </p>

                            {{-- Botão --}}
                            <a href="/fornecedores" class="btn btn-primary">
                                Acessar fluxo de Fornecedor
                            </a>
                            <a href="/categorias" class="btn btn-primary">
                                Acessar fluxo de Categorias
                            </a>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
```