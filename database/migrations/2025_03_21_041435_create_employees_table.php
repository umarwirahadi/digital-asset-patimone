<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('position_id')->nullable();
            $table->string('code')->nullable();
            $table->string('full_name');
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city',30)->nullable();
            $table->date('mobilization')->nullable();
            $table->date('demobilization')->nullable();
            $table->string('status')->default('1'); //1 active 0 not active
            $table->string('photo',200)->nullable();
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('position', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('position_name');
            $table->string('category'); // employer, engineer pro a, engineer pro b, supporting, inspector
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
        Schema::dropIfExists('employees');
        Schema::dropIfExists('position');
    }
}
