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
            $table->text('title')->nullable();
            $table->text('city')->nullable();
            $table->text('category')->nullable();
            $table->text('area')->nullable();
            $table->text('meters')->nullable            
            $table->text('descr')->nullable();
            $table->decimal('price', 8, 2)->nullable();
             $table->decimal('price1', 8, 2)->nullable();
             $table->decimal('price2', 8, 2)->nullable();
            $table->text('terrace')->nullable();
            $table->text('image')->nullable();
            $table->text('image1')->nullable();
            $table->text('image2')->nullable();
            $table->text('image3')->nullable();
            $table->text('image4')->nullable();
            $table->text('image5')->nullable();
             $table->text('image6')->nullable();
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
    }
}
