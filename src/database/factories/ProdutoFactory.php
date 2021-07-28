<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->words(1, true),
            'descricao' => $this->faker->realText(100),
            'fabricante' => $this->faker->name(),
            'tarja' => $this->faker->words(1, true),
            'preco' => $this->faker->numberBetween(500, 3000),        
        ];
    }
}
