<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="navbar-nav">
                <a class="nav-link" href="/fornecedores/novo">
                    Novo
                </a>

                <a class="nav-link" href="/fornecedores">
                    listar
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- 2. Substitua o h1 atual por: -->
        <h1>
            Novo
        </h1>

        <form action="{{ route('admin.fornecedores.update', $fornecedor->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">
                    Razão Social
                </label>
                <input type="text" name="razao_social" class="form-control" value="{{ $fornecedor->razao_social }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Nome Fantasia
                </label>
                <input type="text" name="nome_fantasia" class="form-control" value="{{ $fornecedor->nome_fantasia }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Endereço
                </label>
                <input type="text" name="endereco" class="form-control" value="{{ $fornecedor->endereco }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Telefone
                </label>
                <input type="text" name="fone" class="form-control" value="{{ $fornecedor->fone }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Email
                </label>
                <input type="email" name="email" class="form-control" value="{{ $fornecedor->email }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    CNPJ
                </label>
                <input type="text" name="cnpj" class="form-control" value="{{ $fornecedor->cnpj }}">
            </div>
            <!-- 4. Substitua o botão Gravar por: -->
            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
        </form>
    </div>
</body>

</html>