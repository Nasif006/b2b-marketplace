<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('email'); // email | sms
            $table->string('status')->default('draft'); // draft | scheduled | sent | cancelled
            $table->string('trigger')->nullable(); // manual | order_placed | user_registered | abandoned_cart
            $table->text('subject')->nullable();
            $table->longText('body');
            $table->timestamp('scheduled_at')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
