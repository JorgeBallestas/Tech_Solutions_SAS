<?php
// database/factories/ContractExtensionFactory.php

namespace Database\Factories;

use App\Models\ContractExtension;
use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractExtensionFactory extends Factory
{
    protected $model = ContractExtension::class;

    public function definition(): array
    {
        $type = $this->faker->randomElement(['Tiempo', 'Valor']);
        
        return [
            'contract_id' => Contract::factory(),
            'extension_type' => $type,
            'new_end_date' => $type === 'Tiempo' ? $this->faker->dateTimeBetween('+1 month', '+1 year') : null,
            'additional_value' => $type === 'Valor' ? $this->faker->randomFloat(2, 100000, 2000000) : null,
            'description' => $this->faker->sentence()
        ];
    }
}