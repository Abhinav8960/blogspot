<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quotes'; //  #2b2278

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];
}
