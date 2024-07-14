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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('type');
            $table->integer('employmentType');
            $table->integer('workplace');
            $table->string('description');
            $table->double('minSalary')->nullable();
            $table->double('maxSalary')->nullable();
            $table->double('hourlyWage')->nullable();
            $table->integer('yearsOfExperience')->nullable();
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->string('file');
            $table->unsignedBigInteger('societe_id');
            $table->foreign('societe_id')->references('id')->on('societes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
