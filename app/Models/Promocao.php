<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promocao extends Model
{
    use SoftDeletes;

    protected $table = 'promocoes';

    protected $primaryKey = 'id';

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }

}
