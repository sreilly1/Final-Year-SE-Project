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
        //temporarily disable foreign key checks for the current database connection
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(LecturerSeeder::class);
        $this->call(PHDStudentSeeder::class);
        $this->call(ModulesTableSeeder::class); 
        $this->call(ActivitiesSeeder::class);
        $this->call(SessionsSeeder::class);
        $this->call(PHDStudentAssignmentSeeder::class);

        //re-enabling foreign key checks is not neccesarily required but do it anyway for safety reasons
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
