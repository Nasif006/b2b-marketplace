<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company',
        'source', 'status', 'notes', 'assigned_to'
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public static function statusOptions(): array
    {
        return ['new', 'contacted', 'qualified', 'converted'];
    }

    public static function sourceOptions(): array
    {
        return ['manual', 'referral', 'social'];
    }
}
