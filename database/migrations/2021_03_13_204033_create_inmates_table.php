<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmates', function (Blueprint $table) {
            $table->id();
            $table->string('inmate_name');
            $table->string('inmate_fname');
            $table->string('inmate_rpno');
            $table->unsignedBigInteger('inmate_block_id');
            $table->binary('inmate_photo')->nullable();
            $table->string('inmate_dob')->nullable();
            $table->string('inmate_accno')->nullable();
            $table->string('inmate_balance')->default(0);
            $table->unsignedBigInteger('inmate_created_id');
            $table->timestamps();


            $table->foreign('inmate_created_id')
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
        Schema::dropIfExists('inmates');
    }
}
