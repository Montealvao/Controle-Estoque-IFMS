@props(['id' => 'itens', 'modo' => 'venda'])
<div class="table-responsive"><table class="table align-middle mb-0">
  <thead><tr><th>Produto</th><th>Categoria</th><th style="width:130px">Quantidade</th><th style="width:190px">{{ $modo === 'solicitacao' ? 'Valor de compra atual (ref.)' : 'Valor unitário' }}</th><th>Valor total</th><th><span class="visually-hidden">Remover</span></th></tr></thead>
  <tbody id="{{ $id }}"></tbody>
</table></div>
