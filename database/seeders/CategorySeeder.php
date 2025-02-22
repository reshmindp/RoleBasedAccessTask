<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Technology',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Health',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Business',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Education',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lifestyle',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
