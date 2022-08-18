<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->foreignId('category_id');
            $table->foreignId('vendor_id');
            $table->foreignId('subcatagory_id');
            $table->foreignId('brand_id')->nullable();
            $table->tinyInteger('discount')->nullable()->comment('discount percent');
            $table->string('regular_price');
            $table->string('sale_price')->nullable()->comment('discount_price');
            $table->string('thumbnail_img');
            $table->string('status')->default(1)->comment('1=active , 2=Inactive');
            $table->tinyInteger('fetured')->default(0)->comment('0=fetured,1=unfetured');
            $table->tinyInteger('trending')->default(0)->comment('0=trending,1=untrending');
            $table->text('product_summary');
            $table->text('product_description');
            $table->timestamps();

            $table->index('slug');
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
        Schema::dropIfExists('products');
    }
}
