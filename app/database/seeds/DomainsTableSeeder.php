<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use NpmWeb\DeploymentTracker\Models\Domain;

class DomainsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Domain::truncate();
        foreach(range(1, 30) as $ipAddressId) {
            foreach(range(1, 2) as $index)
            {
                Domain::create([
                    'ip_address_id' => $ipAddressId,
                    'name' => $faker->domainName,
                ]);
            }
        }
    }

}