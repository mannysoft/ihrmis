<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayGroup extends Model 
{
    protected $table = 'pay_groups';

    protected $fillable = ['name', 'company_id'];


}
