<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\UploadedFile;
use App\Models\Profile;
use App\Models\SoldItem;
use App\Models\ItemImage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
    }

    public function testIndex()
    {
        $user = User::factory()->create();
        $items = Item::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get(route('user.mypage.index'));

        $response->assertStatus(200);

        $response->assertViewHas('user', $user);

        $response->assertViewHas('userItems', $items);
    }

    public function testEditProfilePage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.mypage.edit'));

        $response->assertStatus(200);

        $response->assertViewHas('user', $user);
    }

    public function testShowShippingAddressForm()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('user.showShippingAddressForm', ['itemId' => 'dummy']));

        $response->assertStatus(200);
        $response->assertViewIs('payment.shipping');
        $response->assertViewHas('user');
        $response->assertViewHas('profile');
    }

    public function testPurchasedItems()
    {
        $user = User::factory()->create();

        $soldItem = SoldItem::factory()->create(['buyer_id' => $user->id]);
        $image = ItemImage::factory()->create(['item_id' => $soldItem->item_id]);

        $response = $this->actingAs($user)->get(route('user.mypage.purchasedItems'));

        $response->assertStatus(200);

        $response->assertViewHas('purchasedItems', function ($purchasedItems) use ($soldItem) {
            return $purchasedItems->contains($soldItem);
        });
    }

    public function testProfileUpdateRequestValidation()
    {
        $data = [
            'name' => 'John Doe',
            'avatar' => UploadedFile::fake()->image('avatar.jpg')->size(2048),
            'display_name' => 'John',
            'introduction' => 'Hello, I am John.',
            'postal_code' => '12345678',
            'address' => '123 Main Street',
            'building_name' => 'Building A',
        ];

        $response = $this->patch(route('user.mypage.update'), $data);

        $response->assertRedirect()->assertSessionHasNoErrors();

        $invalidData = array_merge($data, [
            'name' => '',
            'avatar' => UploadedFile::fake()->create('document.pdf', 5000),
            'postal_code' => '123456789',
            'introduction' => str_repeat('a', 1001),
        ]);

        $response = $this->patch(route('user.mypage.update'), $invalidData);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', ['name' => '']);
    }

    public function testShippingAddressUpdateSuccess()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['user_id' => $user->id]);
        $profile = Profile::factory()->create(['user_id' => $user->id]);

        $data = [
            'postal_code' => '123-4567',
            'address' => '123 Main Street',
            'building_name' => 'Building A',
        ];

        $response = $this->actingAs($user)->patch(route('user.updateShippingAddress', ['itemId' => $item->id]), $data);
        $response->assertRedirect(route('user.payment.create', ['item' => $item->id]))
            ->assertSessionHas('message', '住所を変更しました');

        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'postal_code' => $data['postal_code'],
            'address' => $data['address'],
            'building_name' => $data['building_name'],
        ]);
    }

    public function testShippingAddressUpdateValidation()
    {
        $user = User::factory()->create();

        $invalidData = [
            'postal_code' => '',
            'address' => '123 Main Street',
            'building_name' => 'Building A',
        ];

        $response = $this->actingAs($user)->patch(route('user.updateShippingAddress', ['itemId' => 1]), $invalidData);
        $response->assertRedirect()
            ->assertSessionHasErrors(['postal_code']);
    }

    public function testShowUserProfile()
    {
        $user = User::factory()->create();

        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'display_name' => '太郎'
        ]);

        $response = $this->get(route('user.profile.show', $user->id));

        $response->assertStatus(200);

        $response->assertViewIs('mypage.user-profile');
    }
}
