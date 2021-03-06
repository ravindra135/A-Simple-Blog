<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->index()->default(1);
            $table->foreignId('photo_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('body');
            $table->timestamps();

            // This will Make Null Value on photo_id; if Image Files is Deleted;
//            $table->foreignId('photo_id')->constrained('photos')->nullOnDelete();

            // This will Allow you to delete all Posts of the User who is being Deleted;
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
};
