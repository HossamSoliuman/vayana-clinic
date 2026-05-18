<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cbt_thought_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('situation');
            $table->text('thought');
            $table->string('emotion')->nullable();
            $table->tinyInteger('emotion_intensity')->nullable();
            $table->text('response')->nullable();
            $table->text('alternative_thought')->nullable();
            $table->dateTime('log_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cbt_thought_logs');
    }
};
