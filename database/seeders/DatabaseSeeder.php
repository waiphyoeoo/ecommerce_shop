<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'userone',
            "email" => "userone@gmail.com",
            'password' => Hash::make('password')
        ]);
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);
        $category = ['T Shirt', 'Hat', 'Electronic', 'Mobile', 'Earphone'];
        foreach ($category as $c) {
            Category::create([
                'slug' => Str::slug($c),
                'name' => $c,
                'mm_name' => 'မြန်မာ'
            ]);
        }
        $brand = ['Samsung', 'Huawei', "Apple"];
        foreach ($brand as $b) {
            Brand::create([
                'slug' => Str::slug($b),
                'name' => $b
            ]);
        }
        $color = ['red', 'green', 'blue', 'black'];
        foreach ($color as $c) {
            Color::create([
                'slug' => Str::slug($c),
                'name' => $c
            ]);
        }
        Supplier::create([
            'name' => 'mg mg',
            'image' => 'supplier.png',
            'description' => 'some'
        ]);
    }
}
