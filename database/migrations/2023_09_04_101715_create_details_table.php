<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('variable_id')->index();
            $table->unsignedInteger('quantity');
            $table->unsignedDecimal('price', 10, 0);
            $table->tinyInteger('status')->default(1)->comment('0: hidden; 1: show');
            $table->unsignedBigInteger('revision')->nullable();
            $table->timestamp('appointmented_at')->nullable();
            $table->softDeletes(); 
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'orders'
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'variables'
            $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'details'
            $table->foreign('revision')->references('id')->on('details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details');
    }
}
