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
        Schema::create('trainees', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->unsignedBigInteger('package_id')->nullable();  // nullable for when set null
            $table->foreign('package_id')
                ->references('id')->on('packages')
                ->onDelete('set null');
            $table->unsignedBigInteger('plan_id')->nullable();  // nullable for when set null
            $table->foreign('plan_id')
                ->references('id')->on('plans')
                ->onDelete('set null');
            $table->unsignedBigInteger('admin_id')->nullable();  // nullable for when set null
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('set null');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->integer('age');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->text('medical_history')->nullable();
            $table->string('gender');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
