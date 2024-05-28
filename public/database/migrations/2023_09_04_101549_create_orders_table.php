<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Đặt cột 'id' làm khóa chính
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable()->index();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->unsignedBigInteger('method')->notNull();
            $table->unsignedBigInteger('discount')->default(0);
            $table->tinyInteger('status')->notNull()->default(1)->comment('0: cancelled; 1: ordered; 2: processing; 2: done');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'users'
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');

            // Tạo khóa ngoại tới bảng 'users'
            $table->foreign('dealer_id')->references('id')->on('users')->onDelete('set null');

            // Tạo khóa ngoại tới bảng 'orders'
            $table->foreign('revision')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
