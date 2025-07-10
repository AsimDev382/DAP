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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('password')->nullable();
            $table->string('mou_start_date')->nullable();
            $table->string('mou_end_date')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_pdf')->nullable();
            $table->string('company_detail')->nullable();
            $table->string('status')->comment('Active', 'Inactive')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
