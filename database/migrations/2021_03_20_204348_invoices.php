<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices',function (Blueprint $table) 
        {
            $table->id();
            $table->string('invoice_no');
            $table->string('invoice_type');
            $table->string('invoice_user_id');
            $table->string('invoice_cus_id');
            $table->string('invoice_amount');
            $table->string('invoice_item');
            $table->string('invoice_paid');
            $table->string('invoice_desc');
            $table->string('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
