<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Categoria;

class Produto extends Model
{
    protected $table = 'produtos';

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    protected $fillable = [
        'nome',
        'embalagem',
        'qtde_estoque',
        'codigo_barra',
        'valor_compra',
        'valor_venda',
        'categoria_id',
        'qtde_minima',
        'qtde_maxima'
    ];
}
