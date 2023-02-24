<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sos', function (Blueprint $table) {
            $table->id();
            $table->char('sender', 255);
            $table->string('location', 255);
            $table->double('longitude', $precision = 9, $scale = 6);
            $table->double('latitude', $precision = 8, $scale = 6);
            $table->enum('status', ['Admitted', 'Dismissed', 'Pending']);
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
        Schema::dropIfExists('sos');
    }
}
