<?php

namespace Tests\Feature;

use App\Models\Checkout;
use App\Models\SubscriptionPackage;
use App\Models\SubscriptionPackageUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_accessing_profile(): void
    {
        $response = $this->get(route('profile'));

        $response->assertRedirect(route('login'));
    }

    public function test_logged_in_user_can_view_profile_page(): void
    {
        $user = User::factory()->create([
            'name' => 'Fema',
            'email' => 'fema@example.com',
        ]);

        $package = SubscriptionPackage::create([
            'name_package' => 'Fiksi',
            'description' => 'Paket novel fiksi',
            'color' => '#ff0000',
            'price' => 50000,
        ]);

        SubscriptionPackageUser::create([
            'user_id' => $user->id,
            'subscription_package_id' => $package->id,
            'expired_date' => now()->addDays(30)->format('Y-m-d'),
        ]);

        $response = $this->actingAs($user)->get(route('profile'));

        $response->assertStatus(200);
        $response->assertSee('Fema');
        $response->assertSee('FE');
        $response->assertSee('Profil Summary');
        $response->assertSee('Koleksi Buku');
        $response->assertSee('Langganan');
        $response->assertSee('Transaksi');
        $response->assertSee('Paket Langganan');
        $response->assertSee('Buku');
        $response->assertSee('Fiksi');
        $response->assertSee('Rp 50.000');
        $response->assertSee('Transaksi Sukses');
        $response->assertSee('Berlaku sd :');
    }

    public function test_navbar_displays_profile_button_beside_logout(): void
    {
        $user = User::factory()->create([
            'name' => 'Fema',
        ]);

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee(route('profile'));
        $response->assertSee('FE');
        $response->assertSee(route('logout'));
    }
}
