<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/users.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            User::create([
                'id' => $item->id,
                'name' => $item->name,
                'email' => $item->email,
                'phone' => $item->phone,
                'role' => $item->role,
                'password' => bcrypt($item->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
