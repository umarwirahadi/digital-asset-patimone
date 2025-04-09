<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('requisition_no',50)->nullable();
            $table->string('requisition_type')->nullable();
            $table->string('requisition_priority',1)->default('1');
            $table->string('requisition_month',50)->nullable();
            $table->string('requisition_year',4)->nullable();
            $table->text('requisition_description')->nullable();
            $table->string('requisition_file',200)->nullable();
            $table->date('requisition_date');
            $table->text('requisition_remark')->nullable();
            $table->date('date_supplied_by_contractor')->nullable();
            $table->string('remark_by_contractor',200)->nullable();
            $table->date('date_received_by_engineer')->nullable();
            $table->string('remark_by_engineer',200)->nullable();
            $table->string('status',1)->default('1');
            $table->string('created_by');
            $table->string('updated_by');
            $table->softDeletes();
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
        Schema::dropIfExists('requisitions');
    }
}
