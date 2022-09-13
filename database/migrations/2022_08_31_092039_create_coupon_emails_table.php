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
        Schema::create('coupon_emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_id');
            $table->foreign('email_id')
                ->references('id')
                ->on('emails')
                ->onDelete('cascade');

            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id')
                ->references('id')
                ->on('coupons')
                ->onDelete('cascade');
            $table->date('used_at');
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
        Schema::dropIfExists('coupon_emails');
    }
};
