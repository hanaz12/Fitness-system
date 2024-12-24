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
        Schema::create('packages', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('admin_id')->nullable();  // nullable for when set null
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('set null');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('duration');
            $table->text('description');
            $table->decimal('discount', 5, 2)->nullable();
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
