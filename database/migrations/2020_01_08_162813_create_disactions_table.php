<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('godate');
            $table->string('offence');
            $table->string('nopunishment');
            $table->string('punishment1')->nullable();
            $table->string('punishment2')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('disactions');
    }
}
