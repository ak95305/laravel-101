<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->take(5)->get();
        return view('customer.index', compact('customers'));
    }
    
    /**
     * Load more customers via AJAX
     */
    public function loadMore(Request $request)
    {
        $skip = $request->input('skip', 0);
        $take = 5;
        
        // Get one more than we need to check if there are more records
        $customers = Customer::latest()->skip($skip)->take($take + 1)->get();
        
        $hasMore = $customers->count() > $take;
        
        // If we got more than we need, remove the extra one
        if ($hasMore) {
            $customers = $customers->slice(0, $take);
        }
        
        return response()->json([
            'customers' => $customers->values(),
            'hasMore' => $hasMore
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phonenumber' => 'required|numeric'
        ]);

        $customer = Customer::create($validated);

        // Send welcome email
        Mail::to($customer->email)->queue(new WelcomeMail($customer));

        return redirect()->route('customer.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phonenumber' => 'required|numeric'
        ]);

        $customer->update($validated);

        return redirect()->route('customer.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
