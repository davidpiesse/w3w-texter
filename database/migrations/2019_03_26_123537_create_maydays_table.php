<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaydaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maydays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('phone_number');
            $table->string('status')->default('open');
            $table->dateTime('last_contact_at')->nullable();
            $table->double('last_latitude', 12,8)->nullable();
            $table->double('last_longitude', 12,8)->nullable();
            $table->string('last_w3w')->nullable();
            $table->json('last_location')->nullable();
            $table->json('last_connection')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maydays');
    }
}
