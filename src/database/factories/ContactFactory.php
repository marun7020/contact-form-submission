<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tel = $this->faker->numerify('0##') . '-' . $this->faker->numerify('####') . '-' . $this->faker->numerify('####');

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $tel,
            'address' => $this->faker->address,
            'building' => $this->faker->buildingNumber,
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail' => $this->faker->text(120),
        ];
    }
}
