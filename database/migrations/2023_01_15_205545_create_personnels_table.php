<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->char('work_id', 255)->primary();
            $table->string('name', 255);
            $table->string('email')->unique();
            $table->unsignedBigInteger('telephone')->unique();
            $table->enum('status', ['Available', 'Engaged']);
            $table->unsignedBigInteger('rating')->default(0);
            $table->timestamps()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnels');
    }
}
