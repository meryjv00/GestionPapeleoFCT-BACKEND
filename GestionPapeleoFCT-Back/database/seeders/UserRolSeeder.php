<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolUsuario;

class UserRolSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        RolUsuario::create([
            'role_id' => 2,
            'user_id' => 1
        ]);
        RolUsuario::create([
            'role_id' => 2,
            'user_id' => 2
        ]);
        RolUsuario::create([
            'role_id' => 3,
            'user_id' => 3
        ]);
        RolUsuario::create([
            'role_id' => 3,
            'user_id' => 4
        ]);
    }

}
