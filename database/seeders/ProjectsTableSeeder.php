<?php

namespace Database\Seeders;

use App\Models\Project;
use function Laravel\Prompts\table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(Faker $faker): void
    // {
    //     for ($i=0; $i < 10; $i++) {
    //         $newProject = new Project();
    //         $newProject->owner = $faker->sentence(2);
    //         $newProject->title = $faker->sentence(3);
    //         $newProject->description = $faker->text(255);
    //         $newProject->slug = Str::slug($newProject->title);
    //         $newProject->save();
    //     }
    // }

    public function run(): void
    {

        if (DB::table('projects')->exists()) {
            $this->command->info('Seeder Projects già eseguito. Nessuna azione necessaria.');
            return;
        }

        $projectData = config('projects');

        foreach ($projectData as $curProject) {
            $newProject = new Project();
            // $newProject->title = $curProject['title'];
            // $newProject->owner = $curProject['owner'];
            // $newProject->description = $curProject['description'];
            $newProject->type_id = rand(1, 5);
            $newProject->fill($curProject);
            $newProject->slug = Str::slug($curProject['title']);
            $newProject->save();

        }

    }
}
