<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAttemptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->integer('user_id')->default(0);
            $table->integer('attempt')->default(0);
            $table->integer('currentpage')->default(0);
            $table->integer('preview')->default(0);
            $table->string('state')->default('inprogress');
            $table->string('signed_by_user')->nullable()->default(null);
            $table->timestamp('timestart')->nullable()->default(null);
            $table->timestamp('timefinished')->nullable()->default(null);
            $table->integer('correctquestions')->nullable()->default(null);
            $table->integer('totalquestions')->nullable()->default(null);
            $table->string('result')->nullable()->default(null);
            $table->integer('earned_grade')->nullable()->default(null);
            $table->integer('archived')->nullable()->default(0);;
            $table->softDeletes();
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
        Schema::dropIfExists('quiz_attempt');
    }
}
