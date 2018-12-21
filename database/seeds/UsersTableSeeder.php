<?php

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder {

        public function run()
        {
            DB::table('users')->delete();

            DB::table('users')->insert([
            	'id'	=> '1',
            	'name'	=> 'Jane',
            	'email' => 'jane@doe.com',
            	'password' => Hash::make('123abc')
            ]);

            DB::table('users')->insert([
            	'id' 	=> '2',
            	'name'	=> 'John',
            	'email' => 'john@doe.com',
            	'password' => Hash::make('321cba')
            ]);
        }

    }
?>