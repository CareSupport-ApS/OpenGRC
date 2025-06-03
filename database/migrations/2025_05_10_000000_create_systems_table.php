<?php

use App\Enums\YesNoNa;
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
            $table->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('system_document_link')->nullable();
            $table->string('security_password_policy_compliant')->default(YesNoNa::NA);
            $table->string('security_sso_connected')->default(YesNoNa::NA);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
