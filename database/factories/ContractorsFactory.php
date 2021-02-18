<?php

namespace Database\Factories;

use App\Models\Contractors;
use App\Models\RoleUser;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractorsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contractors::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'status' => mt_rand(0,1),
            'role_user_id' => RoleUser::factory(),
        ];
    }
}
