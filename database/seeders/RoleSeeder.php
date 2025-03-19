<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin','user'];
        foreach ($roles as $role) {
            Role::create(['name'=>$role,'guard_name'=>'web']);
        }

        $user = new User();
        $user->name = 'administrator';
        $user->email = 'admin@localhost.com';
        $user->phone = '087822766000';
        $user->is_active = '1';
        $user->password = bcrypt('12345678');
        $user->save();
        $user->assignRole('admin');
    }
}
