<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_parent')->default(false);
            $table->boolean('is_child')->default(false);

            // Parent specific columns
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password')->nullable();

            // Child specific columns
            $table->string('name')->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('photo_filename')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->double('money', 15, 2)->default(0);

            $table->rememberToken();
            $table->timestamps();


            $table->foreign('parent_id')->references('id')->on('users')
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
        Schema::dropIfExists('users');
    }
}
