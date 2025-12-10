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
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            // Links the template back to the agent who created it
            $table->foreignId('user_id')->constrained('ppr_users')->onDelete('cascade');

            $table->string('name');             // e.g., "Welcome Lead Email", "Seller Offer Update"
            $table->string('subject');          // The email subject line

            // CHANGED: Use 'text' (or 'json' if your database supports it) to store an array of statuses.
            $table->text('target_status');

            $table->text('body');               // The content of the email message

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
