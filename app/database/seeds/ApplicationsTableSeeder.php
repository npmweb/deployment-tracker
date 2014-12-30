<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use NpmWeb\DeploymentTracker\Models\Application;

class ApplicationsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Application::truncate();
        foreach(range(1, 10) as $index)
        {
            Application::create([
                'name' => implode( ' ', array_map( 'ucfirst', $faker->words( $faker->numberBetween(1,3) ) ) ),
            ]);
        }
    }

}