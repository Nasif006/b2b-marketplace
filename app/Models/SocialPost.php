<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    protected $fillable = [
        'platform', 'content', 'status',
        'scheduled_at', 'posted_at', 'likes', 'comments', 'created_by'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'posted_at'    => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function platformOptions(): array
    {
        return ['facebook' => 'Facebook', 'instagram' => 'Instagram'];
    }
}
