<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        DB::table('roles')->insert([
        	'id' => 1,
            'name' => 'Admin',
            'description' => 'super admin',
            'created_at' => $date
        ]);

        DB::table('roles')->insert([
        	'id' => 2,
            'name' => 'User',
            'description' => 'user, pegawai',
            'created_at' => $date
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Manager',
            'description' => 'Manager',
            'created_at' => $date
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'Manager SDM',
            'description' => 'Manager SDM',
            'created_at' => $date
        ]);
        DB::table('roles')->insert([
            'id' => 5,
            'name' => 'Project Manager',
            'description' => 'Project Manager',
            'created_at' => $date
        ]);
        DB::table('roles')->insert([
            'id' => 6,
            'name' => 'Admin Logistik',
            'description' => 'Admin Logistik',
            'created_at' => $date
        ]);
    }
}
