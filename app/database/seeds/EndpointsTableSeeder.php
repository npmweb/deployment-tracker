<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use NpmWeb\DeploymentTracker\Models\Endpoint;

class EndpointsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Endpoint::truncate();
        foreach(range(1, 10) as $index)
        {
            Endpoint::create([
                'application_id' => $index,
                'name' => 'Frontend',
            ]);
            Endpoint::create([
                'application_id' => $index,
                'name' => 'Backend',
            ]);
        }
    }

}