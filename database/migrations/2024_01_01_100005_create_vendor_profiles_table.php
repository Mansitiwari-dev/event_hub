<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->text('description')->nullable();
            $table->text('experience')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->decimal('service_amount', 8, 2)->nullable();
            $table->json('availability')->nullable();
            $table->decimal('rating', 3, 2)->default(5.0);
            $table->integer('review_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_profiles');
    }
};
