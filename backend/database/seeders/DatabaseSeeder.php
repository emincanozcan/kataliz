<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Emincan Ozcan',
            'email' => 'emincanozcann@gmail.com',
            'password' => bcrypt('password')
        ]);
        $this->call(PardusAppSeeder::class);
        $this->call(NonPardusAppSeeder::class);
        $this->call(AppPackageSeeder::class);
    }
}
