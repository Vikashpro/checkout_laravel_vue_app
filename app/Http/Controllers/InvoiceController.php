<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('Invoice/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'client_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        $invoice = new Invoice();
        $invoice->client_name = $request->client_name;
        $invoice->company = $request->company;
        $invoice->email = $request->email;
        $invoice->phone = $request->phone;
        $invoice->address = $request->address;
        $invoice->save();
        // response()->json(['message' => 'Data saved successfully', 'invoice'=>$invoice]);
         return  inertia('Invoice/Create',['invoice'=>$invoice])->with('success','its done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
