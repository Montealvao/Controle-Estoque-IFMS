@extends('layouts.portal')
@section('titulo', $titulo)
@section('conteudo')
<h1 class="h3 mb-3">{{ $titulo }}</h1>
<form class="card card-body" novalidate data-demo="Produto salvo (simulação)." data-vai="{{ url($base) }}">
  <div class="row g-3">
    <div class="col-md-6"><x-campo id="descricao" label="Descrição" :value="$r['descricao'] ?? ''" /></div>
    <div class="col-md-6"><label class="form-label" for="categoria">Categoria *</label>
      <select id="categoria" class="form-select" required>@foreach(config('demo.categorias') as $c)<option data-margem="{{ $c['margem'] }}" @selected(($r['categoria'] ?? '') === $c['descricao'])>{{ $c['descricao'] }}</option>@endforeach</select></div>
    <div class="col-md-4"><x-campo id="embalagem" label="Embalagem" :value="$r['embalagem'] ?? ''" /></div>
    <div class="col-md-8"><x-campo id="codigo_barra" label="Código de barras" :value="$r['codigo_barra'] ?? ''" /></div>
    <div class="col-md-4"><x-campo id="qtde_minima" label="Quantidade mínima" type="number" :value="$r['qtde_minima'] ?? ''" /></div>
    <div class="col-md-4"><x-campo id="qtde_maxima" label="Quantidade máxima" type="number" :value="$r['qtde_maxima'] ?? ''" /></div>
    <div class="col-md-4"><x-campo id="qtde_estoque" label="Quantidade em estoque" type="number" :value="$r['qtde_estoque'] ?? ''" /></div>
    <div class="col-md-6"><x-campo id="valor_compra" label="Valor de compra (R$)" :value="number_format($r['compra_n'] ?? 0, 2, ',', '.')" ajuda="Atualizado automaticamente a cada compra (média aritmética)." /></div>
    <div class="col-md-6"><x-campo id="valor_venda" label="Valor de venda (calculado)" :req="false" readonly /><div class="form-text" style="margin-top:-.75rem">Valor de compra + margem de lucro da categoria (<span id="margem"></span>).</div></div>
  </div>
  <div class="mt-4 d-flex gap-2"><button class="btn btn-success">Salvar</button><a class="btn btn-outline-secondary" href="{{ url($base) }}">Cancelar</a></div>
</form>
@push('js')
<script>
const c = document.getElementById('valor_compra'), k = document.getElementById('categoria'), o = document.getElementById('valor_venda');
function calc() {
  const mg = +k.selectedOptions[0].dataset.margem, v = parseFloat(c.value.replace('.', '').replace(',', '.')) || 0;
  document.getElementById('margem').textContent = mg + '%';
  o.value = (v * (1 + mg / 100)).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
}
c.oninput = k.onchange = calc; calc();
</script>
@endpush
@endsection
