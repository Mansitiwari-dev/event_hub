<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('portfolio_images')) {
            return;
        }

        Schema::create('portfolio_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->references('id')->on('vendor_profiles')->onDelete('cascade');
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_images');
    }
};
