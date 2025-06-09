<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('implementation_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('implementation_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('status')->default('Pending');
            $table->text('completion_notes')->nullable();
            $table->date('task_date')->nullable();
            $table->foreignId('attachment_id')->nullable()->constrained('attachments')->nullOnDelete();
            $table->string('recurrence')->default('None');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('implementation_tasks');
    }
};
