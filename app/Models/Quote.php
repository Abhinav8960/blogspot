<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quotes'; //  #89D8FC

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];
}
