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
        Schema::create('travel_plans', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();

            $table->text('meet_place')->nullable();
            $table->text('trip_title')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('trip_start')->nullable();
            $table->timestamp('trip_end')->nullable();
            $table->timestamp('departure_time')->nullable();
            $table->text('user_id');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_plans');
    }
};
