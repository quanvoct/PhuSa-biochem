<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('code',128)->comment('slug');
            $table->string('name',128)->default('Vô danh');
            $table->unsignedBigInteger('sort')->default(1);
            $table->tinyInteger('status')->default(1)->comment('0: hidden, 1: visible');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'categories'
            $table->foreign('revision')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
