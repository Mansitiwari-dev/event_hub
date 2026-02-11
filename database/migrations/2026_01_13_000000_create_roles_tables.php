<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create roles table if it doesn't exist
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('display_name')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        } else {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('roles', 'display_name')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('display_name')->after('name')->nullable();
                    $table->text('description')->nullable();
                });
            }
        }

        // Create role_user pivot table if it doesn't exist
        if (!Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('role_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                
                $table->unique(['user_id', 'role_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
        // Don't drop roles table as it might contain data
    }
};