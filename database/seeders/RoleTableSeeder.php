<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User
        $role = new Role();
        $role->name = 'user';
        $role->description = 'Application User';
        $role->created_at = Carbon::now();
        $role->save();

        // Admin
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Application Admin';
        $role->created_at = Carbon::now();
        $role->save();
    }
}
