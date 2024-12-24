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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->unsignedBigInteger('trainee_id');
            $table->foreign('trainee_id')
                ->references('id')->on('trainees')
                ->onDelete('cascade');
            $table->decimal('amount', 8, 2); // المبلغ
            $table->string('method'); // طريقة الدفع
            $table->string('status'); // الحالة (مثل "مكتمل" أو "قيد الانتظار")
            $table->string('getwayID'); // معرف بوابة الدفع
            $table->string('getwayName'); // اسم بوابة الدفع
            $table->string('payNumber'); // رقم الدفع
            $table->date('payment_date'); // تاريخ الدفع
            $table->timestamps(); // إضافة حقل الوقت
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
