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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->string('creator_email')->nullable();
            $table->unsignedBigInteger('coupon_type');
            $table->foreign('coupon_type')
                ->references('id')
                ->on('coupon_types')
                ->onDelete('cascade');
            $table->unsignedBigInteger('coupon_subtype');
            $table->foreign('coupon_subtype')
                ->references('id')
                ->on('coupon_subtypes')
                ->onDelete('cascade');
            $table->integer('value')->nullable();
            $table->integer('limit')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('status')->default('active');
            $table->integer('used_times')->nullable();
            $table->date('used_at')->nullable();

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
        Schema::dropIfExists('coupons');
    }
};
