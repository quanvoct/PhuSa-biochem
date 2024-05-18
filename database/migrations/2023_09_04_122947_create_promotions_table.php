<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);
            $table->string('coupon', 64)->index();
            $table->string('type', 191)->comment('Loại chương trình khuyến mãi');
            $table->text('condition_users')->nullable()->comment('null = all');
            $table->text('condition_products')->nullable()->comment('null = all');
            $table->string('condition_min', 191)->nullable();
            $table->string('condition_max', 191)->nullable();
            $table->text('result_products')->nullable()->comment('null = all');
            $table->unsignedBigInteger('result_value')->nullable();
            $table->dateTime('date_begin')->nullable()->comment('null = forever');
            $table->dateTime('date_end')->nullable()->comment('null = forever');
            $table->unsignedInteger('times');
            $table->unsignedTinyInteger('separate_apply');
            $table->unsignedTinyInteger('separate_account');
            $table->unsignedTinyInteger('status');
            $table->unsignedBigInteger('revision')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'promotions'
            $table->foreign('revision')->references('id')->on('promotions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
