<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->pluck('id');

        $defaultTaskStatuses = $this->getDefaultTaskStatuses();

        foreach ($users as $user) {
            TaskStatus::factory(4)
                ->sequence(function (Sequence $sequence) use ($defaultTaskStatuses, $user) {
                    return [
                        'title' => $defaultTaskStatuses[$sequence->index],
                        'user_id' => $user
                    ];
                })
                ->create();
        }
    }

    private function getDefaultTaskStatuses(): array
    {
        return [
            'Нужно сделать',
            'В работе',
            'Сделано',
            'Завершено'
        ];
    }
}
