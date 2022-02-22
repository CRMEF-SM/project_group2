<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWaitingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('waitings', function (Blueprint $table) {
            $table->dateTime('arrived_at')->nullable();
            $table->dateTime('went_at')->nullable();
        });
    }

    /**
     * Reverse the migrations. cp .env.example .env && php artisan key:generate && php artisan passport:keys
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
