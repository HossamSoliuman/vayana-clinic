<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('title', ['Dr', 'Mr', 'Ms', 'Mrs'])->nullable();
            $table->text('biography_en')->nullable();
            $table->text('biography_ar')->nullable();
            $table->string('license_number')->unique();
            $table->string('license_document_path')->nullable();
            $table->string('cv_path')->nullable();
            $table->json('certificates_path')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->decimal('session_price_online', 8, 2)->nullable();
            $table->decimal('session_price_inperson', 8, 2)->nullable();
            $table->enum('currency', ['SAR', 'USD'])->default('SAR');
            $table->enum('work_type', ['online', 'in_person', 'hybrid']);
            $table->json('availability_schedule')->nullable();
            $table->date('next_available_date')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_available')->default(true);
            $table->decimal('rating_average', 3, 2)->default(0.00);
            $table->integer('rating_count')->default(0);
            $table->enum('application_status', ['pending', 'under_review', 'interview_scheduled', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_profiles');
    }
};
