<?php
// database/factories/ContractTerminationFactory.php

namespace Database\Factories;

use App\Models\ContractTermination;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractTerminationFactory extends Factory
{
    protected $model = ContractTermination::class;

    public function definition(): array
    {
        return [
            'contract_id' => Contract::factory(),
            'termination_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'reason' => $this->faker->sentence()
        ];
    }
}