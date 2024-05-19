<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('local_id')->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedTinyInteger('gender')->nullable();
            $table->string('tax_name', 191)->nullable();
            $table->string('tax_add', 191)->nullable();
            $table->string('tax_id', 191)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image', 191)->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: block, 1: active');
            $table->timestamp('last_login_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'locals'
            $table->foreign('local_id')->references('id')->on('locals')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
