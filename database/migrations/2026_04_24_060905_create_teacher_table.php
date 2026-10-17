<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();     
            $table->string('fullname');
            $table->string('email');
            $table->string('phoneno');
            $table->String('subject');
            $table->string('qualification');
            $table->decimal('salary');
            $table->text('address');
            $table->date('joiningdate');
            $table->string('gender');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('teacher');
    }
};
