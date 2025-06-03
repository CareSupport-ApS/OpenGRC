<?php

namespace Database\Factories;

use App\Enums\VendorType;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->text(),
            'engagement_date' => Carbon::now(),
            'internal_owner_name' => $this->faker->name(),
            'internal_owner_email' => $this->faker->email(),
            'internal_owner_role' => $this->faker->jobTitle(),
            'business_area' => $this->faker->word(),
            'vendor_type' => $this->faker->randomElement(VendorType::class),
            'is_data_processor' => $this->faker->boolean(),
            'has_dpa' => $this->faker->boolean(),
            'key_contact_name' => $this->faker->name(),
            'key_contact_email' => $this->faker->email(),
            'key_contact_role' => $this->faker->jobTitle(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
