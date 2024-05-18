<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->double('amount', 10, 0);
            $table->tinyInteger('payment');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->date('date')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: refund, 1: normal');
            $table->softDeletes();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'orders'
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Tạo khóa ngoại tới bảng 'users'
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('set null');

            // Tạo khóa ngoại tới bảng 'transactions'
            $table->foreign('revision')->references('id')->on('transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
