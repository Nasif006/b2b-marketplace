<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id', 'phone', 'company', 'address', 'segment', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class)->latest();
    }

    public function recalculateSegment()
    {
        $total = $this->user->orders()->where('payment_status', 'paid')->sum('total');

        if ($total >= 50000) {
            $this->segment = 'vip';
        } elseif ($total >= 10000) {
            $this->segment = 'regular';
        } else {
            $this->segment = 'new';
        }

        $this->save();
    }
}
