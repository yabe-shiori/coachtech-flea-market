<?php

namespace Database\Factories;

use App\Models\ItemImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => function () {
                return \App\Models\Item::factory()->create()->id;
            },
            'image_path' => 'test_image.jpg',
        ];
    }
}
