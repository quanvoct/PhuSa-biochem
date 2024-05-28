<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->text('url')->nullable();
            $table->text('referred')->nullable();
            $table->string('agent')->nullable();
            $table->string('platform')->nullable();
            $table->string('device')->nullable();
            $table->string('ip')->nullable();
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('isp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
