<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->index();
            $table->unsignedBigInteger('product_id');
            $table->string('sub_sku')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 191)->nullable();
            $table->unsignedDecimal('price', 10, 2)->nullable();
            $table->unsignedInteger('stock')->nullable();
            $table->double('width', 6, 2)->nullable();
            $table->double('height', 6, 2)->nullable();
            $table->double('length', 6, 2)->nullable();
            $table->double('weight', 6, 2)->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'products'
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'variables'
            $table->foreign('revision')->references('id')->on('variables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variables');
    }
}
