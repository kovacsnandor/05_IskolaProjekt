<?php

namespace Database\Factories;

use App\Models\Diak;
use App\Models\Sport;
use App\Models\Sportolas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sportolas>
 */
class SportolasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Az összetett kulcsnak együtt kell egyedinek lenni
        //Olyan diák és sport párt keresünk, ami még nem volt
        do {
            $diakokId = Diak::inRandomOrder()->first()->id;
            $sportokId = Sport::inRandomOrder()->first()->id;
        } while (Sportolas::where('diakokId', $diakokId)->where('sportokId', $sportokId)->exists());
    

        return [
            'diakokId' => $diakokId,
            'sportokId' => $sportokId,
        ];
    }
}
