<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // facebook | instagram
            $table->text('content');
            $table->string('status')->default('pending'); // pending | posted | failed
            $table->timestamp('scheduled_at');
            $table->timestamp('posted_at')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_posts');
    }
};
