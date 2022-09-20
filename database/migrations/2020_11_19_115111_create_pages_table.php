<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('page_subtitle')->nullable();
            $table->text('page_content')->nullable();
            $table->string('page_slug')->nullable()->unique();
            $table->boolean('page_status')->nullable();
            $table->string('page_banner_image')->nullable();
            $table->string('page_meta_title',300)->nullable();
            $table->string('page_meta_description',500)->nullable();
            $table->string('page_meta_keyword',500)->nullable();
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
        Schema::dropIfExists('pages');
    }
}
