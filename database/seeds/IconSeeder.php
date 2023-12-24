<?php

use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        DB::table('icons')->insert([
            'id' => 1,
            'icon' => 'fa fa-laptop',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 2,
            'icon' => 'fa fa-list',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 3,
            'icon' => 'fa fa-lock',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 4,
            'icon' => 'fa fa-unlock-alt',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 5,
            'icon' => 'fa fa-users',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 6,
            'icon' => 'fa fa-sign-out',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 7,
            'icon' => 'fa fa-money',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 8,
            'icon' => 'fa fa-credit-card',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 9,
            'icon' => 'fa fa-paper-plane',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 10,
            'icon' => 'fa fa-exchange',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 11,
            'icon' => 'fa fa-envelope',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 12,
            'icon' => 'fa fa-envelope-o',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 13,
            'icon' => 'fa fa-list-alt',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 14,
            'icon' => 'fa fa-gears',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 15,
            'icon' => 'fa fa-folder-open',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 16,
            'icon' => 'fa fa-user',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 17,
            'icon' => 'fa fa-people',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 18,
            'icon' => 'fa fa-trash',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 19,
            'icon' => 'fa fa-chart',
            'created_at' => $date
        ]);
        DB::table('icons')->insert([
            'id' => 20,
            'icon' => 'fa fa-file',
            'created_at' => $date
        ]);
    }
}
