<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->string('name')->after('id')->nullable();
        });

        // Copy data from title to name
        DB::table('systems')->update([
            'name' => DB::raw('title')
        ]);

        Schema::table('systems', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->string('name')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->string('title')->after('id');
        });

        DB::table('systems')->update([
            'title' => DB::raw('name')
        ]);

        Schema::table('systems', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};
