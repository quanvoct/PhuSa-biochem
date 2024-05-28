<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Khóa ngoại tới bảng 'users'
            $table->string('action');
            $table->string('type');
            $table->string('object');
            $table->string('ip');
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('isp')->nullable();
            $table->string('referred')->nullable();
            $table->string('agent')->nullable();
            $table->string('platform')->nullable();
            $table->string('device')->nullable();
            $table->string('revision')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
