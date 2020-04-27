<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status =
        [
        	['status_code' => 0, 'status_description' => 'On Progress'],
        	['status_code' => 1, 'status_description' => 'Approved'],
        	['status_code' => 2, 'status_description' => 'Reported'],
        	['status_code' => 3, 'status_description' => 'Rejected']
        ];
        DB::table('work_task_status')->insert($status);
    }
}
