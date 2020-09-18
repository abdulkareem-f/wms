<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'first_name' 		=> 	'Admin',
	        'last_name' 		=> 	'Admin',
	        'email' 			=> 	'admin@admin.com',
	        'phone'				=>	'+0987654321',
	        'role'				=>	'admin',
	        'password' 			=> 	Hash::make('admin_admin'),
	        'remember_token' 	=> 	Str::random(10),
            'created_at'        =>  now(),
            'updated_at'        =>  now(),
        ]);

        DB::table('users')->insert([
            'first_name'        =>  'Warehouse',
            'last_name'         =>  'Keeper',
            'email'             =>  'warehouse@keeper.com',
            'phone'             =>  '+0987654321',
            'role'              =>  'warehouse_keeper',
            'password'          =>  Hash::make('warehouse_keeper'),
            'remember_token'    =>  Str::random(10),
            'created_at'        =>  now(),
            'updated_at'        =>  now(),
        ]);

        factory(App\User::class, 10)->create();
    }
}
