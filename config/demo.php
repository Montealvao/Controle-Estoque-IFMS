<?php
// Dados fictícios (sem banco). Alinhados à modelagem ER e ao detalhamento do projeto (PDF).
// Itens de compra/venda/orçamento: [produto, quantidade, valor unitário, valor total, valor unitário numérico].
return [
 'menus' => [
  'entrada' => [],
  'cliente' => [['Catálogo','/cliente','bi-shop'],['Minhas solicitações','/cliente/solicitacoes','bi-receipt'],['Perfil','/cliente/perfil','bi-person']],
  'loja' => [['Painel','/loja','bi-speedometer2'],['Produtos','/loja/produtos','bi-box-seam'],['Categorias','/loja/categorias','bi-tags'],['Fornecedores','/loja/fornecedores','bi-truck'],['Clientes','/loja/clientes','bi-people'],['Formas de pagamento','/loja/formas-pagamento','bi-credit-card'],['Orçamentos de compra','/loja/orcamentos','bi-clipboard-data'],['Compras','/loja/compras','bi-bag-check'],['Contas a pagar','/loja/contas-pagar','bi-cash-stack'],['Vendas e orçamentos de venda','/loja/vendas','bi-cart-check'],['Contas a receber','/loja/contas-receber','bi-cash-coin'],['Configurações','/loja/configuracoes','bi-gear']],
  'fornecedor' => [['Painel','/fornecedor','bi-speedometer2'],['Categorias atendidas','/fornecedor/categorias','bi-tags'],['Orçamentos recebidos','/fornecedor/orcamentos','bi-inbox'],['Perfil','/fornecedor/perfil','bi-building']],
 ],
 'categorias_nomes' => ['Fixação','Ferramentas','Elétrica','EPI'],
 'categorias' => [
  ['id'=>1,'descricao'=>'Fixação','margem'=>30,'margem_lucro'=>'30%','produtos'=>3,'fornecedores'=>3],
  ['id'=>2,'descricao'=>'Ferramentas','margem'=>25,'margem_lucro'=>'25%','produtos'=>1,'fornecedores'=>2],
  ['id'=>3,'descricao'=>'Elétrica','margem'=>35,'margem_lucro'=>'35%','produtos'=>1,'fornecedores'=>1],
  ['id'=>4,'descricao'=>'EPI','margem'=>40,'margem_lucro'=>'40%','produtos'=>1,'fornecedores'=>1],
 ],
 // valor de venda = valor de compra + margem de lucro da categoria
 'produtos' => [
  ['id'=>1,'descricao'=>'Parafuso Sextavado M8','categoria'=>'Fixação','margem'=>30,'embalagem'=>'Caixa c/ 100 un','codigo_barra'=>'7891000100011','qtde_minima'=>200,'qtde_maxima'=>3000,'qtde_estoque'=>1240,'valor_compra'=>'R$ 0,70','valor_venda'=>'R$ 0,91','compra_n'=>0.70,'venda_n'=>0.91,'estado'=>'Estoque normal'],
  ['id'=>2,'descricao'=>'Furadeira de Impacto 650W','categoria'=>'Ferramentas','margem'=>25,'embalagem'=>'Unidade','codigo_barra'=>'7891000100028','qtde_minima'=>5,'qtde_maxima'=>40,'qtde_estoque'=>18,'valor_compra'=>'R$ 200,00','valor_venda'=>'R$ 250,00','compra_n'=>200.00,'venda_n'=>250.00,'estado'=>'Estoque normal'],
  ['id'=>3,'descricao'=>'Fita Isolante 20 m','categoria'=>'Elétrica','margem'=>35,'embalagem'=>'Rolo 20 m','codigo_barra'=>'7891000100035','qtde_minima'=>20,'qtde_maxima'=>300,'qtde_estoque'=>0,'valor_compra'=>'R$ 5,00','valor_venda'=>'R$ 6,75','compra_n'=>5.00,'venda_n'=>6.75,'estado'=>'Abaixo do mínimo'],
  ['id'=>4,'descricao'=>'Capacete de Segurança','categoria'=>'EPI','margem'=>40,'embalagem'=>'Unidade','codigo_barra'=>'7891000100042','qtde_minima'=>20,'qtde_maxima'=>150,'qtde_estoque'=>75,'valor_compra'=>'R$ 30,00','valor_venda'=>'R$ 42,00','compra_n'=>30.00,'venda_n'=>42.00,'estado'=>'Estoque normal'],
  ['id'=>5,'descricao'=>'Parafuso Sextavado M10','categoria'=>'Fixação','margem'=>30,'embalagem'=>'Caixa c/ 100 un','codigo_barra'=>'7891000100059','qtde_minima'=>100,'qtde_maxima'=>2000,'qtde_estoque'=>800,'valor_compra'=>'R$ 1,10','valor_venda'=>'R$ 1,43','compra_n'=>1.10,'venda_n'=>1.43,'estado'=>'Estoque normal'],
  ['id'=>6,'descricao'=>'Arruela Lisa M8','categoria'=>'Fixação','margem'=>30,'embalagem'=>'Pacote c/ 200 un','codigo_barra'=>'7891000100066','qtde_minima'=>300,'qtde_maxima'=>4000,'qtde_estoque'=>150,'valor_compra'=>'R$ 0,15','valor_venda'=>'R$ 0,20','compra_n'=>0.15,'venda_n'=>0.20,'estado'=>'Abaixo do mínimo'],
 ],
 // fornecedor N:N categoria. Cadastro: nome, documento, e-mail, endereço, telefone.
 'fornecedores' => [
  ['id'=>1,'nome'=>'Parafusos Brasil','documento'=>'12.345.678/0001-90','email'=>'contato@parafusosbrasil.exemplo','telefone'=>'(67) 3333-1000','endereco'=>'Av. Industrial, 500 - Campo Grande/MS','categorias'=>'Fixação'],
  ['id'=>2,'nome'=>'FixaMais','documento'=>'23.456.789/0001-01','email'=>'vendas@fixamais.exemplo','telefone'=>'(67) 3333-2000','endereco'=>'Rua das Flores, 20 - Dourados/MS','categorias'=>'Fixação'],
  ['id'=>3,'nome'=>'Metalúrgica Sul','documento'=>'34.567.890/0001-12','email'=>'comercial@metsul.exemplo','telefone'=>'(67) 3333-3000','endereco'=>'Rod. BR-163, km 4 - Campo Grande/MS','categorias'=>'Fixação, Ferramentas'],
  ['id'=>4,'nome'=>'Ferramentas Norte','documento'=>'45.678.901/0001-23','email'=>'atendimento@fnorte.exemplo','telefone'=>'(67) 3333-4000','endereco'=>'Rua Central, 80 - Três Lagoas/MS','categorias'=>'Ferramentas'],
  ['id'=>5,'nome'=>'Eletro Sul','documento'=>'56.789.012/0001-34','email'=>'vendas@eletrosul.exemplo','telefone'=>'(67) 3333-5000','endereco'=>'Av. Brasil, 900 - Campo Grande/MS','categorias'=>'Elétrica'],
  ['id'=>6,'nome'=>'Seguro EPI','documento'=>'67.890.123/0001-45','email'=>'vendas@seguroepi.exemplo','telefone'=>'(67) 3333-6000','endereco'=>'Rua do Comércio, 15 - Corumbá/MS','categorias'=>'EPI'],
 ],
 // Cadastro de cliente: nome, documento, e-mail, endereço, telefone.
 'clientes' => [
  ['id'=>1,'nome'=>'Ana Souza','documento'=>'123.456.789-00','email'=>'ana@exemplo.com','telefone'=>'(67) 99999-0000','endereco'=>'Rua das Palmeiras, 100 - Campo Grande/MS'],
  ['id'=>2,'nome'=>'Construtora Pantanal','documento'=>'78.901.234/0001-56','email'=>'compras@pantanal.exemplo','telefone'=>'(67) 3321-0000','endereco'=>'Av. Afonso Pena, 1500 - Dourados/MS'],
  ['id'=>3,'nome'=>'Carlos Lima','documento'=>'987.654.321-00','email'=>'carlos@exemplo.com','telefone'=>'(67) 98888-1111','endereco'=>'Rua 7 de Setembro, 45 - Três Lagoas/MS'],
 ],
 // item da forma de pagamento: [porcentagem, dia]
 'formas_pagamento' => [
  ['id'=>1,'descricao'=>'À vista','parcelas'=>1,'detalhe'=>'100% no ato','itens'=>[[100,0]]],
  ['id'=>2,'descricao'=>'30/60 dias','parcelas'=>2,'detalhe'=>'50% em 30 dias · 50% em 60 dias','itens'=>[[50,30],[50,60]]],
  ['id'=>3,'descricao'=>'3x (30/60/90)','parcelas'=>3,'detalhe'=>'34% em 30 · 33% em 60 · 33% em 90 dias','itens'=>[[34,30],[33,60],[33,90]]],
 ],
 // Orçamento de compra: pertence a UM fornecedor e tem itens de compra.
 // 'solicitacao' agrupa os orçamentos gerados de um mesmo pedido da loja (apenas visual, ver pendências).
 'orcamentos' => [
  ['id'=>42,'solicitacao'=>'SOL-0012','documento'=>'ORC-0042','fornecedor'=>'Metalúrgica Sul','data'=>'25/10/2026','valor'=>'R$ 2.470,00','estado'=>'Em análise','itens'=>[['Parafuso Sextavado M8',1000,'R$ 0,62','R$ 620,00',0.62],['Furadeira de Impacto 650W',10,'R$ 185,00','R$ 1.850,00',185.00]]],
  ['id'=>43,'solicitacao'=>'SOL-0012','documento'=>'ORC-0043','fornecedor'=>'Parafusos Brasil','data'=>'25/10/2026','valor'=>'R$ 660,00','estado'=>'Em análise','itens'=>[['Parafuso Sextavado M8',1000,'R$ 0,66','R$ 660,00',0.66]]],
  ['id'=>44,'solicitacao'=>'SOL-0012','documento'=>'ORC-0044','fornecedor'=>'FixaMais','data'=>'25/10/2026','valor'=>'R$ 690,00','estado'=>'Recusada','itens'=>[['Parafuso Sextavado M8',1000,'R$ 0,69','R$ 690,00',0.69]]],
  ['id'=>45,'solicitacao'=>'SOL-0012','documento'=>'ORC-0045','fornecedor'=>'Ferramentas Norte','data'=>'25/10/2026','valor'=>'—','estado'=>'Aguardando proposta','itens'=>[['Furadeira de Impacto 650W',10,'—','—',null]]],
  ['id'=>41,'solicitacao'=>'SOL-0013','documento'=>'ORC-0041','fornecedor'=>'Seguro EPI','data'=>'26/10/2026','valor'=>'—','estado'=>'Aguardando proposta','itens'=>[['Capacete de Segurança',40,'—','—',null]]],
 ],
 'compras' => [
  ['id'=>310,'documento'=>'NF 8841','fornecedor'=>'Seguro EPI','data'=>'20/10/2026','forma_pagamento'=>'30/60 dias','valor'=>'R$ 1.200,00','itens'=>[['Capacete de Segurança',40,'R$ 30,00','R$ 1.200,00',30.00]],'contas'=>[['19/11/2026','R$ 600,00','Em aberto'],['19/12/2026','R$ 600,00','Em aberto']]],
  ['id'=>309,'documento'=>'NF 8790','fornecedor'=>'Eletro Sul','data'=>'12/10/2026','forma_pagamento'=>'À vista','valor'=>'R$ 1.000,00','itens'=>[['Fita Isolante 20 m',200,'R$ 5,00','R$ 1.000,00',5.00]],'contas'=>[['12/10/2026','R$ 1.000,00','Pago']]],
  ['id'=>305,'documento'=>'NF 8702','fornecedor'=>'FixaMais','data'=>'15/09/2026','forma_pagamento'=>'30/60 dias','valor'=>'R$ 800,00','itens'=>[['Parafuso Sextavado M8',1000,'R$ 0,80','R$ 800,00',0.80]],'contas'=>[['15/10/2026','R$ 400,00','Vencida'],['14/11/2026','R$ 400,00','Em aberto']]],
 ],
 // Venda e orçamento de venda: itens de venda. 'tipo' diferencia compra direta de orçamento de venda (visual).
 'vendas' => [
  ['id'=>1042,'documento'=>'PV-1042','cliente'=>'Construtora Pantanal','tipo'=>'Orçamento de venda','data'=>'24/10/2026','forma_pagamento'=>'30/60 dias','valor'=>'R$ 1.310,00','estado'=>'Pendente','itens'=>[['Parafuso Sextavado M8',1000,'R$ 0,91','R$ 910,00',0.91],['Arruela Lisa M8',2000,'R$ 0,20','R$ 400,00',0.20]],'contas'=>[]],
  ['id'=>1045,'documento'=>'PV-1045','cliente'=>'Ana Souza','tipo'=>'Orçamento de venda','data'=>'26/10/2026','forma_pagamento'=>'3x (30/60/90)','valor'=>'R$ 500,00','estado'=>'Pendente','itens'=>[['Furadeira de Impacto 650W',2,'R$ 250,00','R$ 500,00',250.00]],'contas'=>[]],
  ['id'=>1039,'documento'=>'PV-1039','cliente'=>'Ana Souza','tipo'=>'Compra direta','data'=>'20/10/2026','forma_pagamento'=>'À vista','valor'=>'R$ 210,00','estado'=>'Aprovada','itens'=>[['Capacete de Segurança',5,'R$ 42,00','R$ 210,00',42.00]],'contas'=>[['20/10/2026','R$ 210,00','Recebido']]],
  ['id'=>1031,'documento'=>'PV-1031','cliente'=>'Carlos Lima','tipo'=>'Orçamento de venda','data'=>'18/10/2026','forma_pagamento'=>'À vista','valor'=>'R$ 270,00','estado'=>'Recusada','itens'=>[['Fita Isolante 20 m',40,'R$ 6,75','R$ 270,00',6.75]],'contas'=>[]],
  ['id'=>1020,'documento'=>'PV-1020','cliente'=>'Construtora Pantanal','tipo'=>'Orçamento de venda','data'=>'18/10/2026','forma_pagamento'=>'30/60 dias','valor'=>'R$ 770,00','estado'=>'Aprovada','itens'=>[['Furadeira de Impacto 650W',2,'R$ 250,00','R$ 500,00',250.00],['Fita Isolante 20 m',40,'R$ 6,75','R$ 270,00',6.75]],'contas'=>[['17/11/2026','R$ 385,00','Em aberto'],['17/12/2026','R$ 385,00','Em aberto']]],
  ['id'=>1010,'documento'=>'PV-1010','cliente'=>'Carlos Lima','tipo'=>'Compra direta','data'=>'10/09/2026','forma_pagamento'=>'30/60 dias','valor'=>'R$ 500,00','estado'=>'Aprovada','itens'=>[['Furadeira de Impacto 650W',2,'R$ 250,00','R$ 500,00',250.00]],'contas'=>[['10/10/2026','R$ 250,00','Vencida'],['09/11/2026','R$ 250,00','Em aberto']]],
 ],
 'contas_pagar' => [
  ['id'=>1,'documento'=>'NF 8841','fornecedor'=>'Seguro EPI','compra'=>'#310','vencimento'=>'19/11/2026','valor'=>'R$ 600,00','pagamento'=>'—','estado'=>'Em aberto'],
  ['id'=>2,'documento'=>'NF 8841','fornecedor'=>'Seguro EPI','compra'=>'#310','vencimento'=>'19/12/2026','valor'=>'R$ 600,00','pagamento'=>'—','estado'=>'Em aberto'],
  ['id'=>3,'documento'=>'NF 8790','fornecedor'=>'Eletro Sul','compra'=>'#309','vencimento'=>'12/10/2026','valor'=>'R$ 1.000,00','pagamento'=>'12/10/2026','estado'=>'Pago'],
  ['id'=>4,'documento'=>'NF 8702','fornecedor'=>'FixaMais','compra'=>'#305','vencimento'=>'15/10/2026','valor'=>'R$ 400,00','pagamento'=>'—','estado'=>'Vencida'],
  ['id'=>5,'documento'=>'NF 8702','fornecedor'=>'FixaMais','compra'=>'#305','vencimento'=>'14/11/2026','valor'=>'R$ 400,00','pagamento'=>'—','estado'=>'Em aberto'],
 ],
 'contas_receber' => [
  ['id'=>1,'documento'=>'PV-1039','cliente'=>'Ana Souza','venda'=>'#1039','vencimento'=>'20/10/2026','valor'=>'R$ 210,00','pagamento'=>'20/10/2026','estado'=>'Recebido'],
  ['id'=>2,'documento'=>'PV-1020','cliente'=>'Construtora Pantanal','venda'=>'#1020','vencimento'=>'17/11/2026','valor'=>'R$ 385,00','pagamento'=>'—','estado'=>'Em aberto'],
  ['id'=>3,'documento'=>'PV-1020','cliente'=>'Construtora Pantanal','venda'=>'#1020','vencimento'=>'17/12/2026','valor'=>'R$ 385,00','pagamento'=>'—','estado'=>'Em aberto'],
  ['id'=>4,'documento'=>'PV-1010','cliente'=>'Carlos Lima','venda'=>'#1010','vencimento'=>'10/10/2026','valor'=>'R$ 250,00','pagamento'=>'—','estado'=>'Vencida'],
  ['id'=>5,'documento'=>'PV-1010','cliente'=>'Carlos Lima','venda'=>'#1010','vencimento'=>'09/11/2026','valor'=>'R$ 250,00','pagamento'=>'—','estado'=>'Em aberto'],
 ],
 // Visão do fornecedor logado (Parafusos Brasil): recebe só os itens das categorias que atende.
 'forn_orcamentos' => [
  ['id'=>47,'documento'=>'ORC-0047','data'=>'27/10/2026','valor'=>'—','estado'=>'Aguardando proposta','itens'=>[['Parafuso Sextavado M10',500,'—','—',null],['Arruela Lisa M8',2000,'—','—',null]]],
  ['id'=>43,'documento'=>'ORC-0043','data'=>'25/10/2026','valor'=>'R$ 660,00','estado'=>'Em análise','itens'=>[['Parafuso Sextavado M8',1000,'R$ 0,66','R$ 660,00',0.66]]],
  ['id'=>38,'documento'=>'ORC-0038','data'=>'10/10/2026','valor'=>'R$ 525,00','estado'=>'Aprovada','itens'=>[['Parafuso Sextavado M10',500,'R$ 1,05','R$ 525,00',1.05]]],
  ['id'=>31,'documento'=>'ORC-0031','data'=>'01/10/2026','valor'=>'R$ 150,00','estado'=>'Recusada','itens'=>[['Parafuso Sextavado M8',200,'R$ 0,75','R$ 150,00',0.75]]],
 ],
];
