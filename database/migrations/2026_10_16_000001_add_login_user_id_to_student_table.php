<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student', function (Blueprint $table) {
            // Kis user ka login is student record ka malik hai
            // (user_id = jisne record banaya; login_user_id = jis student ka ye record hai)
            $table->foreignId('login_user_id')->nullable()->unique()
                ->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropConstrainedForeignId('login_user_id');
        });
    }
};
