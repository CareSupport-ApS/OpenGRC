<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_data_entries', function (Blueprint $table) {
            $table->id();
            $table->string('subject_category');
            $table->json('data_types');
            $table->morphs('processable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_data_entries');
    }
};
