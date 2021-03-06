<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(CategoeySeeder::class);
         $this->call(SliderSeeder::class);
         $this->call(SectionTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
    }
}
