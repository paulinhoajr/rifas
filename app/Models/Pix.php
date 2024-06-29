<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pix extends Model
{
    protected $table = 'pixs';

    protected $primaryKey = 'id';

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }

}
