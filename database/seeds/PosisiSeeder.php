<?php

use Illuminate\Database\Seeder;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$date = new DateTime();
        DB::table('mst_posisi')->insert([
        	'id' => 1,
            'kode' => 'PM',
            'posisi' => 'Project Manager',
            'parent' => '0',
            'level' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 2	,
            'kode' => 'QC',
            'posisi' => 'Site Quality Staff Coordinator',
            'parent' => '1',
            'level' => '1',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 3,
            'kode' => 'HS',
            'posisi' => 'HSE',
            'parent' => '1',
            'level' => '1',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 4,
            'kode' => 'SE',
            'posisi' => 'Site Engineering Manager',
            'parent' => '1',
            'level' => '1',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 5,
            'kode' => 'SC',
            'posisi' => 'Site Commercial Manager',
            'parent' => '1',
            'level' => '1',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 6,
            'kode' => 'SA',
            'posisi' => 'Site Administration Manager',
            'parent' => '1',
            'level' => '1',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 7,
            'kode' => 'SL',
            'posisi' => 'Site Logistic & Equipment Manager',
            'parent' => '1',
            'level' => '1',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 8,
            'kode' => 'SO',
            'posisi' => 'Site Operational Manager',
            'parent' => '1',
            'level' => '1',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 9,
            'kode' => 'QC',
            'posisi' => 'Junior Site Quality Staff',
            'parent' => '2',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 10,
            'kode' => 'HS',
            'posisi' => 'HSE Admin',
            'parent' => '3',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 11,
            'kode' => 'HS',
            'posisi' => 'Site HSE Staff',
            'parent' => '10',
            'level' => '3',
            'created_at' => $date
        ]);

        //--------SITE ENGINEERING----

        DB::table('mst_posisi')->insert([
        	'id' => 12,
            'kode' => 'SE',
            'posisi' => 'Highway Engineering',
            'parent' => '4',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 13,
            'kode' => 'SE',
            'posisi' => 'Site Engineering Staff',
            'parent' => '4',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 14,
            'kode' => 'SE',
            'posisi' => 'Drafter',
            'parent' => '4',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 15,
            'kode' => 'SE',
            'posisi' => 'Documentation',
            'parent' => '4',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 16,
            'kode' => 'SE',
            'posisi' => 'Surveyor Coordinator',
            'parent' => '4',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 17,
            'kode' => 'SE',
            'posisi' => 'Admin Surveyor',
            'parent' => '16',
            'level' => '2',
            'created_at' => $date
        ]); 

        DB::table('mst_posisi')->insert([
        	'id' => 18,
            'kode' => 'SE',
            'posisi' => 'Surveyor',
            'parent' => '17',
            'level' => '3',
            'created_at' => $date
        ]);

        //----------SITE COMMERCIAL MANAGER--------
        DB::table('mst_posisi')->insert([
        	'id' => 19,
            'kode' => 'SC',
            'posisi' => 'Site Commercial Staff',
            'parent' => '5',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 20,
            'kode' => 'SC',
            'posisi' => 'Quantity Surveyor',
            'parent' => '19',
            'level' => '3',
            'created_at' => $date
        ]);  

        //-------------SITE Administration--------
        DB::table('mst_posisi')->insert([
        	'id' => 21,
            'kode' => 'SA',
            'posisi' => 'Finance',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 22,
            'kode' => 'SA',
            'posisi' => 'ACC & Tax',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 23,
            'kode' => 'SA',
            'posisi' => 'Human Resource',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 24,
            'kode' => 'SA',
            'posisi' => 'General Affair',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 25,
            'kode' => 'SA',
            'posisi' => 'Secretary',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 26,
            'kode' => 'SA',
            'posisi' => 'Office Boy',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 27,
            'kode' => 'SA',
            'posisi' => 'Security',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 28,
            'kode' => 'SA',
            'posisi' => 'Driver',
            'parent' => '6',
            'level' => '2',
            'created_at' => $date
        ]);	

        //-----------SITE LOGISTIC------------------
        DB::table('mst_posisi')->insert([
        	'id' => 29,
            'kode' => 'SL',
            'posisi' => 'Logistic',
            'parent' => '7',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 30,
            'kode' => 'SL',
            'posisi' => 'Equipment',
            'parent' => '7',
            'level' => '2',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 31,
            'kode' => 'SL',
            'posisi' => 'ERP',
            'parent' => '29',
            'level' => '3',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 32,
            'kode' => 'SL',
            'posisi' => 'Warehouse Staff',
            'parent' => '31',
            'level' => '3',
            'created_at' => $date
        ]);	

        DB::table('mst_posisi')->insert([
        	'id' => 33,
            'kode' => 'SL',
            'posisi' => 'Electric',
            'parent' => '30',
            'level' => '3',
            'created_at' => $date
        ]);	

        //------------SITE OPERATIONAL----------
        DB::table('mst_posisi')->insert([
        	'id' => 34,
            'kode' => 'SO',
            'posisi' => 'Project Controller',
            'parent' => '8',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 35,
            'kode' => 'SO',
            'posisi' => 'Zona 1',
            'parent' => '8',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 36,
            'kode' => 'SO',
            'posisi' => 'Zona 2 & 3',
            'parent' => '8',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 37,
            'kode' => 'SO',
            'posisi' => 'Zona 4 & 5',
            'parent' => '8',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 38,
            'kode' => 'SO',
            'posisi' => 'Drainage',
            'parent' => '8',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 39,
            'kode' => 'SO',
            'posisi' => 'Rigid',
            'parent' => '8',
            'level' => '2',
            'created_at' => $date
        ]);

        DB::table('mst_posisi')->insert([
        	'id' => 40,
            'kode' => 'SO',
            'posisi' => 'Pembesian',
            'parent' => '8',
            'level' => '2',
            'created_at' => $date
        ]);

    }
}
