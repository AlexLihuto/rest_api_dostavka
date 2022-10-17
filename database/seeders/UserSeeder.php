<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)
            ->create()
            ->each(
                function ($user){
                    $user->assignRole('super-admin');
                }
            );

        User::factory(3)
            ->create()
            ->each(
                function ($user){
                    $user->assignRole('buyer');
                }
            );

        User::factory(3)
            ->create()
            ->each(
                function ($user){
                    $user->assignRole('seller');
                }
            );

        User::factory(4)
            ->create()
            ->each(
                function ($user){
                    $user->assignRole('courier');
                }
            );
    }
}
