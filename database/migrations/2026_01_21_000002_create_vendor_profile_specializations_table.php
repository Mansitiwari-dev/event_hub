<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::create('vendor_profile_specializations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_profile_id');
            $table->unsignedBigInteger('vendor_specialization_id');
            $table->text('portfolio_url')->nullable();
            $table->decimal('service_rate', 10, 2)->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->foreign('vendor_profile_id')->references('id')->on('vendor_profiles')->onDelete('cascade');
            $table->foreign('vendor_specialization_id')->references('id')->on('vendor_specializations')->onDelete('cascade');
            $table->unique(['vendor_profile_id', 'vendor_specialization_id'], 'vps_profile_spec_unique');
        });
        
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('vendor_profile_specializations');
        Schema::enableForeignKeyConstraints();
    }
};
