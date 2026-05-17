<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->latest()->paginate(20);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with('user')->findOrFail($id);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'admin_response' => 'required|string|max:2000',
            'status'         => 'required|in:open,in_progress,closed',
        ]);

        Ticket::findOrFail($id)->update([
            'admin_response' => $request->admin_response,
            'status'         => $request->status,
            'responded_at'   => now(),
        ]);

        return redirect()->back()->with('success', 'Response saved.');
    }
}
