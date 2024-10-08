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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('job_description');
            $table->bigInteger('salary');
            $table->enum('job_type', ['Full-Time', 'Part-Time', 'Contract', 'Temporary', 'Internship', 'Volunteer', 'On-Call'])->default('Full-Time');
            $table->boolean('remote')->default(false);
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->unsignedBigInteger('company_id');  // FK to companies
            $table->unsignedBigInteger('user_id');     // FK to users
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Remove foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['company_id']);

            $table->dropColumn(['user_id', 'company_id', 'title', 'job_description', 'salary', 'job_type', 'remote', 'requirements', 'benefits']);
        });
    }
};
