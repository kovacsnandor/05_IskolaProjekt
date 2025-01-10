<?php

namespace Database\Factories;

use App\Helpers\VeletlenClass;
use App\Models\Osztaly;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diak>
 */
class DiakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Faker objektum létrehozás adott nyelven
        $faker = Faker::create('hu_HU');

        //Dátum generálás
        $minDate = '2010-01-01';
        $maxDate = '2015-12-31';
        $randomDate = fake()->date('Y-m-d', $maxDate);

        // Ha a generált dátum kisebb, mint a minimális dátum, akkor újra generálunk
        while ($randomDate < $minDate) {
            $randomDate = fake()->date('Y-m-d', $maxDate);
        }

        //Neme generálás
        $neme = fake()->boolean;
        
        //Megfelelő nemű név generálása Faker-el
        if ($neme) {
            //férfi
            $nev =$faker->lastName(). " ". $faker->firstNameMale();
        } else {
            //nő
            $nev =$faker->lastName(). " ". $faker->firstNameFemale();
        }
        
        //Véletlen oszályId kiolvasása az ostalies táblából
        $osztalyId = Osztaly::inRandomOrder()->first()->id;

        return [
            'nev' => $nev,
            'neme' => $neme,
            'osztalyId' => $osztalyId,
            'szuletett' => $randomDate,
            // 'helyseg' => VeletlenClass::randomVaros(),
            'helyseg' =>  $faker->city(),
            'osztondij' => fake()->numberBetween(5000, 7000),
            'atlag' => fake()->randomFloat(1, 1, 5)
        ];
    }
}
