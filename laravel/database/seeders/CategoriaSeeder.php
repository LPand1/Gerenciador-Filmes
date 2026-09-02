<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Ação',
            'Aventura',
            'Comédia',
            'Drama',
            'Terror',
            'Ficção Científica',
            'Fantasia',
            'Romance',
            'Suspense',
            'Animação',
            'Documentário',
        ];

        foreach($categorias as $nome) {
            Categoria::create(['nome' => $nome]); 
        }
    }
}
