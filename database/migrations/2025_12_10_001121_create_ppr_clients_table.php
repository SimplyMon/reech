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
        Schema::create('ppr_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('ppr_users')->onDelete('cascade');
            // Add this line near the top
            $table->string('profile_picture_path')->nullable();

            // Personal Information
            $table->string('email')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('gender')->nullable(); // Male, Female, etc.
            $table->date('date_of_birth')->nullable();
            $table->string('marital_status')->nullable(); // Single, Married, etc.
            $table->string('occupation')->nullable();

            // Contact & Location
            $table->string('phone_number')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('neighborhood')->nullable();

            // Real Estate Preferences
            $table->decimal('budget_min', 15, 2)->nullable(); // Budget From
            $table->decimal('budget_max', 15, 2)->nullable(); // Budget To
            $table->string('preferred_property_type')->nullable(); // Condo, House, etc.
            $table->string('preferred_location')->nullable();

            // Contact Preferences
            $table->string('preferred_contact_method')->nullable(); // Email, Phone, Text
            $table->time('contact_time_preference_from')->nullable();
            $table->time('contact_time_preference_to')->nullable();
            $table->string('contact_day_preference')->nullable(); // Weekdays, Weekends, Any

            // System Status
            $table->string('client_status')->default('Active'); // Active, Lead, Closed
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppr_clients');
    }
};
