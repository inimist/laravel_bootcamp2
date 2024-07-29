<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropColumn('user_id');

            // Add new fields
            $table->string('name')->nullable(); // Add the first new field
            $table->string('email')->nullable(); // Add the second new field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->dropColumn(['name','email']);
            $table->string('user_id')->nullable();
        });
    }
};
