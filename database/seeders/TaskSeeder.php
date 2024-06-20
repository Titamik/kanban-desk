<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Random\RandomException;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $taskStatuses = TaskStatus::with('user')->get();

        foreach ($taskStatuses as $taskStatus) {
            $count = random_int(1, 5);

            Task::factory($count)
                ->sequence(function (Sequence $sequence) use ($taskStatus) {
                    return [
                        'user_id' => $taskStatus->user->id,
                        'task_status_id' => $taskStatus->id
                    ];
                })
                ->create();

        }
    }
}
