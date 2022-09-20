<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipping_country_id');
            $table->decimal('min_weight', 20, 2);
            $table->decimal('max_weight', 20, 2);
            $table->decimal('shipping_amount', 20, 2);
            $table->boolean('status')->default(1);
            $table->foreign('shipping_country_id')->references('id')->on('shipping_countries')->onDelete('cascade');
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
        Schema::dropIfExists('shipping_rules');
    }
}
