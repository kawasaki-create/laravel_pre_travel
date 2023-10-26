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
        Schema::create('travel_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_plan_id')->comment('旅行プランID');
            $table->text('contents')->comment('記録内容')->nullable();
            $table->text('kubun')->comment('1:朝食 2:昼食 3:夕食 4:間食 5:交通費 6:宿泊費 7:お土産代 8:レジャー 9:行きたいところ 10:その他雑費')->nullable();
            $table->unsignedBigInteger('price')->nullable();
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
        Schema::dropIfExists('travel_details');
    }
};
