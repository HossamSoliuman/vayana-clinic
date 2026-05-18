<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('slug')->unique();
            $table->decimal('price', 8, 2);
            $table->enum('currency', ['SAR', 'USD'])->default('SAR');
            $table->enum('billing_cycle', ['monthly', 'yearly']);
            $table->json('features_en')->nullable();
            $table->json('features_ar')->nullable();
            $table->integer('session_credits')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
