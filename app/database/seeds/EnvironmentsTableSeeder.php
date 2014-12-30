<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use NpmWeb\DeploymentTracker\Models\Environment;

class EnvironmentsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Environment::truncate();
        Environment::create(['name'=>'Test']);
        Environment::create(['name'=>'Production']);
    }

}