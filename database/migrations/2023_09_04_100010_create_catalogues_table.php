<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCataloguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->index();
            $table->text('slug');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('order');
            $table->tinyInteger('status')->default(1)->comment('0: block, 1: active');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'catalogs'
            $table->foreign('parent_id')->references('id')->on('catalogues')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'catalogs'
            $table->foreign('revision')->references('id')->on('catalogues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
