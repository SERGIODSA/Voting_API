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

        $this->call(FruitsTableSeeder::class);

        $this->command->info('Fruits table seeded!');

        $this->call(UsersTableSeeder::class);

        $this->command->info('User table seeded!');
    }
}