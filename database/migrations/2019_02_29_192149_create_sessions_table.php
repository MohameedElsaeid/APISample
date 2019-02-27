<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->char('session_name');
            $table->mediumText('session_description');
            $table->unsignedInteger('sport_id');
            $table->foreign('sport_id','session_sport_fk')
                ->references('id')
                ->on('sports')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->unsignedInteger('max_attendees')->default(0);
            $table->unsignedInteger('current_attendees')->default(0);
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
        Schema::dropIfExists('sessions');
    }
}
