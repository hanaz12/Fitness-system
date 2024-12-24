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
        Schema::create('plans', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->unsignedBigInteger('coach_id')->nullable();  // nullable for when set null
            $table->foreign('coach_id')
                ->references('id')->on('coaches')
                ->onDelete('set null');
            $table->string('plan_name');
            $table->text('description');
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
