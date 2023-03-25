<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timetablesources_id')->constrained('timetablesources')->cascadeOnDelete();
            $table->string('day');
            $table->foreignId('timeslots_id')->constrained('timeslots')->cascadeOnDelete();
            $table->foreignId('lt_id')->constrained('lt_rooms')->cascadeOnDelete();
            $table->string('teacher_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('branch')->nullable();
            $table->string('batch')->nullable();
            $table->string('course')->nullable();
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
        Schema::dropIfExists('timetables');
    }
}
