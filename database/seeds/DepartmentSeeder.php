<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = [
                ['department_name' => 'Chief'],
                ['department_name' => 'Research and Development'],
                ['department_name' => 'Human Resource'],
                ['department_name' => 'Sales'],
                ['department_name' => 'Production']
            ];
        DB::table('departments')->insert($department);
    }
}
