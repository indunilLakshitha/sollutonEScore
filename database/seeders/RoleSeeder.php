<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Director', 'slug' => Role::SLUG_DIRECTOR, 'sort_order' => 1, 'full_access' => false],
            ['name' => 'Management', 'slug' => Role::SLUG_MANAGEMENT, 'sort_order' => 2, 'full_access' => false],
            ['name' => 'Leader', 'slug' => Role::SLUG_LEADER, 'sort_order' => 3, 'full_access' => false],
            ['name' => 'Representative', 'slug' => Role::SLUG_REPRESENTATIVE, 'sort_order' => 4, 'full_access' => false],
            ['name' => 'Admin (Full Access)', 'slug' => Role::SLUG_ADMIN, 'sort_order' => 5, 'full_access' => true],
        ];

        foreach ($roles as $row) {
            Role::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'name' => $row['name'],
                    'sort_order' => $row['sort_order'],
                    'full_access' => $row['full_access'],
                ]
            );
        }
    }
}
