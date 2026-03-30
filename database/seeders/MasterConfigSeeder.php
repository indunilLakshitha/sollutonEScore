<?php

namespace Database\Seeders;

use App\Models\MasterData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MasterConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $masterData = MasterData::first();
        if (!isset($masterData)) {
            MasterData::create([
                'comission_password' => Hash::make('123456789'),
                'default_parent_id' => 1,
            ]);
        }
    }
}
