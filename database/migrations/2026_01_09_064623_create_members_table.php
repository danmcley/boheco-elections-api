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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            // $table->string('FullName');
            $table->string("FirstName");
            $table->string("MiddleName")->nullable();
            $table->string("LastName");
            $table->string("Suffix")->nullable();
            $table->string('Gender');
            $table->date('BirthDate');
            // $table->string('Address');
            $table->string("Sitio");
            $table->string("Barangay");
            $table->string("Town");
            $table->string('ContactNumber');
            $table->string('Email')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
