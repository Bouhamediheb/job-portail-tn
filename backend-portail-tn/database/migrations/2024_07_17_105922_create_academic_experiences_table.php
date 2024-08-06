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
        Schema::create('academic_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profil_id'); // Ensure this is unsignedBigInteger
            $table->string('institute');
            $table->string('degree');
            $table->string('graduation_year');
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_experiences');
    }
};
