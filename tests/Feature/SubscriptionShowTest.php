<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\SubscriptionPackage;
use App\Models\SubscriptionPackageBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionShowTest extends TestCase
{
    public function test_home_page_displays_subscription_packages_with_links(): void
    {
        $package = SubscriptionPackage::first();

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        if ($package) {
            $response->assertSee(route('subscription.show', $package->id));
            $response->assertSee(strtoupper($package->name_package));
        }
    }

    public function test_subscription_detail_page_loads_package_and_linked_books(): void
    {
        $package = SubscriptionPackage::where('name_package', 'PREMIUM')->first();

        if (!$package) {
            $package = SubscriptionPackage::first();
        }

        $this->assertNotNull($package);

        $response = $this->get(route('subscription.show', $package->id));

        $response->assertStatus(200);
        $response->assertSee(strtoupper($package->name_package));
        $response->assertSee(number_format($package->price, 0, ',', '.'));
        $response->assertSee($package->description);
        $response->assertSee(route('home'));

        $linkedPackageBooks = SubscriptionPackageBook::where('subscription_package_id', $package->id)
            ->with('book')
            ->get();

        foreach ($linkedPackageBooks as $item) {
            if ($item->book) {
                $response->assertSee($item->book->title);
            }
        }
    }

    public function test_subscription_page_search_bar_filters_books_by_title(): void
    {
        $package = SubscriptionPackage::where('name_package', 'PREMIUM')->first();

        if (!$package) {
            $package = SubscriptionPackage::first();
        }

        $this->assertNotNull($package);

        // Cari buku dengan judul 'Rain'
        $response = $this->get(route('subscription.show', ['packageId' => $package->id, 'search' => 'Rain']));

        $response->assertStatus(200);
        $response->assertSee('Rain');

        // Cari kata kunci yang tidak ada
        $responseNonExistent = $this->get(route('subscription.show', ['packageId' => $package->id, 'search' => 'JudulTidakAda123']));

        $responseNonExistent->assertStatus(200);
        $responseNonExistent->assertSee('Buku tidak ditemukan');
    }
}
