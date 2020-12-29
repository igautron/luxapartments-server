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
            $table->text('images')->nullable();
            $table->text('city')->nullable();
            $table->text('area')->nullable();
            $table->text('meters')->nullable();
            $table->text('terrace')->nullable();
            $table->text('category')->nullable();
            $table->text('descr')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('stage')->nullable();
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
