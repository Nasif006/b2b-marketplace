<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('automation_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trigger'); // order_placed | user_registered | order_confirmed | abandoned_cart
            $table->string('action');  // send_email | send_sms | notify_supplier | log_interaction
            $table->json('conditions')->nullable(); // optional extra conditions
            $table->json('payload')->nullable();    // action data (email template, message etc)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('automation_rules');
    }
};
