<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('contact_person_name');
            $table->string('email');
            $table->string('phone');
            $table->string('type_of_service')->nullable();
            $table->string('organization_size')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'in_progress', 'contacted', 'closed'])->default('new');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_inquiries');
    }
};
