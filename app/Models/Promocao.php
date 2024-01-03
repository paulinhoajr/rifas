<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    protected $table = 'promocoes';

    protected $primaryKey = 'id';

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }

}
