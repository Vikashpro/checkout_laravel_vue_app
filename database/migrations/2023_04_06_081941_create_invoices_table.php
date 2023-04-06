<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('invoice_no');
            $table->string('client_name');
            $table->string('company');
            $table->string('email');
            $table->string('phone');
            $table->unsignedSmallInteger('no_of_items');
            $table->unsignedSmallInteger('sub_total');
            $table->unsignedSmallInteger('discount');
            $table->unsignedSmallInteger('tax');
            $table->unsignedSmallInteger('payment_surcharge');
            $table->unsignedSmallInteger('total');
            $table->unsignedSmallInteger('paid_amount');
            $table->unsignedSmallInteger('payment_method');
            $table->unsignedSmallInteger('payment_details');
            $table->unsignedSmallInteger('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
