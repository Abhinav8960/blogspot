<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeSearch(Builder $query, $request)
    {
        return $query
            ->when($request->filled('name'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->filled('email'), function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            })
            ->when($request->filled('phone'), function ($q) use ($request) {
                $q->where('phone', 'like', '%' . $request->phone . '%');
            });
    }
}
