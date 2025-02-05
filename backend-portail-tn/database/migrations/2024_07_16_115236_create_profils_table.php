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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('profilePicture')->nullable();
            $table->text('bio');
            $table->string('gender');
            $table->string('city');
            $table->string('country');
            $table->string('phoneNumber');
            $table->string('website');
            $table->string('address');
            $table->json('skills');
            $table->json('languages');
            $table->string('cv')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};
