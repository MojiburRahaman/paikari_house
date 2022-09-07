<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->index();
            $table->foreignId('order_summary_id')->index();
            $table->string('order_number')->index();
            $table->string('total_price');
            $table->string('discount_amount')->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('coupon_name')->nullable();
            $table->integer('delivery_status')->default(1)->comment('1=pending,2=on_the_way.3=complete');
            $table->integer('payment_status')->default(1)->comment('1=unpaid,2=paid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
