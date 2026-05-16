<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name', 'type', 'status', 'trigger',
        'subject', 'body', 'scheduled_at', 'created_by'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function typeOptions(): array
    {
        return ['email' => 'Email', 'sms' => 'SMS'];
    }

    public static function triggerOptions(): array
    {
        return [
            'manual'           => 'Manual',
            'order_placed'     => 'Order Placed',
            'user_registered'  => 'User Registered',
            'abandoned_cart'   => 'Abandoned Cart',
        ];
    }

    public static function statusOptions(): array
    {
        return ['draft', 'scheduled', 'sent', 'cancelled'];
    }
}
