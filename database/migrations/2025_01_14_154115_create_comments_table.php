<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
   // database/migrations/xxxx_xx_xx_xxxxxx_add_parent_comment_id_to_comments_table.php

public function up()
{
    Schema::table('comments', function (Blueprint $table) {
        $table->unsignedBigInteger('parent_comment_id')->nullable()->after('sale_new_id');
        $table->foreign('parent_comment_id')->references('comment_id')->on('comments')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign(['parent_comment_id']);
        $table->dropColumn('parent_comment_id');
    });
}

}
