<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use NpmWeb\DeploymentTracker\Models\EnvironmentEndpoint;

class EnvironmentEndpointsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        EnvironmentEndpoint::truncate();
        foreach(range(1, 2) as $environment)
        {
            foreach(range(1, 20) as $endpoint)
            {
                EnvironmentEndpoint::create([
                    'environment_id' => $environment,
                    'endpoint_id' => $endpoint,
                    'domain_id' => (20 * ($environment-1)) + $endpoint, // TODO make this valid data
                    'path' => '/' . implode('/', $faker->words( $faker->numberBetween(1,3) ) ),
                ]);
            }
        }
    }

}