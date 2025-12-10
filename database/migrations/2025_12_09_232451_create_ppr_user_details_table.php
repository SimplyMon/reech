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
        Schema::create('ppr_user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('ppr_users')->onDelete('cascade'); // Links to your ppr_users table

            // Profile Picture (Added here)
            $table->string('profile_picture_path')->nullable();

            // Personal Information
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('gender')->nullable(); // 'Male', 'Female', etc.

            // Address & Contact
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('phone_number')->nullable();

            // Agent Information
            $table->string('license_number')->nullable();
            $table->date('license_expiration_date')->nullable();

            // Agency Information
            $table->string('agency_name')->nullable();
            $table->string('agency_phone_number')->nullable();
            $table->string('agency_address')->nullable();

            // Digital Signature (File Path)
            $table->string('signature_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppr_user_details');
    }
};
