<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecSeat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_seats_archive', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('spec_ticket_archive_id');
            $table->string('seat')->nullable;
            $table->string('row');
            $table->string('status');
            $table->dateTime('seat_created_at');
            $table->dateTime('seat_updated_at');

            $table->foreign('spec_ticket_archive_id')
                ->references('id')
                ->on('spec_tickets_archive')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('spec_seats_archive');
    }
}
