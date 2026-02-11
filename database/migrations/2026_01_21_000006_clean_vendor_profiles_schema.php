<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remove duplicate and unused vendor_profiles migration
     * Keep only the latest schema from 2024_01_01_100005_create_vendor_profiles_table.php
     */
    public function up(): void
    {
        // Add missing columns to vendor_profiles if they don't exist
        if (Schema::hasTable('vendor_profiles')) {
            if (!Schema::hasColumn('vendor_profiles', 'company_name')) {
                Schema::table('vendor_profiles', function (Blueprint $table) {
                    $table->string('company_name')->nullable()->after('user_id');
                    $table->text('description')->nullable()->after('company_name');
                    $table->text('experience')->nullable()->after('description');
                    $table->decimal('service_amount', 8, 2)->nullable()->after('address');
                    $table->json('availability')->nullable();
                    $table->decimal('rating', 3, 2)->default(5.0);
                    $table->integer('review_count')->default(0);
                });
            }
        }
    }

    public function down(): void
    {
        // This migration is for cleaning up schema only, no rollback needed
    }
};
