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
use Mail;

  

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
    {   $deleteItems = $request->data['deleteItems'];
        foreach ($deleteItems as $item) {
            $del = InvoiceDetail::find($item['id']);
            $del->delete();
        }
        $inv = $request->data['invoice'];
        $invoice = Invoice::find($inv['id']);
        $invoice->client_name = $inv['client_name'];
        $invoice->company = $inv['company']; 
        $invoice->address = $inv['address'];
        $invoice->email = $inv['email']; 
        $invoice->phone = $inv['phone']; 
        $invoice->sub_total = $inv['sub_total']; 
        $invoice->discount = $inv['discount']; 
        $invoice->tax = $inv['tax']; 
        $invoice->payment_surcharge = $inv['payment_surcharge']; 
        $invoice->total = $inv['total']; 
        $invoice->paid_amount = $inv['paid_amount']; 
        $invoice->payment_method = $inv['payment_method']; 
        $invoice->payment_id = $inv['payment_id']; 
        $invoice->payment_status = $inv['payment_status'];
         $invoice->save();

        foreach ($inv['invoice_detail'] as $invoice_detail) {
            if(array_key_exists('id', $invoice_detail)){
                $inv_d = InvoiceDetail::find($invoice_detail['id']);
                $inv_d->quantity = $invoice_detail['quantity'];
                $inv_d->price = $invoice_detail['price'];
                $inv_d->save();
            }else if(array_key_exists('product_id', $invoice_detail) && array_key_exists('quantity', $invoice_detail) && array_key_exists('price', $invoice_detail)){
                if($invoice_detail['product_id'] != null && $invoice_detail['quantity'] != null && $invoice_detail['price'] != null){
                    InvoiceDetail::create([
                        'invoice_id' => $inv['id'],
                        'product_id' => $invoice_detail['product_id'],
                        'quantity' => $invoice_detail['quantity'],
                        'price' => $invoice_detail['price']
                    ]);
                }
            }
           
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
  public function show_invoice($id)
{
    $invoice = Invoice::with(['invoiceDetail'=>function ($query) {
        $query->where('quantity', '>', 0);
    }, 'invoiceDetail.product'])
    ->where('id', $id)
    ->get()[0];

    $html = view('invoice', ['invoice' => $invoice])->render();

    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    $pdf->render();
    $pdfData = $pdf->output();

    $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function() use ($pdfData) {
        echo $pdfData;
    }, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="invoice.pdf"',
    ]);
    
    return Response::stream(function() use ($pdfData) {
        echo $pdfData;
    }, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="invoice.pdf"',
    ]);
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

    public function sendEmail(Request $request)
{

    $invoice = Invoice::with(['invoiceDetail'=>function ($query) {
        $query->where('quantity', '>', 0);
    }, 'invoiceDetail.product'])
    ->where('id', $request->invoice_id)
    ->get()[0];
    $data["email"] = $invoice->email;
    $data["title"] = env('MAIL_TITLE');
    $dompdf = new Dompdf();
    $dompdf->loadHtml(view('invoice', ['invoice' => $invoice])->render());
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $pdf = $dompdf->output();
 
    // Attach PDF to email
    Mail::send([], [], function ($message) use ($data, $pdf) {
        $message->to($data["email"])
            ->subject($data["title"])
            ->attachData($pdf, 'invoice.pdf', [
                'mime' => 'application/pdf',
            ]);
    });
    
    return Response()->json(["message"=>"email sent"]);
}
}
