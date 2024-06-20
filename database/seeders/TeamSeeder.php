<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::query()->pluck('id');

        $defaultTeams = $this->getDefaultTeams();

        foreach ($projects as $project) {
            Team::factory(5)
                ->sequence(function (Sequence $sequence) use ($defaultTeams, $project) {
                    return [
                        'title' => $defaultTeams[$sequence->index],
                        'project_id' => $project
                    ];
                })
                ->create();
        }
    }

    private function getDefaultTeams(): array
    {
        return [
            'SEO',
            'Разработка',
            'Дизайн',
            'Маркетинг',
            'Контент',
        ];
    }
}
