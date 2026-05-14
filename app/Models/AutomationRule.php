<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomationRule extends Model
{
    protected $fillable = [
        'name', 'trigger', 'action', 'conditions', 'payload', 'is_active'
    ];

    protected $casts = [
        'conditions' => 'array',
        'payload'    => 'array',
        'is_active'  => 'boolean',
    ];

    public function logs()
    {
        return $this->hasMany(WorkflowLog::class)->latest();
    }

    public static function triggerOptions(): array
    {
        return [
            'order_placed'     => 'Order Placed',
            'user_registered'  => 'User Registered',
            'order_confirmed'  => 'Order Confirmed',
            'abandoned_cart'   => 'Abandoned Cart',
        ];
    }

    public static function actionOptions(): array
    {
        return [
            'send_email'       => 'Send Email',
            'send_sms'         => 'Send SMS',
            'notify_supplier'  => 'Notify Supplier',
            'log_interaction'  => 'Log Interaction',
        ];
    }
}
