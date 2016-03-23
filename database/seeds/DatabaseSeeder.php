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
        $this->call(LecturerSeeder::class);
        $this->call(PHDStudentSeeder::class);
        $this->call(ModulesTableSeeder::class); 
        //$this->call(ModulesActivitiesTableSeeder::class);
    }
}
