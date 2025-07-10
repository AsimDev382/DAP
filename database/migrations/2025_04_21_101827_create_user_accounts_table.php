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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('auto_id')->nullable();
            $table->string('user_img')->nullable();
            $table->string('user_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('company_id')->nullable();
            $table->string('deparment')->nullable();
            $table->string('sub_deparment')->nullable();
            $table->string('user_location')->nullable();
            $table->string('password')->nullable();
            $table->string('user_address')->nullable();
            $table->string('detail')->nullable();
            $table->string('status')->comment('Active', 'Inactive')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
