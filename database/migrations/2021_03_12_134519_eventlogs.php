<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Eventlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventlogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eventlog_user_id');
            $table->string('eventlog_type');
            $table->string('eventlog_desc');
            
            $table->timestamps();


            $table->foreign('eventlog_user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExits('eventlogs');
    }
}
