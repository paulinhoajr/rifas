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

}
