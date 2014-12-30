<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use NpmWeb\DeploymentTracker\Models\IpAddress;

class IpAddressesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        IpAddress::truncate();
        foreach(range(1, 10) as $serverId) {
            foreach(range(1, 3) as $index)
            {
                IpAddress::create([
                    'server_id' => $serverId,
                    'public_address' => $faker->ipv4,
                    'private_address' => $faker->localIpv4,
                ]);
            }
        }
    }

}