<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCataloguePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogue_promotion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalogue_id');
            $table->unsignedBigInteger('promotion_id');
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'promotions'
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');

            // Tạo khóa ngoại tới bảng 'catalogues'
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
        Schema::dropIfExists('catalogue_promotion');
    }
}
