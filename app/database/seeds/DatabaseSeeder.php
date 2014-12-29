<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::statement('SET foreign_key_checks = 0');
        DB::statement('SET UNIQUE_CHECKS=0');

        $tables = ['Organization'];
        foreach( $tables as $table ) {
            $this->call($table.'TableSeeder');
        }

        DB::statement('SET foreign_key_checks = 1');
        DB::statement('SET UNIQUE_CHECKS=1');
    }

}
