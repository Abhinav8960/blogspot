<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    protected $dates = ['deleted_at']; // optional (Laravel 10 me auto ho jata h)


    public function getStatusMetaAttribute()
    {
        return match ($this->status) {
            1 => ['label' => 'Active', 'class' => 'bg-success text-white'],
            0 => ['label' => 'Inactive', 'class' => 'bg-warning text-white'],
            -1 => ['label' => 'Deleted', 'class' => 'bg-danger text-white'],
            default => ['label' => 'Unknown', 'class' => 'bg-secondary text-white'],
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
