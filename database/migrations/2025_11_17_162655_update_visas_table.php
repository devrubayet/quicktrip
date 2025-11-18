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
         Schema::table('visas', function (Blueprint $table) {
        $table->foreignId('client_id')->after('id')->casecadeOnUpdate()->casecadeOnDelete();
        $table->enum('status', ['Received', 'Pending', 'Approved', 'Rejected'])->default('Received')->change();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visas', function (Blueprint $table) {
        $table->dropConstrainedForeignId('client_id');
        // status enum rollback করলে manually করতে হবে
    });
    }
};
