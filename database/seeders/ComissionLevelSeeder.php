<?php

namespace Database\Seeders;

use App\Models\ComissionLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComissionLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $caomissionLevels = [
            [
                'level' => 1,
                'is_premium' => false,
                'left_points' => 20,
                'right_points' => 20,
                'point_value' => 10,
                'status' => ComissionLevel::STATUS['ACTIVE'],
            ],
            [
                'level' => 2,
                'is_premium' => false,
                'left_points' => 50,
                'right_points' => 50,
                'point_value' => 20,
                'status' => ComissionLevel::STATUS['ACTIVE'],
            ],
            [
                'level' => 3,
                'is_premium' => true,
                'left_points' => 100,
                'right_points' => 100,
                'point_value' => 50,
                'status' => ComissionLevel::STATUS['ACTIVE'],
            ],
        ];
        ComissionLevel::insert($caomissionLevels);
    }
}
