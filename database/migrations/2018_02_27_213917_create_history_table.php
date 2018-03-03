<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
	        $table->unsignedInteger('child_id');
	        $table->string('name')->nullable();
	        $table->unsignedInteger('category_id')->nullable();
	        $table->double('price');
	        $table->string('photo_url')->nullable();
	        $table->text('notes')->nullable();
	        $table->unsignedInteger('wish_id')->nullable();
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
        Schema::dropIfExists('history');
    }
}
