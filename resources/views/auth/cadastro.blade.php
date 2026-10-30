@extends('layouts.auth')
@section('titulo', 'Cadastro')
@section('conteudo')
<h2 class="h4 mb-4">Criar conta</h2>
<form id="fc" novalidate data-demo="Cadastro realizado (simulação). Faça login para continuar." data-vai="{{ url('/') }}">
  <fieldset class="mb-3"><legend class="form-label fs-6">Tipo de conta</legend>
    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="conta" id="c_cli" value="cliente" checked><label class="form-check-label" for="c_cli">Cliente</label></div>
    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="conta" id="c_for" value="fornecedor"><label class="form-check-label" for="c_for">Fornecedor</label></div>
    <div class="form-text">Contas da loja (administrador) são criadas internamente.</div>
  </fieldset>
  <x-campo id="nome" label="Nome" />
  <x-campo id="documento" label="Documento" />
  <x-campo id="email" label="E-mail" type="email" />
  <div class="row"><div class="col-md-6"><x-campo id="telefone" label="Telefone" /></div><div class="col-md-6"><x-campo id="endereco" label="Endereço" /></div></div>
  <fieldset class="mb-3" id="forn" hidden><legend class="form-label fs-6">Categorias atendidas</legend>
    @foreach(config('demo.categorias_nomes') as $i => $t)<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="cat{{ $i }}"><label class="form-check-label" for="cat{{ $i }}">{{ $t }}</label></div>@endforeach
    <div class="form-text">Você recebe orçamentos de compra apenas dos itens das categorias marcadas.</div></fieldset>
  <div class="row"><div class="col-md-6"><x-campo id="senha" label="Senha" type="password" minlength="6" /></div><div class="col-md-6"><x-campo id="senha2" label="Confirmar senha" type="password" /></div></div>
  <div class="form-check mb-3"><input class="form-check-input" type="checkbox" id="termos" required><label class="form-check-label" for="termos">Li e aceito os termos de uso</label></div>
  <button class="btn btn-success w-100">Cadastrar</button>
</form>
<p class="text-center mt-3 mb-0">Já tem conta? <a href="{{ url('/') }}">Entrar</a></p>
@push('js')
<script>
const s1 = document.getElementById('senha'), s2 = document.getElementById('senha2');
function alternar() { document.getElementById('forn').hidden = !document.getElementById('c_for').checked; }
document.querySelectorAll('[name=conta]').forEach(r => r.onchange = alternar); alternar();
function conferir() { s2.setCustomValidity(s1.value === s2.value ? '' : 'As senhas não coincidem'); }
s1.oninput = s2.oninput = conferir;
</script>
@endpush
@endsection
