<?php

namespace Database\Factories;

use App\Models\Documents;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Documents::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'required' => mt_rand(0,1),
            'documents__category_id' => mt_rand(1,4),
        ];
    }
}
