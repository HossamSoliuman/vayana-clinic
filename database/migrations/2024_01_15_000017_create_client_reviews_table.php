<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('initials')->nullable();
            $table->tinyInteger('rating');
            $table->text('review_text_en');
            $table->text('review_text_ar')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->foreignId('related_service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->foreignId('related_provider_id')->nullable()->constrained('provider_profiles')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_reviews');
    }
};
