<?php

use App\Enums\ControlStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('controls', function (Blueprint $table) {
            $table->string('status')->default(ControlStatus::NOT_STARTED)->after('applicability');
        });
    }

    public function down(): void
    {
        Schema::table('controls', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
