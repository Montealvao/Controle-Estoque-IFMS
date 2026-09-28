<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('portal.css') }}">
</head>

<body>
    <div class="page-header mb-4">
        <div>
            <h1 class="page-title">Gerenciar categorias</h1>
            <p class="page-subtitle">Registros de categorias</p>
        </div>

        <a href="/" class="btn btn-secondary">Voltar ao Início</a>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-square-fill me-2"></i>
            Nova Categoria
        </a>
    </div>

    <div class="card portal-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Margem de Lucro</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categorias as $categoria)

                        <tr>
                            <td class="text-muted">
                                {{ $categoria->id }}
                            </td>

                            <td class="font-monospace fw-semibold">
                                {{ $categoria->nome }}
                            </td>

                            <td>
                                {{ $categoria->margem_lucro }}

                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <form action="{{ route('categorias.edit', $categoria->id) }}" method="get">
                                        <button
                                            class="btn btn-sm btn-ghost"
                                            title="Editar"
                                            type="submit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="btn btn-sm btn-ghost text-danger"
                                            title="Excluir"
                                            type="submit">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="5"
                                class="text-center py-4 text-muted">
                                Nenhum categoria cadastrado.
                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>