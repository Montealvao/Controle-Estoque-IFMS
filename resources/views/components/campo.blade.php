@props(['id', 'label', 'type' => 'text', 'value' => '', 'req' => true, 'ajuda' => null])
<div class="mb-3">
  <label class="form-label" for="{{ $id }}">{{ $label }}@if($req) <span class="text-danger">*</span>@endif</label>
  <input type="{{ $type }}" class="form-control" id="{{ $id }}" value="{{ $value }}" @required($req) {{ $attributes }}>
  @if($ajuda)<div class="form-text">{{ $ajuda }}</div>@endif
  <div class="invalid-feedback">Campo obrigatório ou inválido.</div>
</div>
