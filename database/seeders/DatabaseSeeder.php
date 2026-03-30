<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;



use App\Traits\UniqueIdTrait;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use UniqueIdTrait;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
            CriteriaSeeder::class,
        ]);
    }
}
