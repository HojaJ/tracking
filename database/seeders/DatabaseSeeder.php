<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        \App\Models\Storage::create([
            'name' => 'Guangzhou',
        ]);
        \App\Models\Storage::create([
            'name' => 'Pekin',
        ]);
        \App\Models\Storage::create([
            'name' => 'shanghai',
        ]);

        \App\Models\Shipping::create([
            'name_ru' => 'Водный транспорт',
            'name_tk' => 'Suw Üsti',
            'name_en' => 'Water transport',
        ]);
        \App\Models\Shipping::create([
            'name_ru' => 'Железнодорожный транспорт',
            'name_tk' => 'Garaýol',
            'name_en' => 'Railway transport'
        ]);
        \App\Models\Shipping::create([
            'name_ru' => 'Автотранспорт',
            'name_en' => 'Motor transport',
            'name_tk' => 'Awtotransport'
        ]);
        \App\Models\Shipping::create([
            'name_ru' => 'Авиатранспорт',
            'name_en' => 'Air transport',
            'name_tk' => 'Awiýatransport'
        ]);
        \App\Models\User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'phone' => '12345',
            'parol' => '12345',
            'password' => Hash::make('12345'),
            'is_permission' => 1
        ]);
    }
}
