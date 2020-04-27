<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =
        [
        	['position' => 'administrator', 'position_description' => 'Role untuk Super User'],
        	['position' => 'chief', 'position_description' => 'Role khusus Chief'],
        	['position' => 'manager', 'position_description' => 'Role untuk manager sebuah department'],
        	['position' => 'staff', 'position_description' => 'Role untuk pekerja/staff department']
        ];
        DB::table('roles')->insert($roles);
    }
}
