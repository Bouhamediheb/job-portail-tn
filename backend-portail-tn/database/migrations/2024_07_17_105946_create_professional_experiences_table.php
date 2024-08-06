<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionalExperiencesTable extends Migration
{
    public function up()
    {
        Schema::create('professional_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('companyName');
            $table->string('jobTitle');
            $table->date('startDate');
            $table->date('endDate');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('profil_id');
            $table->timestamps();

            // Correct the foreign key reference
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('professional_experiences');
    }
}
