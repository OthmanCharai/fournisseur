<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Investment;
use App\Models\Investor;

class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'filing_date' => $this->faker->date(),
            'amount' => $this->faker->word,
            'cycle' => $this->faker->word,
            'investor_id' => Investor::factory(),
        ];
    }
}
