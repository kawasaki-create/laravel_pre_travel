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
        Schema::create('belongings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_plan_id')->comment('旅行プランID');
            $table->text('contents')->comment('もっていくもの')->nullable();
            $table->timestamps();

            $table->foreign('travel_plan_id')->references('id')->on('travel_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('belongings');
    }
};
