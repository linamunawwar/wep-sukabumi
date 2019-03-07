<?php

use Illuminate\Database\Seeder;

class KodeBagianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date = new DateTime();
        DB::table('mst_kode_bagian')->insert([
            'id' => 1,
            'kode' => 'PM',
            'description' => 'Project Manager',
            'soft_delete' => 0,
            'created_at' => $date
        ]);
        DB::table('mst_kode_bagian')->insert([
            'id' => 2,
            'kode' => 'SO',
            'description' => 'Site Operational',
            'soft_delete' => 0,
            'created_at' => $date
        ]);
        DB::table('mst_kode_bagian')->insert([
            'id' => 3,
            'kode' => 'SC',
            'description' => 'Site Commercial',
            'soft_delete' => 0,
            'created_at' => $date
        ]);

        DB::table('mst_kode_bagian')->insert([
            'id' => 4,
            'kode' => 'SA',
            'description' => 'Site Administration',
            'soft_delete' => 0,
            'created_at' => $date
        ]);

        DB::table('mst_kode_bagian')->insert([
            'id' => 5,
            'kode' => 'SE',
            'description' => 'Site Engineering',
            'soft_delete' => 0,
            'created_at' => $date
        ]);

        DB::table('mst_kode_bagian')->insert([
            'id' => 6,
            'kode' => 'SL',
            'description' => 'Site Logistic',
            'soft_delete' => 0,
            'created_at' => $date
        ]);

        DB::table('mst_kode_bagian')->insert([
            'id' => 7,
            'kode' => 'HS',
            'description' => 'Health & Safety',
            'soft_delete' => 0,
            'created_at' => $date
        ]);

        DB::table('mst_kode_bagian')->insert([
            'id' => 8,
            'kode' => 'QC',
            'description' => 'Quality Control',
            'soft_delete' => 0,
            'created_at' => $date
        ]);
    }
}
