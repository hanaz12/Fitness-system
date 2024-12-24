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
    Schema::create('admins', function (Blueprint $table) {
        $table->id('id');
        $table->unsignedBigInteger('admin_moderator_id')->nullable();  // nullable for when set null
            $table->foreign('admin_moderator_id')
                ->references('id')->on('admin_moderators')
                ->onDelete('set null');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('user_name')->unique();
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('address');
        $table->string('password');
        $table->decimal('salary', 10, 2)->nullable();
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
