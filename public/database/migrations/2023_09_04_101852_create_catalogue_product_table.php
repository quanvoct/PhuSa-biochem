<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogueProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalogue_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'products'
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'catalogs'
            $table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_product');
    }
}
