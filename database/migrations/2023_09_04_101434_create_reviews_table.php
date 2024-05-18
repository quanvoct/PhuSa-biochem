<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->string('name');
            $table->string('phone');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('rating');
            $table->text('content');
            $table->text('images')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable()->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: block, 1: active');
            $table->unsignedBigInteger('revision')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'reviews'
            $table->foreign('parent_id')->references('id')->on('reviews')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'reviews'
            $table->foreign('revision')->references('id')->on('reviews')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'products'
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
