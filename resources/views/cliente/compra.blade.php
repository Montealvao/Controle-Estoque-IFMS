@extends('layouts.portal')
@section('titulo', 'Comprar')
@section('conteudo')
<h1 class="h3">Compra direta</h1>
<ol class="passos"><li data-p="1" class="ativo">1 Produto</li><li data-p="2">2 Conferir dados</li><li data-p="3">3 Confirmação</li></ol>
<div class="card card-body" data-passo="1">
  <h2 class="h5">{{ $p['nome'] }}</h2><p class="text-muted">{{ $p['tipo'] }} · {{ $p['preco'] }}</p>
  <label class="form-label" for="qt">Quantidade</label><input id="qt" type="number" min="1" value="1" class="form-control mb-3" style="max-width:160px">
  <div class="d-flex gap-2"><a class="btn btn-outline-secondary" href="{{ url('/cliente/produtos/'.$p['id']) }}">Voltar</a><button class="btn btn-success" data-ir="2">Continuar</button></div>
</div>
<div class="card card-body" data-passo="2" hidden>
  <h2 class="h5">Conferir informações</h2>
  <p class="mb-1"><strong>Produto:</strong> {{ $p['nome'] }}</p><p><strong>Valor unitário:</strong> {{ $p['preco'] }}</p>
  <div class="row g-3 mb-3"><div class="col-md-6"><label class="form-label" for="en">Endereço de entrega</label><input id="en" class="form-control" value="Rua das Palmeiras, 100 - Campo Grande/MS"></div>
  <div class="col-md-6"><label class="form-label" for="pg">Forma de pagamento (simulada)</label><select id="pg" class="form-select"><option>Pix</option><option>Boleto</option><option>Cartão de crédito</option></select></div></div>
  <div class="d-flex gap-2"><button class="btn btn-outline-secondary" data-ir="1">Voltar</button><button class="btn btn-success" data-ir="3">Confirmar compra</button></div>
</div>
<div class="card card-body text-center py-5" data-passo="3" hidden>
  <i class="bi bi-check-circle-fill text-success display-3"></i><h2 class="h4 mt-2">Compra registrada (simulação)</h2><p class="text-muted">Pedido #1050 · Estado: <x-estado v="Pendente" /></p>
  <div><a class="btn btn-success" href="{{ url('/cliente/solicitacoes') }}">Ver minhas solicitações</a></div>
</div>
@push('js')
<script>
document.querySelectorAll('[data-ir]').forEach(b => b.onclick = () => {
  const n = b.dataset.ir;
  document.querySelectorAll('[data-passo]').forEach(s => s.hidden = s.dataset.passo !== n);
  document.querySelectorAll('.passos li').forEach(l => l.classList.toggle('ativo', +l.dataset.p <= +n));
});
</script>
@endpush
@endsection
