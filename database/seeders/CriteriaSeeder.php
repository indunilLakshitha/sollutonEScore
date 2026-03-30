<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\User;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@example.com')->first() ?? User::first();

        if ($adminUser) {
            $criteriaData = [
                [
                    'name' => 'Basic Criteria',
                    'description' => 'Basic level criteria for new users',
                    'count' => 1,
                    'added_by' => $adminUser->id,
                    'status' => true,
                ],
                [
                    'name' => 'Intermediate Criteria',
                    'description' => 'Intermediate level criteria for active users',
                    'count' => 5,
                    'added_by' => $adminUser->id,
                    'status' => true,
                ],
                [
                    'name' => 'Advanced Criteria',
                    'description' => 'Advanced level criteria for experienced users',
                    'count' => 10,
                    'added_by' => $adminUser->id,
                    'status' => true,
                ],
            ];

            foreach ($criteriaData as $criteria) {
                Criteria::create($criteria);
            }
        }
    }
}
