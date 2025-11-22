<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), // Gera um nome falso
        
            // Simplesmente define um caminho fictício (você deve colocar as imagens reais neste caminho depois)
            'image_path' => 'img/persons/' . $this->faker->numberBetween(1, 10) . '.jpg', 
            
            // Os padrões definidos na Migration (1000 e 0) são usados automaticamente, mas podemos ser explícitos:
            'score' => 1000, 
            'votes_received' => 0,
        ];
    }
}
