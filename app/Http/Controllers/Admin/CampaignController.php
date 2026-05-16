<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('creator')->latest()->paginate(15);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.form', ['campaign' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'type'    => 'required|in:email,sms',
            'trigger' => 'required',
            'body'    => 'required|string',
        ]);

        Campaign::create([
            'name'         => $request->name,
            'type'         => $request->type,
            'trigger'      => $request->trigger,
            'subject'      => $request->subject,
            'body'         => $request->body,
            'status'       => $request->scheduled_at ? 'scheduled' : 'draft',
            'scheduled_at' => $request->scheduled_at ?: null,
            'created_by'   => auth()->id(),
        ]);

        return redirect('/admin/campaigns')->with('success', 'Campaign created.');
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.form', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'type'    => 'required|in:email,sms',
            'trigger' => 'required',
            'body'    => 'required|string',
        ]);

        $campaign->update([
            'name'         => $request->name,
            'type'         => $request->type,
            'trigger'      => $request->trigger,
            'subject'      => $request->subject,
            'body'         => $request->body,
            'status'       => $request->scheduled_at ? 'scheduled' : 'draft',
            'scheduled_at' => $request->scheduled_at ?: null,
        ]);

        return redirect('/admin/campaigns')->with('success', 'Campaign updated.');
    }

    public function destroy($id)
    {
        Campaign::findOrFail($id)->delete();
        return redirect('/admin/campaigns')->with('success', 'Campaign deleted.');
    }

    // Mark as sent manually (demo purposes)
    public function markSent($id)
    {
        Campaign::findOrFail($id)->update(['status' => 'sent']);
        return redirect()->back()->with('success', 'Campaign marked as sent.');
    }
}
