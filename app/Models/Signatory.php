<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signatory extends Model 
{
    protected $table = 'signatories';

    protected $fillable = ['name', 'position_id', 'phone', 'mobile', 'email'];
}
