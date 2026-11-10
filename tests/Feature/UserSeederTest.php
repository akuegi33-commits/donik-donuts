<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_default_admin_and_cashier_accounts_only_once(): void
    {
        $this->seed(UserSeeder::class);
        $this->seed(UserSeeder::class);

        $this->assertDatabaseCount('users', 2);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@donikdonuts.com',
            'role' => 'admin',
            'is_active' => true,
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'kasir@donuts.com',
            'role' => 'kasir',
            'is_active' => true,
        ]);

        $this->assertTrue(Hash::check('admin123', User::where('email', 'admin@donikdonuts.com')->firstOrFail()->password));
        $this->assertTrue(Hash::check('donuts123', User::where('email', 'kasir@donuts.com')->firstOrFail()->password));
    }

    public function test_it_does_not_overwrite_existing_admin_credentials_or_status(): void
    {
        $admin = User::create([
            'name' => 'Custom Admin',
            'email' => 'admin@donikdonuts.com',
            'password' => Hash::make('custom-password'),
            'role' => 'admin',
            'is_active' => false,
        ]);

        $this->seed(UserSeeder::class);

        $this->assertSame($admin->id, User::where('email', 'admin@donikdonuts.com')->firstOrFail()->id);
        $this->assertTrue(Hash::check('custom-password', $admin->fresh()->password));
        $this->assertFalse($admin->fresh()->is_active);
    }
}
