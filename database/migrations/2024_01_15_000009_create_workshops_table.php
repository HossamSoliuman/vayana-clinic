<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('slug')->unique();
            $table->text('description_en');
            $table->text('description_ar')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('instructor_name')->nullable();
            $table->string('duration')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->enum('location', ['online', 'in_person', 'hybrid']);
            $table->decimal('price', 8, 2)->nullable();
            $table->enum('currency', ['SAR', 'USD'])->default('SAR');
            $table->integer('max_participants')->nullable();
            $table->string('registration_link')->nullable();
            $table->boolean('is_registration_open')->default(true);
            $table->enum('category', ['wellness', 'resilience', 'stress_management', 'confidence', 'workplace', 'other']);
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
