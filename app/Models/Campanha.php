<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campanha extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'campanhas';

    protected $primaryKey = 'id';

    public function bilhete()
    {
        return $this->belongsTo(Bilhete::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function sorteio()
    {
        return $this->belongsTo(Sorteio::class);
    }

    public function imagens()
    {
        return $this->hasMany(Imagem::class);
    }
}
