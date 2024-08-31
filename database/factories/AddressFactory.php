<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'country_id' => Country::all()->random()->id,
            'address1' => fake()->streetAddress(),
            'address2' => fake()->streetName(),
            'city' => fake()->city(),
            'pincode' => fake()->postcode(),
            'state' => fake()->state(),
        ];
    }
}
