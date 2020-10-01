<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (! Achievement::whereName('Adventurer')->exists()) {
            Achievement::create([
                'name' => 'Adventurer',
                'description' => 'Complete 20 quests',
            ]);
        }

        if (! Achievement::whereName('Veteran')->exists()) {
            Achievement::create([
                'name' => 'Veteran',
                'description' => 'Reach level 5',
            ]);
        }
    }
}
