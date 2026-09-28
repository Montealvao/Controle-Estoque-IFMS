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
                <a class="nav-link" href="/categoria/novo">
                    categoria
                </a>

                <a class="nav-link" href="{{ route('categorias.index')}}">
                    listar
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- 2. Substitua o h1 atual por: -->
        <h1>
           Criar categoria
        </h1> 

        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">
                    Nome 
                </label>
                <input type="text" name="nome" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Margem De Lucro
                </label>
                <input type="text" name="margem_lucro" class="form-control">
            </div>
            <!-- 4. Substitua o botão Gravar por: -->
            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
        </form>
    </div>
</body>

</html>