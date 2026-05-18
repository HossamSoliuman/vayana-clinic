<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('therapy_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('slug')->unique();
            $table->text('description_en');
            $table->text('description_ar')->nullable();
            $table->string('image')->nullable();
            $table->enum('program_type', ['group', 'individual', 'workshop']);
            $table->string('duration')->nullable();
            $table->integer('session_count')->nullable();
            $table->decimal('price_per_session', 8, 2)->nullable();
            $table->decimal('full_program_price', 8, 2)->nullable();
            $table->enum('currency', ['SAR', 'USD'])->default('SAR');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('max_participants')->nullable();
            $table->json('what_you_will_learn_en')->nullable();
            $table->json('what_you_will_learn_ar')->nullable();
            $table->text('program_schedule_en')->nullable();
            $table->text('program_schedule_ar')->nullable();
            $table->foreignId('facilitator_provider_id')->nullable()->constrained('provider_profiles')->onDelete('set null');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('therapy_programs');
    }
};
