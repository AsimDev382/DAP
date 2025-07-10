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
        Schema::create('assign_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('auto_id')->nullable();
            $table->string('document')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('location')->nullable();
            // $table->string('group_member')->nullable();
            $table->string('status')->default('Active')->comment('Active', 'Inactive');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('group_id')->nullable();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_tasks');
    }
};
