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

    public function getStatusMetaAttribute()
    {
        $statusMeta = [
            'draft' => ['label' => 'Draft', 'class' => 'badge-secondary'],
            'pending' => ['label' => 'Pending', 'class' => 'badge-warning'],
            'approved' => ['label' => 'Approved', 'class' => 'badge-success'],
            'rejected' => ['label' => 'Rejected', 'class' => 'badge-danger'],
            'deleted' => ['label' => 'Deleted', 'class' => 'badge-dark'],
            'restored' => ['label' => 'Restored', 'class' => 'badge-info'],
            'published' => ['label' => 'Published', 'class' => 'badge-primary'],
        ];

        return $statusMeta[$this->status] ?? ['label' => ucfirst($this->status), 'class' => 'badge-secondary'];
    }

    public function getPublishMetaAttribute()
    {
        $is_published = [
            '1' => ['label' => 'Published', 'class' => 'badge-success'],
            '0' => ['label' => 'Unpublished', 'class' => 'badge-secondary'],
        ];
        return $is_published[$this->is_published] ?? ['label' => ucfirst($this->is_published), 'class' => 'badge-secondary'];
    }

    public function getUserBlogsWithStatus($userId, $status = null)
    {
        $query = self::where('user_id', $userId);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('id', 'desc')->paginate(6);
    }

    public function getStatusBadge()
    {
        return match ($this->status) {
            'published' => '<button class="btn btn-sm" style="background:#EAF3DE; color:#3B6D11; border:1px solid #639922; border-radius:20px; font-size:12px; font-weight:600; padding:4px 12px; cursor:default;">
                            &#10003; Published
                        </button>',

            'pending' => '<button class="btn btn-sm" style="background:#FAEEDA; color:#854F0B; border:1px solid #BA7517; border-radius:20px; font-size:12px; font-weight:600; padding:4px 12px; cursor:default;">
                            &#9679; Pending
                      </button>',

            'rejected' => '<button class="btn btn-sm" style="background:#FCEBEB; color:#A32D2D; border:1px solid #E24B4A; border-radius:20px; font-size:12px; font-weight:600; padding:4px 12px; cursor:default;">
                            &#10007; Rejected
                       </button>',

            'draft' => '<button class="btn btn-sm" style="background:#F1EFE8; color:#5F5E5A; border:1px solid #888780; border-radius:20px; font-size:12px; font-weight:600; padding:4px 12px; cursor:default;">
                        &#9679; Draft
                    </button>',

            default => '<span class="badge badge-secondary">Unknown</span>',
        };
    }
}
