<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->text('name');
            $table->text('address');
            $table->string('country', 191)->nullable();
            $table->string('city', 191)->nullable();
            $table->string('district', 191)->nullable();
            $table->string('zip', 191)->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('bol_no')->nullable();
            $table->integer('service')->nullable();
            $table->double('fee', 10, 0)->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: waiting, 1: done');
            $table->unsignedBigInteger('revision')->nullable();
            $table->softDeletes(); 
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'orders'
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'deliveries'
            $table->foreign('revision')->references('id')->on('deliveries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
