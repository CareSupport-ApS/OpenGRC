<?php

namespace Tests\Unit;

use App\Enums\YesNoNa;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VendorTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_vendor(): void
    {
        $vendor = Vendor::create([
            'supplier' => 'Acme Inc.',
            'system' => 'Acme Cloud',
            'start_date' => '2024-01-01',
            'type' => 'Cloud / SaaS system',
            'it_security_policy' => YesNoNa::YES,
        ]);

        $this->assertDatabaseHas('vendors', [
            'supplier' => 'Acme Inc.',
            'system' => 'Acme Cloud',
        ]);
    }
}
