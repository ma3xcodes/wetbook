<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call(UsersTableSeeder::class);
        $this->call(LanguagesSeeder::class);
        //$this->call(CountriesTableSeeder::class);
        //$this->call(RegionsTableSeeder::class);
        //$this->call(CitiesTableSeeder::class);
    }
}
