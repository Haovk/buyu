<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishMail extends Model
{
    protected $primaryKey = 'MailID';
    protected $table='fishmail';
    public $timestamps = false;

}
