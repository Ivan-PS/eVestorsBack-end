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
        Schema::create('startup_access_codes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('accessCode');
            $table->integer('startup_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startup_access_codes');
    }
};
