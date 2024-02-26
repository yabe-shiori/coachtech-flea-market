<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'brand_id' => null,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'condition' => $this->faker->randomElement([
                '新品、未使用',
                '未使用に近い',
                '目立った傷や汚れなし',
                'やや傷や汚れあり',
                '傷や汚れあり',
                '全体的に状態が悪い'
            ]),
            'description' => $this->faker->text,
            'is_sold' => $this->faker->boolean,
        ];
    }
}
