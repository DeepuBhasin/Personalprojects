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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('type')->default(0)->comment('0 = recycle, 1 = donation');
            $table->text('description')->nullable();
            $table->integer('donation_limit')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('need_inspection')->nullable()->default(false)->comment('0 = no, 1 = yes');
            $table->boolean('is_active')->nullable()->default(true)->comment('0 = de-active, 1 = active');
            $table->bigInteger('admin_id')->unsigned();
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
        Schema::dropIfExists('campaigns');
    }
};
