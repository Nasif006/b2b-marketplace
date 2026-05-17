<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->latest()->get();
        return view('buyer.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('buyer.tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body'    => 'required|string|max:2000',
        ]);

        Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'body'    => $request->body,
            'status'  => 'open',
        ]);

        return redirect('/tickets')->with('success', 'Ticket submitted. We will respond shortly.');
    }
}
