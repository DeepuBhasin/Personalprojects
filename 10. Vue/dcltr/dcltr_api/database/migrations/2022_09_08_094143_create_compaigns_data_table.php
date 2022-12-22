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
        Schema::create('compaign_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('compaign_id')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->bigInteger('quantity')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 for pending');
            $table->date('pickedup_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('compaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('user_addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compaign_data');
    }
};
