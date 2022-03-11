<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id')->unsigned()->unique();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->string('amount')->nullable();
            $table->string('image')->nullable();
            $table->string('location');
            $table->boolean('status')->default(1);
            $table->boolean('order')->default(10);
            $table->boolean('featured')->default(0);    
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
        Schema::dropIfExists('posts');
    }
}
