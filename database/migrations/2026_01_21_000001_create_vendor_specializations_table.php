<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_specializations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., 'decoration', 'catering', 'security', 'music', 'dj', 'hosting', 'photography', 'videography'
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // For UI display
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('vendor_specializations');
        Schema::enableForeignKeyConstraints();
    }
};
