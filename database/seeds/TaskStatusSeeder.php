<?php

use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names  = [
            'todo',
            'in progress',
            'testing',
            'done'
        ];

        foreach ($names as $name) {
            $taskStatus = new \App\TaskStatus();
            $taskStatus->name = $name;
            $taskStatus->save();
        }
    }
}
