<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('qtype');
            $table->softDeletes();
            $table->timestamps();
        });

        $data = [
            ['title' => 'Single Line', 'qtype' => 'singleline'],
            ['title' => 'Multiple Lines', 'qtype' => 'multiplelines'],
            ['title' => 'Multiple Lines (Rich Text)', 'qtype' => 'multiplelines-rich'],
            ['title' => 'True/False (yes/no)', 'qtype' => 'truefalse'],
            ['title' => 'Multiple Choice (One Answer)', 'qtype' => 'multiplechoice-one'],
            ['title' => 'Multiple Choice (Multiple Answers)', 'qtype' => 'multiplechoice-multi'],
            ['title' => 'Matching Pairs', 'qtype' => 'matching-pairs']
        ];
        DB::table('question_types')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_type');
    }
}
