<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tables', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->foreignId('Order_Summaries_id');
            $table->foreignId('product_id');
            $table->foreignId('vendor_id');
            $table->foreignId('customer_id');
            $table->string('regular_price');
            $table->string('sale_price')->nullable();
            $table->string('discount')->nullable();
            $table->string('quantity');
            $table->timestamps();

            $table->index('product_id');
            $table->index('vendor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_tables');
    }
}
