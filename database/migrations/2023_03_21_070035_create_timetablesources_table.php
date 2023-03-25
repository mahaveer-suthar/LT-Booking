<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetablesources', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            // $table->string('batch');
            // $table->string('branch');
            // $table->string('course');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('is_active',[0,1])->default(0);
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
        Schema::dropIfExists('timetablesources');
    }
}
