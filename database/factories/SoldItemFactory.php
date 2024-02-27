<?php

namespace Database\Factories;

use App\Models\SoldItem;
use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoldItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SoldItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => Item::factory()->create()->id,
            'buyer_id' => User::factory()->create()->id,
            'seller_id' => User::factory()->create()->id,
            'sold_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
