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
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();            
            $table->unsignedSmallInteger('no_of_items')->nullable();
            $table->unsignedSmallInteger('sub_total')->nullable();
            $table->unsignedSmallInteger('discount')->nullable();
            $table->unsignedSmallInteger('tax')->nullable();
            $table->unsignedSmallInteger('payment_surcharge')->nullable();
            $table->unsignedSmallInteger('total')->nullable();
            $table->unsignedSmallInteger('paid_amount')->nullable();
            $table->unsignedSmallInteger('payment_method')->nullable();
            $table->unsignedSmallInteger('payment_details')->nullable();
            $table->unsignedSmallInteger('payment_status')->nullable();
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
