<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'subject', 'body',
        'status', 'admin_response', 'responded_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function statusOptions(): array
    {
        return ['open', 'in_progress', 'closed'];
    }
}
