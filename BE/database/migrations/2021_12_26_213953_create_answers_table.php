<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_user")->unsigned();
            $table->foreign("id_user")->references("id")->on("users")->cascadeOnDelete();
            $table->bigInteger("id_exam")->unsigned();
            $table->foreign("id_exam")->references("id")->on("exams")->cascadeOnDelete();
            $table->tinyInteger("option")->nullable();
            $table->boolean("check")->default(false);
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
        Schema::dropIfExists('answers');
    }
}
