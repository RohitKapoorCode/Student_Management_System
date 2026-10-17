<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('student', function (Blueprint $table) {
        // Ye line yahan add karein
        $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('student', function (Blueprint $table) {
        // Rollback ke liye ye lines
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
