<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::factory()->create([
        'categorie' => 'boissons_fraiches'
        ]);

        Categorie::factory()->create([
        'categorie' => 'boissons_chaudes'
        ]);

        Categorie::factory()->create([
        'categorie' => 'aliments_sucrés'
        ]);

        Categorie::factory()->create([
        'categorie' => 'aliments_salés'
        ]);
    }
}
