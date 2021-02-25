<?php

namespace Database\Factories;

use App\Models\Technicians;
use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechniciansFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Technicians::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roleuser = RoleUser::where('role_id', 3)->pluck('id')->first();

      return [
            'name' => $this->faker->name,
            'status' => mt_rand(0,1),
            'contractors_id' => mt_rand(1,5),
            'role_users_id' => $roleuser
        ]; 
    }
}
