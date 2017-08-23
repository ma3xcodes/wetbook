<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db     = \Config::get('database.connections.mysql.database');
        $user   = \Config::get('database.connections.mysql.username');
        $pass   = \Config::get('database.connections.mysql.password');
        $file = __DIR__ . DIRECTORY_SEPARATOR . "../Cities.sql";
        // $this->command->info($db);
        // $this->command->info($user);
        // $this->command->info($pass);

        @exec("mysql -u " . $user . " -p" . $pass . " " . $db . " < " . $file);
    }
}
