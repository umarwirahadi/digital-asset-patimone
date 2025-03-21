<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_distribution', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->integer('product_number');
            $table->string('product_label')->nullable();
            $table->char('employee_id',40)->nullable();
            $table->date('distribute_date');
            $table->time('distribute_time')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('location')->nullable();
            $table->string('condition')->nullable(); // good/bad/broken etc
            $table->string('status',50)->nullable(); //in use
            $table->string('handed_over_by',100)->nullable(); //handed over by admin 
            $table->string('received_by',100)->nullable(); //received by admin 
            $table->string('files')->nullable(); //file attachment
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('product_distribution');
    }
}
