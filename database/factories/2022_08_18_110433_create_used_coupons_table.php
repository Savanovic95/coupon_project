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
        Schema::create('used_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('coupon_num');
            $table->foreign('coupon_num')
                ->references('id')
                ->on('coupons')
                ->onDelete('cascade');
            $table->unsignedBigInteger('coupon_pattern');
            $table->foreign('coupon_pattern')
                ->references('id')
                ->on('coupon_pattern')
                ->onDelete('cascade');
            $table->timestamp('used_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('used_coupons');
    }
};
