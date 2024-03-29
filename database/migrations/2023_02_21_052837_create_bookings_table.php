<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');

            $table->foreignId('user_id')->constrained('users')->onDelete("cascade");
            $table->foreignId('timeslots_id')->nullable()->constrained('timeslots')->onDelete("cascade");
            $table->foreignId('lt_id')->nullable()->constrained('lt_rooms')->onDelete("cascade");
            $table->enum('status',['pending','reject','approved','cancel'])->default('pending');
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
        Schema::dropIfExists('bookings');
    }
}
