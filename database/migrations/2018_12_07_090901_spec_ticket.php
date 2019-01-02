<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_tickets_archive', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->string("notes")->nullable;
            $table->string('section');
            $table->string('row');
            $table->integer('low');
            $table->integer('high');
            $table->string('currency');
            $table->double('unit_cost', 8, 2);
            $table->string('format');
            $table->double('list_price', 8, 2);
            $table->string('public_notes');
            $table->string('disclosure');
            $table->integer('event_id');
            $table->integer('skybox_id');
            $table->integer('created_by');
            $table->integer('deleted_by');
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
        Schema::drop('spec_tickets_archive');
    }
}
