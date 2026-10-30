@extends('layouts.auth')
@section('titulo', 'Entrar')
@section('conteudo')
<h2 class="h4 mb-4">Entrar</h2>
<form id="fl" novalidate data-demo="Login simulado: entrando…" data-vai="{{ url('/cliente') }}">
  <fieldset class="mb-3"><legend class="form-label fs-6">Entrar como</legend>
    @foreach([['cliente', 'Cliente'], ['loja', 'Loja (Administrador)'], ['fornecedor', 'Fornecedor']] as [$v, $r])
      <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="perfil" id="p_{{ $v }}" value="{{ $v }}" @checked($v === 'cliente')><label class="form-check-label" for="p_{{ $v }}">{{ $r }}</label></div>
    @endforeach
  </fieldset>
  <x-campo id="email" label="E-mail" type="email" />
  <x-campo id="senha" label="Senha" type="password" minlength="6" />
  <div class="d-flex justify-content-between mb-3">
    <div class="form-check"><input class="form-check-input" type="checkbox" id="lembrar"><label class="form-check-label" for="lembrar">Manter conectado</label></div>
    <a href="{{ url('/recuperar-senha') }}">Esqueci a senha</a>
  </div>
  <button class="btn btn-success w-100">Entrar</button>
</form>
<p class="text-center mt-3 mb-0">Não tem conta? <a href="{{ url('/cadastro') }}">Cadastre-se</a></p>
@push('js')
<script>
document.getElementById('fl').addEventListener('submit', e => {
  e.currentTarget.dataset.vai = '{{ url('/') }}/' + document.querySelector('[name=perfil]:checked').value;
});
</script>
@endpush
@endsection
