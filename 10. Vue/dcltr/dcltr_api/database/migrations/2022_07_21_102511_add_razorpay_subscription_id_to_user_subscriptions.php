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
        Schema::table('user_subscriptions', function (Blueprint $table) {
            //
            $table->string('razorpay_subscription_id', 100)->nullable()->default('');
            $table->string('razorpay_status', 100)->nullable()->default('');
            $table->tinyInteger('local_subscription_status')->nullable()->default(1);
            $table->json('subscription_response')->nullable();
            $table->json('current_plan_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            //
        });
    }
};
