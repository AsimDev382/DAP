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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->nullable();
            $table->string('brand_logo')->nullable();
            $table->string('brand_pdf')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('detail')->nullable();
            $table->string('status')->nullable()->comment('Active', 'Inactive')->default('Active');
            // $table->string('user_id')->nullable();
            $table->string('company_id')->nullable();

            // $table->unsignedBigInteger('user_id')->nullable(); // or not nullable based on your needs
            // $table->unsignedBigInteger('company_id')->nullable();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
