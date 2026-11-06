<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable()->index();
            $table->string('event_type')->default('quote_request')->index();
            $table->string('business')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('locations')->default('1');
            $table->text('message')->nullable();
            $table->json('items')->nullable();
            $table->string('page_url')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('email_status')->default('pending');
            $table->timestamp('email_sent_at')->nullable();
            $table->text('email_error')->nullable();
            $table->boolean('is_read')->default(false)->index();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
