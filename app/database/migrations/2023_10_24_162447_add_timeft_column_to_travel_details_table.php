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
        Schema::table('travel_details', function (Blueprint $table) {
            $table->dropColumn('time');
            $table->dateTime('time_from')->nullable();
            $table->dateTime('time_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_details', function (Blueprint $table) {
            $table->dateTime('time')->nullable();
            $table->dropColumn('time_from');
            $table->dropColumn('time_to');
        });
    }
};
