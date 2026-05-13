<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Interaction;
use App\Models\Order;
use Illuminate\Http\Request;

class CrmController extends Controller
{
    // ── CUSTOMERS ──

    public function customers()
    {
        $customers = Customer::with('user')
            ->withCount('interactions')
            ->latest()
            ->paginate(15);

        return view('admin.crm.customers', compact('customers'));
    }

    public function customerShow($id)
    {
        $customer = Customer::with([
            'user',
            'user.orders.items.product',
            'interactions.loggedBy'
        ])->findOrFail($id);

        // recalculate segment on view
        $customer->recalculateSegment();

        $totalSpent = $customer->user->orders()
            ->where('payment_status', 'paid')
            ->sum('total');

        return view('admin.crm.customer-show', compact('customer', 'totalSpent'));
    }

    public function interactionStore(Request $request, $customerId)
    {
        $request->validate([
            'type' => 'required|in:note,call,order,rfq,message',
            'body' => 'required|string|max:1000',
        ]);

        Interaction::create([
            'customer_id' => $customerId,
            'user_id'     => auth()->id(),
            'type'        => $request->type,
            'body'        => $request->body,
        ]);

        return redirect()->back()->with('success', 'Interaction logged.');
    }

    // ── LEADS ──

    public function leads()
    {
        $leads = Lead::with('assignedTo')->latest()->paginate(15);
        return view('admin.crm.leads', compact('leads'));
    }

    public function leadCreate()
    {
        return view('admin.crm.lead-form', ['lead' => null]);
    }

    public function leadStore(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'nullable|email',
            'phone'  => 'nullable|string|max:20',
            'company'=> 'nullable|string|max:255',
            'source' => 'required|in:manual,referral,social',
            'status' => 'required|in:new,contacted,qualified,converted',
            'notes'  => 'nullable|string|max:1000',
        ]);

        Lead::create($request->only([
            'name','email','phone','company','source','status','notes'
        ]));

        return redirect('/admin/crm/leads')->with('success', 'Lead added.');
    }

    public function leadEdit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('admin.crm.lead-form', compact('lead'));
    }

    public function leadUpdate(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'nullable|email',
            'phone'  => 'nullable|string|max:20',
            'company'=> 'nullable|string|max:255',
            'source' => 'required|in:manual,referral,social',
            'status' => 'required|in:new,contacted,qualified,converted',
            'notes'  => 'nullable|string|max:1000',
        ]);

        $lead->update($request->only([
            'name','email','phone','company','source','status','notes'
        ]));

        return redirect('/admin/crm/leads')->with('success', 'Lead updated.');
    }

    public function leadDestroy($id)
    {
        Lead::findOrFail($id)->delete();
        return redirect('/admin/crm/leads')->with('success', 'Lead deleted.');
    }
}
