<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LecturersTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(ModulesActivitiesTableSeeder::class);
    }
}
