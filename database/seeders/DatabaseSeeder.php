<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
		DB::table('categorias')->insert(['nombre' => 'Informatica']);
		DB::table('categorias')->insert(['nombre' => 'Esports']);
		DB::table('categorias')->insert(['nombre' => 'Videojuegos']);
		DB::table('categorias')->insert(['nombre' => 'Television']);
		DB::table('categorias')->insert(['nombre' => 'Deportes']);
		DB::table('categorias')->insert(['nombre' => 'Politica']);
		DB::table('categorias')->insert(['nombre' => 'Internacional']);
		DB::table('categorias')->insert(['nombre' => 'Cocina']);
		DB::table('categorias')->insert(['nombre' => 'Economia']);
		DB::table('categorias')->insert(['nombre' => 'Medicina']);
		DB::table('categorias')->insert(['nombre' => 'Arte']);
		DB::table('categorias')->insert(['nombre' => 'Cultura']);
		DB::table('categorias')->insert(['nombre' => 'Moda']);
		DB::table('users')->insert(['email' => 'admin@akademika.com',
									'name' => 'Admin',
									'is_admin' => true,
									'password' => Hash::make('admin'),
		]);
    }
}
