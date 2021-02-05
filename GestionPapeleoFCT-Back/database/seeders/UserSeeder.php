<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //User::truncate();
        $contra = '12345678';
        
        User::create([
            'dni' => '1A',
            'email' => 'fernando@gmail.com',
            'password' => \Hash::make($contra)
        ]);

        User::create([
            'dni' => '2B',
            'email' => 'inma@gmail.com',
            'password' => \Hash::make($contra)
        ]);

        User::create([
            'dni' => '3C',
            'email' => 'diego@gmail.com',
            'password' => \Hash::make($contra)
        ]);

        User::create([
            'dni' => '4D',
            'email' => 'joseluis@gmail.com',
            'password' => \Hash::make($contra)
        ]);
    }

}
