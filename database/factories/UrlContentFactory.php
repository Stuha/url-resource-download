<?php

namespace Database\Factories;

use App\Models\UrlContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class UrlContentFactory extends Factory
{
    protected $model = UrlContent::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $url = $this->faker->url();

        return [
            'id' => rand(),
            'url' => $url,
            'filename' => basename($url),
            'status' => 'pending',
        ];
    }
}
