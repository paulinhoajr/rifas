<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampanhaBilhete extends Model
{
    use HasFactory;

    protected $table = 'campanhas_bilhetes';

    protected $primaryKey = 'id';

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

}
