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
        Schema::create('visa_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('applicant_name', 50);
            $table->string('reference_number', 50)->unique()->nullable(false);
            $table->enum('status', ['Pending', 'Approve', 'Rejected']);
            $table->string("pdf", 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_tracks');
    }
};
