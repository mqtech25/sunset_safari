<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->text('title');
            $table->string('slug')->unique();
            $table->string('path')->default('')->change();
            $table->string('images')->default('')->change();
            $table->longText('description')->default('')->change();
            $table->boolean('status')->default(0);
            $table->text('meta_title')->default('')->change();
            $table->text('meta_tags')->default('')->change();
            $table->text('meta_description')->default('')->change();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('blog_posts');
    }
}
