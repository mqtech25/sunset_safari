<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_items', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("description",500)->nullable();
            $table->string("parent")->nullable();
            $table->string("image")->nullable();
            $table->string("page_slug")->nullable();
            $table->unsignedBigInteger("page_id")->nullable();
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
        Schema::dropIfExists('m_items');
    }
}