<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_vendor_contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('event_manager_id');
            $table->unsignedBigInteger('vendor_specialization_id');
            $table->text('contract_details')->nullable();
            $table->decimal('contract_amount', 10, 2);
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed', 'cancelled'])->default('pending');
            $table->date('service_date')->nullable();
            $table->time('service_start_time')->nullable();
            $table->time('service_end_time')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vendor_specialization_id')->references('id')->on('vendor_specializations')->onDelete('restrict');
            
            $table->unique(['event_id', 'vendor_id', 'vendor_specialization_id'], 'evc_event_vendor_spec_unique');
            $table->index(['event_manager_id', 'status']);
            $table->index(['vendor_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('event_vendor_contracts');
        Schema::enableForeignKeyConstraints();
    }
};
