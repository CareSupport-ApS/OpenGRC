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
        Schema::table('controls', function (Blueprint $table) {
            $table->foreignId('parent_control_id')
                ->nullable()
                ->constrained('controls')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('controls', function (Blueprint $table) {
            $table->dropForeign(['parent_control_id']);
            $table->dropColumn('parent_control_id');
        });
    }
};
