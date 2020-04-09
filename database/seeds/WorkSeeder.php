<?php

use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $works =
            [
                [
                    'work_name' => 'Bikin Aplikasi',
                    'work_description' => 'Selesaikan Splitask',
                    'work_deadline' => '2020-10-10',
                    'work_status' => 0,
                    'user_id' => 3,
                    'department_id' => 3,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d')
                ],
                [
                    'work_name' => 'Bikin Kuliah tamu',
                    'work_description' => 'Buat kuliah tamu tentang Splitask',
                    'work_deadline' => '2020-02-10',
                    'work_status' => 0,
                    'user_id' => 3,
                    'department_id' => 3,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d')
                ]
            ];
        DB::table('works')->insert($works);
    }
}
