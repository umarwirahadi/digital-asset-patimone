<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('package_id');
            $table->string('code',50)->nullable();
            $table->string('name',200);
            $table->integer('quantity')->default(0);
            $table->longText('description')->nullable();
            $table->string('brand',200)->nullable();
            $table->string('model',200)->nullable();
            $table->date('delivery_date',200)->nullable();
            $table->string('delivery_no',200)->nullable();
            $table->string('delivery_from',200)->nullable();  
            $table->string('tags')->nullable();  
            $table->string('is_warranty',1)->default('0');
            $table->string('file_path',200)->nullable();
            $table->text('remarks')->nullable();
            $table->date('warranty_start_date')->nullable();
            $table->date('warranty_end_date')->nullable();
            $table->string('status',1)->default('1');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('product_images',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('product_url')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_images');
    }
}
