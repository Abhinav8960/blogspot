<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'image',
        'email',
        'message',
        'status'
    ];

    public function getStatusMetaAttribute()
    {
        return match ($this->status) {
            1 => ['label' => 'Active', 'class' => 'bg-success text-white'],
            0 => ['label' => 'Inactive', 'class' => 'bg-warning text-white'],
            -1 => ['label' => 'Deleted', 'class' => 'bg-danger text-white'],
            default => ['label' => 'Unknown', 'class' => 'bg-secondary text-white'],
        };
    }
}
