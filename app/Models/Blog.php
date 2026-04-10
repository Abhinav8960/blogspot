<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'public_id',
        'featured_video',
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    // Blog author
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Admin who approved
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }


    // Only approved blogs
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Only published blogs
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    // Pending approval
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }


    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : null;
    }
}
