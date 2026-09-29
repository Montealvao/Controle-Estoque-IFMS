<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <div class="login-left">
            <div class="login-brand">
                <div class="brand-icon-lg">
                    <i class="bi bi-shield-check"></i>
                </div>

                <h1 class="login-brand-title">
                    Controle de Estoque
                </h1>

                <p class="login-brand-sub">
                    Sistema de Controle de Estoque
                </p>
            </div>

            <ul class="login-features">
                <li>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Consulta rápida de registros
                </li>

                <li>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Gerenciamento de pessoas e CPFs
                </li>

                <li>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    Relatórios e consultas organizadas
                </li>
            </ul>
        </div>

        <div class="login-right">
            <div class="login-card">
                <div class="text-center mb-4">
                    <h2 class="login-title">
                        Bem-vindo
                    </h2>

                    <p class="text-muted">
                        Informe suas credenciais para acessar o sistema
                    </p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            E-mail
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>

                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="Digite seu e-mail" autofocus
                                required>
                        </div>

                        @error('email')
                            <div class="text-danger mt-1" style="font-size:0.85rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            Senha
                        </label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Digite sua senha" required>
                        </div>

                        @error('password')
                            <div class="text-danger mt-1" style="font-size:0.85rem;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Acessar o Sistema
                    </button>
                </form>

                <p class="text-center text-muted mt-4 mb-0" style="font-size:0.8rem;">
                    <i class="bi bi-lock-fill me-1"></i>
                    Acesso restrito a usuários autorizados
                </p>

            </div>
        </div>
    </div>
</body>

</html>