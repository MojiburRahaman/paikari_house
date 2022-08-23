<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('division_name');
            $table->foreignId('district_name');
            $table->string('order_number');
            $table->string('billing_user_name');
            $table->string('user_email');
            $table->string('billing_number');
            $table->text('billing_address');
            $table->text('billing_order_note')->nullable();
            $table->string('payment_option');
            $table->timestamps();

            $table->index('user_id');
            $table->index('order_number');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_details');
    }
}
