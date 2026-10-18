<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->string('exam')->default('Unit Test')->after('subject');
            $table->integer('max_marks')->default(100)->after('marks');
            $table->foreignId('teacher_id')->nullable()->after('max_marks')
                  ->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['exam', 'max_marks', 'teacher_id']);
        });
    }
};