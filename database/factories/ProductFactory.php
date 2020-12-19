<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Str::random(10)

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
//		$types_arr = [
//			'shampoo', //'Шампунь',
//			'conditioner',//'Кондиціонер',
//			'mask',//'Маска',
//			'ampule',//'Ампули',
//			'milk',//'Молочко',
//			'lotions', //'Лосьйон',
//			'elixir',//'Еліксир',
//			'spray',//'Спрей',
//			'coloring',//'Колорінг',
//			'styling',//'Стайлінг',
//			'protection',//'Захист',
//			'cream',//'Крем для волосся',
//			'oil','Олія',
//			'kit',//'Набір',
//			'veil',//'Гель-вуаль',
//		];
//
//		$brands_arr = [
//			'farmavita',
//			'davines',
//			'joico',
//			'profistyle',
//			'felps',
//			'schwarzkopf',
//			'mirella',
//			'altrego'
//		];



		return [
            'image' => '//lorempixel.com/500/600/fashion/?t='.microtime(),
			'title' => $this->faker->paragraph(5),
            'city' => $this->faker->city,
            'meters' => $this->faker->postcode,
			'category' => $this->faker->paragraph(5),
			'descr' => $this->faker->paragraph(5),
			'price' => $this->faker->postcode,
		];
	}
}
// $table->string('articul')->nullable();
// $table->text('descr')->nullable();
// $table->string('type')->nullable(); // вид продукции
// $table->string('brand')->nullable(); // 
// $table->string('seria')->nullable();
// $table->string('amount')->nullable(); // 
// $table->tinyInteger('helth')->default(0);
// $table->tinyInteger('salon')->default(0);
// $table->tinyInteger('reconstruction')->default(0);
// $table->tinyInteger('protection')->default(0);
// $table->tinyInteger('coloring')->default(0);
// $table->tinyInteger('stratening')->default(0);
// $table->tinyInteger('natural')->default(0);
// $table->tinyInteger('curl')->default(0);
// $table->tinyInteger('skin')->default(0);
// $table->tinyInteger('yellow')->default(0);
// $table->tinyInteger('volume')->default(0);
// $table->tinyInteger('sebo')->default(0);
// $table->tinyInteger('lupa')->default(0);
// $table->tinyInteger('loss')->default(0);
// $table->string('gender')->nullable(); // men, women, all