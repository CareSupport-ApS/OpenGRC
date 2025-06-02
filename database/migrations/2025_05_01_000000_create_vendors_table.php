<?php

use App\Enums\YesNoNa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('supplier')->nullable();
            $table->string('system')->nullable();
            $table->date('start_date')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_role')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('business_area')->nullable();
            $table->string('business_process_owner')->nullable();
            $table->string('system_owner')->nullable();
            $table->string('primary_user')->nullable();
            $table->string('primary_it')->nullable();
            $table->string('it_security_policy')->default(YesNoNa::NA);
            $table->string('sso_ad')->default(YesNoNa::NA);
            $table->string('password_policy')->default(YesNoNa::NA);
            $table->string('iso27001')->default(YesNoNa::NA);
            $table->string('contract_collected')->default(YesNoNa::NA);
            $table->string('contract_location')->nullable();
            $table->text('contract_justification')->nullable();
            $table->string('sla_collected')->default(YesNoNa::NA);
            $table->string('sla_location')->nullable();
            $table->text('sla_justification')->nullable();
            $table->string('dpa_collected')->default(YesNoNa::NA);
            $table->string('dpa_location')->nullable();
            $table->text('dpa_justification')->nullable();
            $table->string('privacy_policy_collected')->default(YesNoNa::NA);
            $table->string('privacy_policy_location')->nullable();
            $table->text('privacy_policy_justification')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
