<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_prompts', function (Blueprint $table) {
            $table->id();
            $table->text('prompt_text_en');
            $table->text('prompt_text_ar')->nullable();
            $table->enum('category', ['gratitude', 'reflection', 'emotion', 'goal_setting', 'mindfulness'])->default('reflection');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_prompts');
    }
};
