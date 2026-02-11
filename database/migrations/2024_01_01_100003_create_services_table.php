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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['decorator', 'catering', 'dj', 'security', 'lighting', 'sound'])->default('decorator');
            $table->decimal('price', 12, 2);
            $table->string('duration')->nullable(); // e.g., "4 hours", "full day"
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            $table->text('features')->nullable(); // JSON or text
            $table->boolean('is_available')->default(true);
            $table->integer('max_bookings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
