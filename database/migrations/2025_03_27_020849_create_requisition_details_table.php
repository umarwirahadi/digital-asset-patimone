<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id');
            $table->string('description_item',200);
            $table->string('category',200)->nullable();
            $table->string('preferred_brand',200)->nullable();
            $table->string('unit',50);
            $table->integer('quantity')->default(0);
            $table->text('photo')->nullable();;
            $table->date('request_date')->nullable();
            $table->date('supplied_date')->nullable();
            $table->string('request_status',50)->nullable();
            $table->string('remarks')->nullable();
            $table->char('created_by',40);
            $table->char('updated_by',40)->nullable();
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
        Schema::dropIfExists('requisition_details');
    }
}
