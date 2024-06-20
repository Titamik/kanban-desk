<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Random\RandomException;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        $teams = Team::query()->pluck('id');

        foreach ($teams as $team) {
            $count = random_int(2, 10);

            User::factory($count)
                ->sequence(function (Sequence $sequence) use ($teams, $team) {
                    return [
                        'team_id' => $team
                    ];
                })
                ->create();
        }
    }
}
