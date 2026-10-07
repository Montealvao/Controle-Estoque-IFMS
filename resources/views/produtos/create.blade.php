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
                <a class="nav-link" href="{{ route('produtos.index')}}">
                    Listar produtos
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <h1>
            Cadastrar produto.
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <h6 class="alert-heading fw-bold mb-1">Atenção! Verifique os seguintes erros:</h6>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produto.gravar') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">
                    Nome
                </label>
                <input type="text" name="nome" class="form-control" 
                    value="{{ old('nome', $produto->nome ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Embalagem
                </label>
                <input type="text" name="embalagem" class="form-control"
                    value="{{ old('embalagem', $produto->embalagem ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Quantidade em estoque
                </label>
                <input type="number" name="qtde_estoque" class="form-control"
                    value="{{ old('qtde_estoque', $produto->qtde_estoque ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Código
                </label>
                <input type="text" name="codigo_barra" class="form-control"
                    value="{{ old('codigo_barra', $produto->codigo_barra ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Valor de Compra
                </label>
                <input type="number" name="valor_compra" class="form-control"
                    value="{{ old('valor_compra', $produto->valor_compra ?? '') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Valor de venda
                </label>
                <input type="number" name="valor_venda" class="form-control"
                    value="{{ old('valor_venda', $produto->valor_venda ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoria do Produto <span
                        class="text-danger">*</span></label>

                <select class="form-select" id="categoria_id" name="categoria_id" required>
                    <option value="">Selecione uma categoria...</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id', $produto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Quantidade mínima
                </label>
                <input type="number" name="qtde_minima" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    Quantidade máxima
                </label>
                <input type="number" name="qtde_maxima" class="form-control">
            </div>
     
            <!-- 4. Substitua o botão Gravar por: -->
            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
        </form>
    </div>
</body>

</html>