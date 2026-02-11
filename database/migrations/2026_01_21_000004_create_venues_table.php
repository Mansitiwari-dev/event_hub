<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venue_manager_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('capacity')->nullable();
            $table->decimal('base_price', 10, 2)->nullable();
            $table->text('amenities')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('venue_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('venue_manager_id');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('venues');
        Schema::enableForeignKeyConstraints();
    }
};
