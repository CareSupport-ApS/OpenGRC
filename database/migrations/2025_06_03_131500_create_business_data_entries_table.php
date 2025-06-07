<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_data_entries', function (Blueprint $table) {
            $table->id();
            $table->json('data_types');
            $table->morphs('processable');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_data_entries');
    }
};
