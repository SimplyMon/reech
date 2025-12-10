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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // --- Campaign Header Fields ---
            $table->string('name');
            $table->string('type')->default('email_only'); // e.g., 'email_only'
            $table->text('description')->nullable();
            $table->string('status')->default('draft'); // e.g., 'draft', 'active', 'paused'

            // --- Campaign Step (Detail) Fields ---
            // We combine the first/only step's detail fields into the main table
            $table->string('step_name')->nullable();
            $table->string('step_type')->default('email_only'); // Always email_only for this example
            $table->foreignId('email_template_id')->constrained('email_templates')->onDelete('restrict');
            $table->string('preferred_property_type')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
