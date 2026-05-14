<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AutomationRule;
use App\Models\WorkflowLog;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    public function rules()
    {
        $rules = AutomationRule::withCount('logs')->latest()->get();
        return view('admin.automation.rules', compact('rules'));
    }

    public function ruleCreate()
    {
        return view('admin.automation.rule-form', ['rule' => null]);
    }

    public function ruleStore(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'trigger' => 'required|in:order_placed,user_registered,order_confirmed,abandoned_cart',
            'action'  => 'required|in:send_email,send_sms,notify_supplier,log_interaction',
        ]);

        AutomationRule::create([
            'name'      => $request->name,
            'trigger'   => $request->trigger,
            'action'    => $request->action,
            'payload'   => [
                'subject' => $request->payload_subject,
                'message' => $request->payload_message,
            ],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect('/admin/automation/rules')->with('success', 'Rule created.');
    }

    public function ruleToggle($id)
    {
        $rule = AutomationRule::findOrFail($id);
        $rule->update(['is_active' => !$rule->is_active]);
        return redirect()->back()->with('success', 'Rule status updated.');
    }

    public function ruleDestroy($id)
    {
        AutomationRule::findOrFail($id)->delete();
        return redirect('/admin/automation/rules')->with('success', 'Rule deleted.');
    }

    public function logs()
    {
        $logs = WorkflowLog::with('rule')->latest()->paginate(20);
        return view('admin.automation.logs', compact('logs'));
    }
}
