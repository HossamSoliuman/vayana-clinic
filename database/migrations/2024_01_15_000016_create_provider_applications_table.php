<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('specialty')->nullable();
            $table->string('license_number');
            $table->enum('preferred_work_type', ['online', 'in_person', 'hybrid']);
            $table->text('availability_description')->nullable();
            $table->string('license_document_path');
            $table->string('cv_path');
            $table->string('certificates_path')->nullable();
            $table->text('biography');
            $table->enum('status', ['submitted', 'under_review', 'interview_scheduled', 'approved', 'rejected'])->default('submitted');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('review_notes')->nullable();
            $table->dateTime('interview_date')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_applications');
    }
};
