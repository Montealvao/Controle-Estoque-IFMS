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
            <h1 class="page-title">Gerenciar Fornecedores</h1>
            <p class="page-subtitle">Registros de Fornecedores</p>
        </div>

        <a href="/" class="btn btn-secondary">Voltar ao Início</a>
        <a href="/fornecedores/novo" class="btn btn-primary">
            <i class="bi bi-plus-square-fill me-2"></i>
            Novo Fornecedor
        </a>
    </div>

    <div class="card portal-card">
        <div class="card-header">
            <form method="GET"
                action="{{ route('admin.fornecedores.index') }}"
                class="d-flex gap-2 flex-wrap">

                <div class="input-group" style="max-width:360px;">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text"
                        class="form-control"
                        name="busca"
                        value="{{ request('busca') }}"
                        placeholder="Buscar por Razão Social, Nome Fantasia...">
                </div>

                <button type="submit" class="btn btn-primary">
                    Buscar
                </button>

                @if(request('busca'))
                <a href="{{ route('admin.fornecedores.index') }}"
                    class="btn btn-outline-secondary">
                    Limpar
                </a>
                @endif

            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>Endereço</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>CNPJ</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($fornecedores as $fornecedor)

                        <tr>
                            <td class="text-muted">
                                {{ $fornecedor->id }}
                            </td>

                            <td class="font-monospace fw-semibold">
                                {{ $fornecedor->razao_social }}
                            </td>

                            <td>
                                {{ $fornecedor->nome_fantasia }}

                            </td>

                            <td class="text-muted">
                                {{ $fornecedor->endereco }}
                            </td>

                            <td class="text-muted">
                                {{ $fornecedor->fone }}
                            </td>

                            <td class="text-muted">
                                {{ $fornecedor->email }}
                            </td>

                            <td class="text-muted">
                                {{ $fornecedor->cnpj }}
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <form action="{{ route('admin.fornecedores.edit', $fornecedor->id) }}" method="get">
                                        <button
                                            class="btn btn-sm btn-ghost"
                                            title="Editar"
                                            type="submit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.fornecedores.destroy', $fornecedor->id) }}" method="post">
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
                                Nenhum fornecedor cadastrado.
                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="text-muted" style="font-size:0.85rem;">
                Exibindo {{ $fornecedores->count() }} de {{ $fornecedores->total() }} registros
            </span>

            <div>
                {{ $fornecedores->links() }}
            </div>
        </div>
    </div>

</body>

</html>