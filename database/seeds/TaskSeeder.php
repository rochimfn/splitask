<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks =
            [
                [
                    'task_name' => 'Bikin proposal',
                    'task_description' => 'Proposal harus jadi dalam seminggu',
                    'task_deadline' => '2020-10-02',
                    'task_status' => 0,
                    'user_id' => 4,
                    'work_id' => 1,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d')
                ],
                [
                    'task_name' => 'Bikin poster',
                    'task_description' => 'Poster harus jadi dalam 3 hari',
                    'task_deadline' => '2020-10-02',
                    'task_status' => 0,
                    'user_id' => 4,
                    'work_id' => 1,
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d')
                ]
            ];
        DB::table('tasks')->insert($tasks);
    }
}
