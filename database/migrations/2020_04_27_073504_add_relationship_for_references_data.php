<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipForReferencesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('position')->references('position')->on('roles');
        });
        Schema::table('works', function (Blueprint $table) {
            $table->foreign('work_status')->references('status_code')->on('work_task_status');
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('task_status')->references('status_code')->on('work_task_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
