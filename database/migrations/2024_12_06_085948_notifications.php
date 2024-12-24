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

            Schema::create('notifications', function (Blueprint $table) {
                $table->id('id');

                // Sender details
                $table->unsignedBigInteger('sender_id')->nullable();
                $table->enum('sender_type', ['Admin', 'Coach', 'AdminModerator', 'Trainee'])->nullable(); // Enum for sender type

                // Receiver details
                $table->unsignedBigInteger('receiver_id')->nullable();
                $table->enum('receiver_type', ['Admin', 'Coach', 'AdminModerator', 'Trainee'])->nullable(); // Enum for receiver type

                $table->text('message'); // محتوى الرسالة

                // Status of the message (e.g., read or unread)
                $table->enum('status', ['unread', 'read'])->default('unread'); // يمكن أن تكون: unread أو read

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

