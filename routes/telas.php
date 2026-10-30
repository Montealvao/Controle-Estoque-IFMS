<?php
// Rotas apenas visuais (sem controllers, models ou banco). Incluir ao final de routes/web.php:
//   require __DIR__.'/telas.php';
use Illuminate\Support\Facades\Route;

$d = config('demo');
$v = fn ($tpl, $perfil, $x = []) => view($tpl, ['perfil' => $perfil] + $x);
$achar = fn ($rows, $id) => collect($rows)->firstWhere('id', (int) $id) ?? abort(404);
$comItens = fn ($rows) => collect($rows)->map(fn ($o) => $o + ['n_itens' => count($o['itens'])])->all();
$pos = fn ($id) => array_search((int) $id, array_column($d['produtos'], 'id'));

// Gera lista, novo, editar e detalhe de um recurso (views genéricas ou específicas).
$crud = function ($perfil, $slug, $titulo, $cols, $rows, $o = []) use ($v, $achar) {
    $b = "/$perfil/$slug";
    $editar = $o['editar'] ?? true;
    $novo = $o['novo'] ?? ($editar ? "$b/novo" : null);
    $campos = $o['campos'] ?? [];
    $form = $o['form'] ?? 'ui.form';
    $det = $o['det'] ?? $cols;
    Route::get($b, fn () => $v('ui.lista', $perfil, ['titulo' => $titulo, 'cols' => $cols, 'rows' => $rows, 'base' => $b, 'editar' => $editar, 'novo' => $novo]));
    if ($editar) {
        Route::get("$b/novo", fn () => $v($form, $perfil, ['titulo' => "Novo · $titulo", 'campos' => $campos, 'r' => [], 'base' => $b]));
        Route::get("$b/{id}/editar", fn ($id) => $v($form, $perfil, ['titulo' => "Editar · $titulo", 'campos' => $campos, 'r' => $achar($rows, $id), 'base' => $b]))->whereNumber('id');
    }
    Route::get("$b/{id}", fn ($id) => $v($o['detalhe'] ?? 'ui.detalhe', $perfil, ['titulo' => $titulo, 'cols' => $det, 'r' => $achar($rows, $id), 'base' => $b, 'editar' => $editar, 'acoes' => $o['acoes'] ?? [], 'modo' => $o['modo'] ?? null]))->whereNumber('id');
};

// Campos comuns de cadastro de cliente/fornecedor (PDF): nome, documento, e-mail, endereço, telefone.
$camposPessoa = [['nome', 'Nome', 'text'], ['documento', 'Documento', 'text'], ['email', 'E-mail', 'email'], ['telefone', 'Telefone', 'text'], ['endereco', 'Endereço', 'text']];

/* ---------- ACESSO (raiz do projeto) ---------- */
Route::view('/', 'auth.login');
Route::view('/cadastro', 'auth.cadastro');
Route::view('/recuperar-senha', 'auth.recuperar');
Route::view('/telas', 'ui.entrada', ['perfil' => 'entrada']);

/* ---------- CLIENTE ---------- */
Route::get('/cliente', fn () => $v('cliente.catalogo', 'cliente'));
Route::get('/cliente/produtos/{id}', fn ($id) => $v('cliente.produto', 'cliente', ['p' => $achar($d['produtos'], $id)]));
Route::get('/cliente/compra/{id}', fn ($id) => $v('cliente.pedido', 'cliente', ['modo' => 'compra', 'ini' => [[$pos($id), 1, null]]]));
Route::get('/cliente/orcamento/{id}', fn ($id) => $v('cliente.pedido', 'cliente', ['modo' => 'orcamento', 'ini' => [[$pos($id), 1, null]]]));
Route::get('/cliente/perfil', fn () => $v('ui.form', 'cliente', ['titulo' => 'Meu perfil e dados cadastrais', 'base' => '/cliente', 'msg' => 'Dados atualizados (simulação).', 'r' => $d['clientes'][0], 'campos' => $camposPessoa]));
$minhas = collect($d['vendas'])->where('cliente', 'Ana Souza')->values()->all();
$crud('cliente', 'solicitacoes', 'Minhas solicitações', ['id' => 'Nº', 'documento' => 'Documento', 'tipo' => 'Tipo', 'data' => 'Data', 'forma_pagamento' => 'Forma de pagamento', 'n_itens' => 'Itens', 'valor' => 'Valor', 'estado' => 'Estado'], $comItens($minhas), ['editar' => false, 'detalhe' => 'ui.documento-detalhe', 'modo' => 'venda', 'acoes' => [['Cancelar solicitação', 'outline-danger', 'Solicitação cancelada (simulação).']]]);

/* ---------- LOJA (ADMINISTRADOR) ---------- */
Route::get('/loja', fn () => $v('ui.dashboard', 'loja', [
    'titulo' => 'Painel administrativo',
    'kpis' => [['Produtos abaixo do estoque mínimo', 2, 'bi-exclamation-triangle'], ['Orçamentos de compra em análise', 2, 'bi-clipboard-data'], ['Contas a pagar pendentes', 4, 'bi-cash-stack'], ['Contas a receber pendentes', 4, 'bi-cash-coin']],
    'tabTitulo' => 'Últimas vendas e orçamentos de venda', 'cols' => ['id' => 'Nº', 'documento' => 'Documento', 'cliente' => 'Cliente', 'tipo' => 'Tipo', 'valor' => 'Valor', 'estado' => 'Estado'], 'rows' => array_slice($d['vendas'], 0, 4), 'link' => '/loja/vendas',
]));
$crud('loja', 'produtos', 'Produtos', ['id' => 'Cód.', 'descricao' => 'Descrição', 'categoria' => 'Categoria', 'qtde_estoque' => 'Qtde. em estoque', 'valor_compra' => 'Valor de compra', 'valor_venda' => 'Valor de venda', 'estado' => 'Situação do estoque'], $d['produtos'], [
    'form' => 'loja.produto-form',
    'det' => ['id' => 'Cód.', 'descricao' => 'Descrição', 'categoria' => 'Categoria', 'embalagem' => 'Embalagem', 'codigo_barra' => 'Código de barras', 'qtde_minima' => 'Qtde. mínima', 'qtde_maxima' => 'Qtde. máxima', 'qtde_estoque' => 'Qtde. em estoque', 'valor_compra' => 'Valor de compra', 'valor_venda' => 'Valor de venda', 'estado' => 'Situação do estoque'],
]);
$crud('loja', 'categorias', 'Categorias', ['id' => 'Cód.', 'descricao' => 'Descrição', 'margem_lucro' => 'Margem de lucro', 'produtos' => 'Produtos', 'fornecedores' => 'Fornecedores'], $d['categorias'], ['campos' => [['descricao', 'Descrição', 'text'], ['margem', 'Margem de lucro (%)', 'number']]]);
$crud('loja', 'fornecedores', 'Fornecedores', ['id' => 'Cód.', 'nome' => 'Nome', 'documento' => 'Documento', 'email' => 'E-mail', 'telefone' => 'Telefone', 'categorias' => 'Categorias atendidas'], $d['fornecedores'], [
    'det' => ['id' => 'Cód.', 'nome' => 'Nome', 'documento' => 'Documento', 'email' => 'E-mail', 'endereco' => 'Endereço', 'telefone' => 'Telefone', 'categorias' => 'Categorias atendidas'],
    'campos' => array_merge($camposPessoa, [['categorias', 'Categorias atendidas', 'checks', $d['categorias_nomes'], false]]),
]);
$crud('loja', 'clientes', 'Clientes', ['id' => 'Cód.', 'nome' => 'Nome', 'documento' => 'Documento', 'email' => 'E-mail', 'telefone' => 'Telefone'], $d['clientes'], [
    'det' => ['id' => 'Cód.', 'nome' => 'Nome', 'documento' => 'Documento', 'email' => 'E-mail', 'endereco' => 'Endereço', 'telefone' => 'Telefone'],
    'campos' => $camposPessoa,
]);
$crud('loja', 'formas-pagamento', 'Formas de pagamento', ['id' => 'Cód.', 'descricao' => 'Descrição', 'parcelas' => 'Nº de parcelas', 'detalhe' => 'Itens (porcentagem e dia)'], $d['formas_pagamento'], ['form' => 'loja.forma-form']);
Route::get('/loja/orcamentos/novo', fn () => $v('loja.orcamento-novo', 'loja'));
$crud('loja', 'orcamentos', 'Orçamentos de compra', ['id' => 'Nº', 'solicitacao' => 'Solicitação', 'documento' => 'Documento', 'fornecedor' => 'Fornecedor', 'data' => 'Data', 'n_itens' => 'Itens', 'valor' => 'Valor total', 'estado' => 'Estado'], $comItens($d['orcamentos']), ['editar' => false, 'novo' => '/loja/orcamentos/novo', 'detalhe' => 'loja.orcamento-detalhe']);
Route::get('/loja/compras/novo', function () use ($v, $d, $achar) {
    $pre = null;
    if (request('orcamento')) { // compra gerada a partir de um orçamento aprovado
        $o = $achar($d['orcamentos'], request('orcamento'));
        $nomes = array_column($d['produtos'], 'descricao');
        $pre = ['parte' => $o['fornecedor'], 'orc' => $o['documento'], 'itens' => collect($o['itens'])->map(fn ($i) => [array_search($i[0], $nomes), $i[1], $i[4]])->all()];
    }
    return $v('ui.documento-form', 'loja', ['modo' => 'compra', 'titulo' => 'Nova compra', 'base' => '/loja/compras', 'pre' => $pre]);
});
$crud('loja', 'compras', 'Compras', ['id' => 'Nº', 'documento' => 'Documento', 'fornecedor' => 'Fornecedor', 'data' => 'Data', 'forma_pagamento' => 'Forma de pagamento', 'n_itens' => 'Itens', 'valor' => 'Valor'], $comItens($d['compras']), ['editar' => false, 'novo' => '/loja/compras/novo', 'detalhe' => 'ui.documento-detalhe', 'modo' => 'compra']);
$crud('loja', 'contas-pagar', 'Contas a pagar', ['id' => 'Nº', 'documento' => 'Documento', 'fornecedor' => 'Fornecedor', 'compra' => 'Compra', 'vencimento' => 'Data de vencimento', 'valor' => 'Valor', 'pagamento' => 'Data de pagamento', 'estado' => 'Situação'], $d['contas_pagar'], ['editar' => false, 'acoes' => [['Registrar pagamento', 'success', 'Pagamento registrado (simulação).']]]);
Route::get('/loja/vendas/novo', fn () => $v('ui.documento-form', 'loja', ['modo' => 'venda', 'titulo' => 'Nova venda', 'base' => '/loja/vendas', 'pre' => null]));
$crud('loja', 'vendas', 'Vendas e orçamentos de venda', ['id' => 'Nº', 'documento' => 'Documento', 'cliente' => 'Cliente', 'tipo' => 'Tipo', 'data' => 'Data', 'n_itens' => 'Itens', 'valor' => 'Valor', 'estado' => 'Estado'], $comItens($d['vendas']), ['editar' => false, 'novo' => '/loja/vendas/novo', 'detalhe' => 'ui.documento-detalhe', 'modo' => 'venda', 'acoes' => [['Aprovar e registrar venda', 'success', 'Venda aprovada; contas a receber geradas (simulação).'], ['Recusar', 'outline-danger', 'Solicitação recusada (simulação).']]]);
$crud('loja', 'contas-receber', 'Contas a receber', ['id' => 'Nº', 'documento' => 'Documento', 'cliente' => 'Cliente', 'venda' => 'Venda', 'vencimento' => 'Data de vencimento', 'valor' => 'Valor', 'pagamento' => 'Data de pagamento', 'estado' => 'Situação'], $d['contas_receber'], ['editar' => false, 'acoes' => [['Registrar recebimento', 'success', 'Recebimento registrado (simulação).']]]);
Route::get('/loja/configuracoes', fn () => $v('ui.form', 'loja', ['titulo' => 'Configurações da loja', 'base' => '/loja', 'msg' => 'Configurações salvas (simulação).', 'r' => ['nome' => 'Estoque IFMS', 'email' => 'loja@ifms.exemplo'], 'campos' => [['nome', 'Nome da loja', 'text'], ['email', 'E-mail de contato', 'email']]]));

/* ---------- FORNECEDOR ---------- */
Route::get('/fornecedor', fn () => $v('ui.dashboard', 'fornecedor', [
    'titulo' => 'Painel do fornecedor',
    'kpis' => [['Categorias atendidas', 1, 'bi-tags'], ['Orçamentos aguardando proposta', 1, 'bi-inbox'], ['Propostas em análise', 1, 'bi-hourglass-split'], ['Propostas aprovadas', 1, 'bi-check2-circle']],
    'tabTitulo' => 'Orçamentos recebidos', 'cols' => ['id' => 'Nº', 'documento' => 'Documento', 'data' => 'Data', 'valor' => 'Valor total', 'estado' => 'Estado'], 'rows' => $d['forn_orcamentos'], 'link' => '/fornecedor/orcamentos',
]));
Route::get('/fornecedor/categorias', fn () => $v('fornecedor.categorias', 'fornecedor'));
$crud('fornecedor', 'orcamentos', 'Orçamentos recebidos', ['id' => 'Nº', 'documento' => 'Documento', 'data' => 'Data', 'n_itens' => 'Itens', 'valor' => 'Valor total (minha proposta)', 'estado' => 'Estado'], $comItens($d['forn_orcamentos']), ['editar' => false, 'detalhe' => 'fornecedor.solicitacao']);
Route::get('/fornecedor/perfil', fn () => $v('ui.form', 'fornecedor', ['titulo' => 'Perfil do fornecedor', 'base' => '/fornecedor', 'msg' => 'Perfil atualizado (simulação).', 'r' => $d['fornecedores'][0], 'campos' => $camposPessoa]));
