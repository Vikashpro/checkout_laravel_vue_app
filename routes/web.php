<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index']);
Route::post('/coupon', [DiscountController::class, 'show']);
Route::post('/invoice/store', [InvoiceController::class, 'store']);
Route::post('/update_invoice_detail', [InvoiceController::class,'updateInvoiceDetail']);
Route::post('/update_invoice', [InvoiceController::class,'updateInvoice']);
Route::post('/update_lead', [InvoiceController::class,'updateInvoiceLead']);
//Stripe payment method integration
Route::post('payment/initiate', [StripeController::class, 'initiatePayment']);
Route::post('payment/complete', [StripeController::class, 'completePayment']);

