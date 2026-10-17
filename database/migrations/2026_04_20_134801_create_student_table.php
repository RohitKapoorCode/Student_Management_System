<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('studentid');
            $table->date('dateofbirth');
            $table->string('fathername');
            $table->string('mothername');
            $table->String('class');
            $table->String('parentphone');
            $table->string('studentphone');
            $table->String('email');           
            $table->string('gender');
            $table->text('address');
            $table->decimal('admissionfees', 10, 2)->default(0);
            $table->decimal('tuitionfees', 10, 2)->default(0);
            $table->decimal('totalfees', 10, 2)->default(0);
            $table->string('paymentstatus')->default('Unpaid');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
