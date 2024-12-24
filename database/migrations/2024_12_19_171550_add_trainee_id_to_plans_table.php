<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTraineeIdToPlansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->unsignedBigInteger('trainee_id')->nullable();  // Add trainee_id
            $table->foreign('trainee_id')
                ->references('id')->on('trainees')
                ->onDelete('cascade'); // Cascade delete when trainee is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropForeign(['trainee_id']); // Drop foreign key constraint
            $table->dropColumn('trainee_id');  // Drop the column
        });
    }
}
