<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\RedirectResponse;
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
Route::group(['middleware' => 'auth.user'], function () {
    // ...
    Route::get('/all_products', [ProductController::class, 'all_products'])->name('all_products');
    Route::post('/store_product', [ProductController::class, 'store'])->name('store_product');
    Route::get('/discount',[DiscountController::class, 'index'])->name('discount');
    Route::post('/discount',[DiscountController::class, 'store'])->name('discount');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::post('/edit_invoice', [InvoiceController::class, 'update'])->name('invoice.update');

});

Route::fallback(function () {
    return redirect('/');
});

//Products Routes
Route::get('/', [ProductController::class, 'index']);
Route::get('/product_checkout', [ProductController::class, 'product_checkout']);


//Discounts Routes

Route::post('/coupon', [DiscountController::class, 'show']);

//Invoice Routes
Route::post('/invoice/store', [InvoiceController::class, 'store']);
Route::post('/update_invoice_detail', [InvoiceController::class,'updateInvoiceDetail']);
Route::post('/update_invoice', [InvoiceController::class,'updateInvoice']);
Route::post('/update_lead', [InvoiceController::class,'updateInvoiceLead']);
Route::post('/generate_invoice', [InvoiceController::class,'generateInvoice']);


Route::get('/dashboard/invoice', [DashboardController::class, 'index'])->name('dashboard/invoice');

//Stripe payment method integration
Route::post('payment/initiate', [StripeController::class, 'initiatePayment']);
Route::post('payment/complete', [StripeController::class, 'completePayment']);

//Auth Controller 
Route::get('/login', function () {
    return redirect('/saml2/test/login');
})->name('login');
Route::get('/logout', function () {
    session()->flush();
    return redirect('/saml2/test/logout');
})->name('logout');
//  Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class,'store'])->name('login/store');
Route::delete('login', [AuthController::class, 'destroy'])->name('login/destroy');



Route::get('/get-all-session', function(){
   
    dump(session()->all());
})->name('get-all-session');