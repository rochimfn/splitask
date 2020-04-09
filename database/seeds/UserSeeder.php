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
        $users= [
            [
                'name'=> 'Rochim Farul Noviyan',
                'user_name' => 'rochim',
                'email' => 'rochim.noviyan@gmail.com',
                'password' => Hash::make('password'),
                'position' => 'administrator',
                'department_id' => '2',
            ],
            [
                'name'=> 'Benita Irmadiani',
                'user_name' => 'benita',
                'email' => 'benita.irmadiani@gmail.com',
                'password' => Hash::make('password'),
                'position' => 'chief',
                'department_id' => '1',
            ],
            [
                'name'=> 'Jihan Nabila',
                'user_name' => 'jihan',
                'email' => 'jihan.nabila@gmail.com',
                'password' => Hash::make('password'),
                'position' => 'manager',
                'department_id' => '3',
            ],
            [
                'name'=> 'Sarah Ahya',
                'user_name' => 'sarah',
                'email' => 'sarah.ahya@gmail.com',
                'password' => Hash::make('password'),
                'position' => 'staff',
                'department_id' => '3',
            ]
        ];
        DB::table('users')->insert($users);
    }
}
