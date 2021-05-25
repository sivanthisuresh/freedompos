<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInovicedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inovicedetails', function (Blueprint $table) {
            $table->id();
            $table->string('invoicedetail_invoice_no');
            $table->string('invoicedetail_product_id');
            $table->string('invoicedetails_product_qty');
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
        Schema::dropIfExists('inovicedetails');
    }
}
