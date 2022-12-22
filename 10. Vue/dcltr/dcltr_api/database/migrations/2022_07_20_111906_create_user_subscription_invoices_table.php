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
        Schema::create('user_subscription_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('razorpay_plan_id')->nullable();
            $table->string('razorpay_subscription_id')->nullable();
            $table->string('razorpay_invoice_id')->nullable();
            $table->date('billing_start_date')->nullable();
            $table->date('billing_end_date')->nullable();
            $table->json('razorpay_invoice_data')->nullable();
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
        Schema::dropIfExists('user_subscription_invoices');
    }
};
