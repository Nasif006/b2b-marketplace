<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkflowLog extends Model
{
    protected $fillable = [
        'automation_rule_id', 'trigger', 'action',
        'status', 'details', 'triggerable_id', 'triggerable_type'
    ];

    public function rule()
    {
        return $this->belongsTo(AutomationRule::class, 'automation_rule_id');
    }

    public function triggerable()
    {
        return $this->morphTo();
    }
}
