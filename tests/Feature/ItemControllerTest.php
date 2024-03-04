<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class ItemControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndexDisplaysItemList(): void
    {
        $items = Item::factory()->count(5)->create();
        foreach ($items as $item) {
            $item->images()->create(['image_path' => 'path_to_image']);
        }

        $response = $this->get(route('user.item.index'));

        $response->assertStatus(200)
            ->assertViewHas('itemImages')
            ->assertViewHas('alreadyReceivedToday');
    }

    public function testItemShowPage(): void
    {
        $item = Item::factory()->create();

        $imagePath = storage_path('app/public/Images/dummy1.png');

        Storage::fake('public');
        $uploadedFile = UploadedFile::fake()->image($imagePath);
        $filePath = Storage::putFile('public/item_images', $uploadedFile);
        $item->images()->create([
            'image_path' => $filePath,
        ]);

        $response = $this->get(route('user.item.show', $item));

        $response->assertStatus(200);

        $response->assertSee($item->name);

        $response->assertSee($item->description);
    }

    public function testItemCreatePage(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('user.item.create'));

        $response->assertStatus(200);
        $response->assertViewIs('item.create');

        $response->assertViewHas('categories');
        $response->assertViewHas('brands');
    }

    public function testStoreMethodSuccess()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $category = Category::factory()->create();

        $image1 = UploadedFile::fake()->image('dummy1.png');
        $image2 = UploadedFile::fake()->image('dummy2.png');

        $data = [
            'name' => $this->faker->word,
            'price' => $this->faker->randomNumber(4),
            'condition' => '新品、未使用',
            'description' => $this->faker->sentence,
            'category_id' => [$category->id],
            'brand_id' => null,
            'image' => [$image1, $image2],
        ];

        $response = $this->actingAs($user)->post(route('user.item.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('user.item.index'));
    }

    public function testSearchMethod()
    {
        $item1 = Item::factory()->create([
            'name' => 'Item A',
            'price' => 100,
        ]);

        $item2 = Item::factory()->create([
            'name' => 'Item B',
            'price' => 200,
        ]);

        $item3 = Item::factory()->create([
            'name' => 'Item C',
            'price' => 300,
        ]);

        $response = $this->get('/search', ['query' => 'Item']);

        $response->assertStatus(200);
        $response->assertViewHas('items');

        $items = $response->viewData('items');

        $this->assertCount(3, $items);
        $this->assertEquals($item1->id, $items[0]->id);
        $this->assertEquals($item2->id, $items[1]->id);
        $this->assertEquals($item3->id, $items[2]->id);
    }

    public function testEditMethod(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('user.item.edit', $item));

        $response->assertStatus(200)
            ->assertViewIs('item.edit')
            ->assertViewHas('item', $item)
            ->assertViewHas('categories')
            ->assertViewHas('brands')
            ->assertViewHas('conditions');
    }

    public function testUpdateMethod(): void
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create(['user_id' => $user->id]);
        $data = [
            'name' => 'Updated Name',
            'price' => 1000,
            'condition' => '新品、未使用',
            'description' => 'Updated description',
            'category_id' => [1],
        ];

        $response = $this->patch(route('user.item.update', $item), $data);

        $response->assertSessionHasErrors(['image', 'category_id']);
    }
}


