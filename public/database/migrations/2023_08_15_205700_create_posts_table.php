<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->text('title');
            $table->unsignedBigInteger('author_id')->nullable()->default(1); // Khóa ngoại tới bảng 'users'
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('revision')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0: hidden, 1: visible, 2: featured');
            $table->softDeletes(); 
            $table->timestamps();

            // Tạo khóa ngoại tới bảng 'users'
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            // Tạo khóa ngoại tới bảng 'categories'
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            // Tạo khóa ngoại tới bảng 'posts'
            $table->foreign('revision')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
