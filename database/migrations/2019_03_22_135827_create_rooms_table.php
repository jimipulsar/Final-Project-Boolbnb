<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->float('price');

            $table->string('description')->default('');
            $table->string('cover', 500);
            $table->string('n_rooms');
            $table->string('n_beds');
            $table->string('service_id');
            $table->string('n_baths');
            $table->decimal('latitude' , 8,6);
            $table->decimal('longitude', 9,6);
            $table->string('metri_quadrati');
            $table->string('street');
            $table->string('locality');
            $table->integer('house_number');
            $table->bigInteger('postal_code');
            $table->string('state');
            $table->boolean('published');
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
        Schema::dropIfExists('rooms');
    }
}
