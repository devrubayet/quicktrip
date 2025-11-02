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
        Schema::create('site_infos', function (Blueprint $table) {
             $table->id();
            $table->string('sitename',100);
            $table->string('site_slogan',200);
            $table->string('logo',500);
            $table->string('about_us');
            $table->string('phone',15);
            $table->string('office_phone',15);
            $table->string('office_mail',50);
            $table->string('notice',500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_infos');
    }
};
