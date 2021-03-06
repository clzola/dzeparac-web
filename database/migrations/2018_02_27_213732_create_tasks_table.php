<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wish_id');
            $table->unsignedInteger('child_id');
            $table->string('name');
            $table->boolean('is_finished')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->foreign('child_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('wish_id')->references('id')->on('wishes')
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
        Schema::dropIfExists('tasks');
    }
}
