<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use App\Models\Product;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;


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
         return response()->json(['invoice' => $invoice]);
        // return  inertia('Product/Index',['invoice'=>$invoice, 'products'=>Product::all()])->with('success','Lead added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $invoice = Invoice::with(['invoiceDetail'=>function ($query) {
            $query->where('quantity', '>', 0);
                }, 'invoiceDetail.product'])
            ->where('id', $id)->get();
            return  inertia('Invoice/Edit',['invoice'=>$invoice[0]]);

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
    public function update(Request $request)
    {
        $invoice = Invoice::find($request->data['id']);
        $invoice->client_name = $request->data['client_name'];
        $invoice->company = $request->data['company']; 
        $invoice->address = $request->data['address'];
        $invoice->email = $request->data['email']; 
        $invoice->phone = $request->data['phone']; 
        $invoice->sub_total = $request->data['sub_total']; 
        $invoice->discount = $request->data['discount']; 
        $invoice->tax = $request->data['tax']; 
        $invoice->payment_surcharge = $request->data['payment_surcharge']; 
        $invoice->total = $request->data['total']; 
        $invoice->paid_amount = $request->data['paid_amount']; 
        $invoice->payment_method = $request->data['payment_method']; 
        $invoice->payment_id = $request->data['payment_id']; 
        $invoice->payment_status = $request->data['payment_status'];
         $invoice->save();

        foreach ($request->data['invoice_detail'] as $invoice_detail) {
            $inv_d = InvoiceDetail::find($invoice_detail['id']);
            $inv_d->quantity = $invoice_detail['quantity'];
            $inv_d->price = $invoice_detail['price'];
            $inv_d->save();
        }
    return  inertia('Dashboard/Index',['invoices'=>Invoice::all()]);
    

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

        $html = view('invoice', ['invoice' => $invoice])->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);
    
        $pdf->render();
    
        $output = $pdf->output();
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="invoice.pdf"'
        ];
    
        return response()->make($output, 200, $headers);
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
