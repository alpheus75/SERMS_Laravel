<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->char('sender', 255);
            $table->string('description', 255);
            $table->string('location', 255);
            $table->double('longitude', $precision = 9, $scale = 6);
            $table->double('latitude', $precision = 8, $scale = 6);
            $table->enum('status', ['Active', 'Resolved']);
            $table->varchar('assigned_to', 255);
            $table->string('remarks', 255);
            $table->integer('rating')->default(0);
            $table->timestamps()->useCurrent();
            $table->foreign('sender')->references('reg_no')->on('students')
                 ->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidents');
    }
}
