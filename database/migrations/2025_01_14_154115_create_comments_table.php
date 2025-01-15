<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id'); // ID của bình luận
            $table->unsignedBigInteger('sale_new_id'); // Sản phẩm được bình luận
            $table->unsignedBigInteger('user_id'); // Người dùng bình luận
            $table->unsignedBigInteger('parent_id')->nullable(); // ID bình luận cha (nếu là trả lời)
            $table->unsignedBigInteger('reply_to_user_id')->nullable(); // Người được trả lời (nếu có)
            $table->text('content'); // Nội dung bình luận
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('sale_new_id')->references('sale_new_id')->on('sale_news')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('comment_id')->on('comments')->onDelete('cascade');
            $table->foreign('reply_to_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
