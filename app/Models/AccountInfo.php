<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountInfo extends Model
{
    protected $primaryKey = 'UserID';
    protected $table='accountinfo';
    public $timestamps = false;

}
