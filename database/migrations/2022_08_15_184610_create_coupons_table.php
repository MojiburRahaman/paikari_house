<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id');
            $table->string('coupon_name');
            $table->integer('discount');
            $table->date('expire_date');
            $table->tinyInteger('status')->default(1)->comment('1= active,2=Inactive');
            $table->integer('user_limit')->nullable();
            $table->timestamps();


            $table->index('vendor_id');
            $table->index('coupon_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
