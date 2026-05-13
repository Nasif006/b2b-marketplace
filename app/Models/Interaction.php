<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = ['customer_id', 'user_id', 'type', 'body'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function loggedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
