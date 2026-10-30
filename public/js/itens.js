// Tabela de itens reutilizável (somente visual).
// modo: 'compra' (valor unitário editável) | 'venda' (valor de venda fixo, da categoria) | 'solicitacao' (orçamento de compra: só produto e quantidade).
const brl = n => n.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
const num = s => { s = String(s).trim(); if (s.includes(',')) s = s.replace(/\./g, '').replace(',', '.'); return parseFloat(s) || 0; };
const fmt = n => n.toFixed(2).replace('.', ',');
function itensTabela(tb, P, modo, ini, cb) {
  const ed = modo === 'compra', ref = modo === 'solicitacao';
  const un = p => modo === 'venda' ? p.venda_n : p.compra_n;
  function preencher(tr) { const p = P[tr.querySelector('.p').value]; tr.querySelector('.cat').textContent = p.categoria; tr.querySelector('.u').value = fmt(un(p)); }
  function ler() { return [...tb.rows].map(tr => ({p: P[tr.querySelector('.p').value], q: +tr.querySelector('.q').value || 0, u: num(tr.querySelector('.u').value), tr})); }
  function recalc() {
    const it = ler(); let tot = 0;
    it.forEach(x => { const t = x.q * x.u; tot += t; x.tr.querySelector('.t').textContent = ref ? '—' : brl(t); });
    if (cb) cb(it, tot); return tot;
  }
  function add(i, q, u) {
    const tr = document.createElement('tr');
    tr.innerHTML = '<td><select class="form-select p" aria-label="Produto">' + P.map((p, k) => '<option value="' + k + '">' + p.descricao + '</option>').join('') + '</select></td><td class="cat"></td><td><input type="number" min="1" value="' + q + '" class="form-control q" aria-label="Quantidade"></td><td><input class="form-control u" aria-label="Valor unitário"></td><td class="t">—</td><td><button type="button" class="btn btn-sm btn-outline-danger x" aria-label="Remover item"><i class="bi bi-x"></i></button></td>';
    tr.querySelector('.p').value = i; tr.querySelector('.u').readOnly = !ed;
    tb.appendChild(tr); preencher(tr);
    if (u !== null && u !== undefined && ed) tr.querySelector('.u').value = fmt(u);
    recalc();
  }
  tb.addEventListener('change', e => { if (e.target.classList.contains('p')) preencher(e.target.closest('tr')); recalc(); });
  tb.addEventListener('input', recalc);
  tb.addEventListener('click', e => { const x = e.target.closest('.x'); if (x && tb.rows.length > 1) { x.closest('tr').remove(); recalc(); } });
  (ini && ini.length ? ini : [[0, 1, null]]).forEach(([i, q, u]) => add(i, q, u));
  return {add: () => add(0, 1, null), ler, recalc};
}
// Parcelas geradas pela forma de pagamento: cada item (porcentagem, dia) vira uma parcela.
function parcelasHtml(F, idx, dataIso, tot) {
  const f = F[idx], d0 = new Date(dataIso + 'T12:00:00');
  return f.itens.map(([pc, dia], i) => { const d = new Date(d0); d.setDate(d.getDate() + dia); return '<tr><td>' + (i + 1) + '</td><td>' + d.toLocaleDateString('pt-BR') + '</td><td>' + pc + '%</td><td>' + brl(tot * pc / 100) + '</td></tr>'; }).join('');
}
