<?php

use App\Enums\VendorType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->date('engagement_date')->nullable();
            $table->string('internal_owner_name')->nullable();
            $table->string('internal_owner_email')->nullable();
            $table->string('internal_owner_role')->nullable();
            $table->string('business_area')->nullable();
            $table->enum('vendor_type', array_column(VendorType::cases(), 'value'))->default(VendorType::SERVICE_PROVIDER->value);
            $table->boolean('is_data_processor')->default(false);
            $table->boolean('has_dpa')->default(false);
            $table->string('key_contact_name')->nullable();
            $table->string('key_contact_email')->nullable();
            $table->string('key_contact_role')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
