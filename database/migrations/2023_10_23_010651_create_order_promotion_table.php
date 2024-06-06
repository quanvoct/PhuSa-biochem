<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_promotion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('promotion_id')->nullable();

            // Tạo khóa ngoại tới bảng 'orders'
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'promotions'
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_promotion');
    }
}
