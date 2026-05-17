<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleSetting extends Model
{
    protected $fillable = ['key', 'label', 'is_enabled'];

    protected $casts = ['is_enabled' => 'boolean'];

    public static function isEnabled(string $key): bool
    {
        $module = self::where('key', $key)->first();
        return $module ? $module->is_enabled : true;
    }
}
