<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            "name" => "admin",
            "guard_name" => "api"
        ]);

        $user = User::create([
                "first_name" => "Super Admin",
                "last_name" => "Super Admin",
                "email" => "hello@pioneersplus.com",
                "username" => "superadmin",
                "password" => "superadmin"
        ]);
        
        $user->createToken('token')->accessToken;    
        $user->assignRole('admin');


    }
}
