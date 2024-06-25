<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (DB::table('types')->exists()) {
            $this->command->info('Seeder Types già eseguito. Nessuna azione necessaria.');
            return;
        }
        $typesData =  config('types');
        // dd($typesData);

        foreach ($typesData as $curType) {
            $newType = new Type();

            // $newType->name = $curType['name'];
            // $newType->color = $curType['color'];
            // $newType->description = $curType['description'];
            $newType->fill($curType);
            $newType->save();
        }
    }
}
