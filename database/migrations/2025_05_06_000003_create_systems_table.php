<?php

use App\Enums\DataStorageType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->longText('description')->nullable();
            $table->string('system_documentation_link')->nullable();
            $table->json('data_storage')->nullable();
            $table->boolean('security_password_policy_compliant')->default(false);
            $table->boolean('security_sso_connected')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
