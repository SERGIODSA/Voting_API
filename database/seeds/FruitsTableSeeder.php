<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FruitsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('fruits')->delete();

        DB::table('fruits')->insert([
        	'name'	=> 'Apple'
        ]);

        DB::table('fruits')->insert([
        	'name'	=> 'Orange'
        ]);

        DB::table('fruits')->insert([
        	'name'	=> 'Banana'
        ]);

        DB::table('fruits')->insert([
        	'name'	=> 'Pineapple'
        ]);
    }

}
?>