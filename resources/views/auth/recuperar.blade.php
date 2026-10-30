@extends('layouts.auth')
@section('titulo', 'Recuperar senha')
@section('conteudo')
<h2 class="h4 mb-2">Recuperar senha</h2>
<p class="text-muted">Informe seu e-mail para receber o link de redefinição (simulado).</p>
<form novalidate data-demo="Link de redefinição enviado (simulação)." data-vai="{{ url('/') }}">
  <x-campo id="email" label="E-mail" type="email" />
  <button class="btn btn-success w-100">Enviar link</button>
</form>
<p class="text-center mt-3 mb-0"><a href="{{ url('/') }}">Voltar ao login</a></p>
@endsection
