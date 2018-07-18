<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishExchange extends Model
{
    protected $primaryKey = 'ExChangeCode';
    protected $table='fishexchange';
    public $timestamps = false;
    public $incrementing = false;
}
