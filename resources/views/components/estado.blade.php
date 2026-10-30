@props(['v'])
@php($cor = match ($v) {
    'Aprovada', 'Pago', 'Recebido', 'Estoque normal' => 'success',
    'Recusada', 'Vencida', 'Abaixo do mínimo' => 'danger',
    'Em análise' => 'primary',
    default => 'warning', // Pendente, Aguardando proposta, Em aberto
})
<span class="badge text-bg-{{ $cor }}">{{ $v }}</span>
