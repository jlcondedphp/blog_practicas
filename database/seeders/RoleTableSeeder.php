<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
        public function run()
        {
            $role = new Role();
            $role->name = 'admin';
            $role->description = 'Administrator';
            $role->save();
            $role2 = new Role();
            $role2->name = 'user';
            $role2->description = 'User';
            $role2->save();

            $user= User::where('email','admin@example.com')->first();
            $user->roles()->sync([$role->id, $role2->id]);
        }
}
