<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;

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
        // return response()->json(['id' => $invoice->id]);
          return  inertia('Product/Index',['invoice'=>$invoice, 'products'=>Product::all()])->with('success','Lead added Successfully');
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
    public function updateInvoiceDetail(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
    
        $record = InvoiceDetail::where('invoice_id', $invoice_id)
                         ->where('product_id', $product_id)
                         ->first();
        
        if (is_null($record)) {
            // create new record
            InvoiceDetail::create([
                'invoice_id' => $invoice_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
            ]);

        } else {
            // update existing record
            $record->quantity = $quantity;
            $record->price = $price;
            $record->save();
        }
        return response()->json(["message"=>"quantity with price updated successfully"]);
    }

    public function updateInvoice(Request $request)
    {
       
    
        $invoice = Invoice::find($request->invoice_id);
        $invoice->sub_total=$request->subTotal;
        $invoice->discount =$request->discount;
        $invoice->tax =$request->taxAmount;
        $invoice->payment_surcharge =$request->surchargeAmount;
        $invoice->total =$request->totalAmount;
        $invoice->save();
        return response()->json(["message"=>"invoice updated successfully"]);
    }

    public function generateInvoice(Request $request)
    {
       
        $invoice = Invoice::with(['invoiceDetail'=>function ($query) {
            $query->where('quantity', '>', 0);
                }, 'invoiceDetail.product'])
            ->where('id', $request->invoice_id)->get();
        $invoice = $invoice[0];

        // return response()->json(["invoice"=>$invoice]);

        $html = view('pdf/invoice', ['invoice' => $invoice])->render();

        // Create a new instance of Dompdf and load the HTML
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
    
        // Render the PDF
        $pdf->render();
    
        // Return the PDF contents as a response
        return response()->json(['pdfUrl' => 'data:application/pdf;base64,' . base64_encode($pdf->output())]);
    }
   
    public function updateInvoiceLead(Request $request)
    {
       
    
        $invoice = Invoice::find($request->id);
        $request->validate([
            'client_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        $invoice->client_name = $request->client_name;
        $invoice->company = $request->company;
        $invoice->email = $request->email;
        $invoice->phone = $request->phone;
        $invoice->address = $request->address;
        $invoice->payment_method = $request->payment_method;
        $invoice->payment_status = $request->payment_status;
        $invoice->save();
        return response()->json(["message"=>"invoice updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
