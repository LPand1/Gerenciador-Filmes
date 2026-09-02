<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filme extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'titulo',
        'sinopse',
        'ano',
        'categoria_id',
        'user_id',
        'imagem_capa',
        'link_trailer',
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
