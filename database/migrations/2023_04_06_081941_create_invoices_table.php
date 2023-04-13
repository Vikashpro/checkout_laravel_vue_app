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
            $table->id();
            $table->string('client_name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();            
            $table->unsignedDecimal('no_of_items',8,2)->default('0');
            $table->unsignedDecimal('sub_total',8,2)->default('0');
            $table->unsignedDecimal('discount',8,2)->default('0');
            $table->unsignedDecimal('tax',8,2)->default('0');
            $table->unsignedDecimal('payment_surcharge',8,2)->default('0');
            $table->unsignedDecimal('total',8,2)->default('0');
            $table->unsignedDecimal('paid_amount',8,2)->default('0');
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();            
            $table->string('payment_details')->nullable();
            $table->string('payment_status')->nullable();
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
