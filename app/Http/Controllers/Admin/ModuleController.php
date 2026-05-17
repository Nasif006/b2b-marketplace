<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModuleSetting;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = ModuleSetting::all();
        return view('admin.modules.index', compact('modules'));
    }

    public function toggle($id)
    {
        $module = ModuleSetting::findOrFail($id);
        $module->update(['is_enabled' => !$module->is_enabled]);
        return redirect()->back()->with('success', "Module [{$module->label}] " . ($module->is_enabled ? 'enabled' : 'disabled') . '.');
    }
}
