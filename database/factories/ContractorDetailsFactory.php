<?php

namespace Database\Factories;

use App\Models\ContractorDetails;
use App\Models\Contractors;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractorDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractorDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'contractors_id' => Contractors::factory(),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
            'state' =>  $this->faker->state,
            'country' => $this->faker->country,
            'abn' => mt_rand(600000, 700000),
            'name_primarycontact' => $this->faker->name,
            'phone_primary' => $this->faker->tollFreePhoneNumber,
            'email_primary'=> $this->faker->unique()->safeEmail,
            'name_secondarycontact' => $this->faker->name,
            'phone_secondary' => $this->faker->tollFreePhoneNumber,
            'email_secondary' => $this->faker->unique()->safeEmail,
            'terms' => mt_rand(30,60) . ' ' . 'days',
            'currency' => $this->faker->currencyCode,
            'bankname' => ucwords($this->faker->word),
            'branch' => $this->faker->city,
            'accountname' => $this->faker->name,
            'bsb' => mt_rand(4315,9154),
            'accountnumber' => $this->faker->bankAccountNumber,
        ];
    }
}
