<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\ShippingPrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingPrice>
 */
class ShippingPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => function () {
                return Factory(Customer::class)->create()->id;
            },
            'from_postcode' => $this->faker->postcode,
            'to_postcode' => $this->faker->postcode,
            'from_weight' => $this->faker->numberBetween(1, 50),
            'to_weight' => $this->faker->numberBetween(51, 100),
            'cost' => $this->faker->randomFloat(2, 10, 50)
        ];
    }
}
