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
            $table->string('name', 191)->index();
            $table->string('sku', 191)->default(0)->nullable();
            $table->text('slug');
            $table->unsignedBigInteger('author_id')->nullable()->default(1);
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->text('gallery')->nullable();
            $table->unsignedInteger('sort');
            $table->string('unit', 191)->nullable();
            $table->text('specs')->nullable();
            $table->string('keyword', 191)->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: block, 1: active, 2: featured');
            $table->tinyInteger('allow_review')->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->softDeletes(); 
            $table->timestamps();


            // Tạo khóa ngoại tới bảng 'users'
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');

            // Tạo khóa ngoại tới bảng 'products'
            $table->foreign('revision')->references('id')->on('products')->onDelete('cascade');
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
