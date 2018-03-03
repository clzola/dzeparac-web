<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->increments('id');
	        $table->unsignedInteger('child_id');
	        $table->string('name');
	        $table->unsignedInteger('category_id');
	        $table->double('price');
	        $table->string('photo_url');
	        $table->text('notes')->nullable();
	        $table->boolean('flag_fulfilled')->default(false);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('child_id')->references('id')->on('children')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishes');
    }
}
