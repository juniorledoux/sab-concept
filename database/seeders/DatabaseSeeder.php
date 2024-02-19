<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'societe' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret'),
            'is_admin' => true,
            'phone' => 237699887766,
            'about' => "Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).",
        ]);
    }
}
