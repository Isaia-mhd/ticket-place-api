<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = User::where('email', config('app.super_admin.email'))->first();
        if(!$super_admin)
        {
            User::create([
                'name' => config('app.super_admin.name'),
                'email' => config('app.super_admin.email'),
                'phone' => config('app.super_admin.phone'),
                'password' => config('app.super_admin.password'),
                'role' => 'super_admin'
            ]);
        }
    }
}
