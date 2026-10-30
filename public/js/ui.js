// Comportamentos apenas visuais: toasts, exclusão simulada e formulários demonstrativos.
function toast(msg, tipo = 'success') {
  const c = document.getElementById('toasts'), t = document.createElement('div');
  t.className = 'toast align-items-center text-bg-' + tipo + ' border-0 show';
  t.setAttribute('role', 'status');
  t.innerHTML = '<div class="d-flex"><div class="toast-body"></div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button></div>';
  t.querySelector('.toast-body').textContent = msg;
  c.appendChild(t); setTimeout(() => t.remove(), 3500);
}
document.addEventListener('click', e => {
  const b = e.target.closest('[data-demo]');
  if (b && b.tagName !== 'FORM') { if (b.tagName === 'A') e.preventDefault(); toast(b.dataset.demo); }
  const x = e.target.closest('[data-excluir]');
  if (x) { document.getElementById('nomeExcluir').textContent = x.dataset.excluir; new bootstrap.Modal('#modalExcluir').show(); }
});
document.addEventListener('submit', e => {
  const f = e.target; if (!f.hasAttribute('data-demo')) return;
  e.preventDefault();
  if (!f.checkValidity()) { f.classList.add('was-validated'); toast('Verifique os campos obrigatórios.', 'danger'); return; }
  toast(f.dataset.demo || 'Salvo (simulação).');
  if (f.dataset.vai) setTimeout(() => location.href = f.dataset.vai, 1200);
});
