<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name' => ucfirst($this->faker->word()),
//            'code' => $this->faker->ean13(),
            'model_name' => ucwords($this->faker->unique->word()),
            'description' => $this->faker->text(rand(40, 60)),
            'brand_id' => rand(1, Brand::whereStatus(true)->count()),
            'product_type_id' => rand(1, 20),
//            'status' => $this->faker->boolean()
        ];
    }
}
