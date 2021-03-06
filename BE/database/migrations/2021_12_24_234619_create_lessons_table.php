<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("img");
            $table->string("content");
            $table->integer("view")->default(0);
            $table->bigInteger("id_user")->unsigned();
            $table->foreign("id_user")->references("id")->on("users")->cascadeOnDelete();
            $table->bigInteger("id_type")->unsigned();
            $table->foreign("id_type")->references("id")->on("types")->cascadeOnDelete();
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
        Schema::dropIfExists('lessons');
    }
}
