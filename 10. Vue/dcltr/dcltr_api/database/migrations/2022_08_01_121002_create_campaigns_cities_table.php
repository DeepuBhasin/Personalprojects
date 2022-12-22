<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_cities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('campaign_id')->unsigned();
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns_cities');
    }
};
