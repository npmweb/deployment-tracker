<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use NpmWeb\DeploymentTracker\Models\Server;

class ServersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        Server::truncate();
        foreach(range(1, 10) as $index)
        {
            Server::create([
                'display_name' => $faker->word,
                'hostname' => $faker->domainName,
            ]);
        }
    }

}