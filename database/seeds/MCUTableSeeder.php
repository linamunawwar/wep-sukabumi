<?php

use Illuminate\Database\Seeder;

class MCUTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        DB::table('mst_mcu')->insert([
        	'id' => 1,
            'pernyataan' => 'Sakit atau kecelakaan dalam 5 tahun terakhir',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 2,
            'pernyataan' => 'Cedera, kelainan atau penyakit pada kepala, kejang-kejang atau epilepsi',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);
        
        DB::table('mst_mcu')->insert([
        	'id' => 3,
            'pernyataan' => 'Kelainan mata atau gangguan penglihatan (kecuali sudah pakai kaca mata',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 4,
            'pernyataan' => 'Kelainan telinga, gangguan pendengaran atau keseimbangan',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 5,
            'pernyataan' => 'Penyakit jantung, serangan jantung, operasi jantung',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 6,
            'pernyataan' => 'Tekanan darah tinggi',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 7,
            'pernyataan' => 'Penyakit otot dan persendian',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 8,
            'pernyataan' => 'Penyakit paru-paru, asma, bronkitis, sesak nafas',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 9,
            'pernyataan' => 'Penyakit ginjal, cuci darah',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 10,
            'pernyataan' => 'Problem saluran pencernaan, penyakit hati (lever/hepatitis)',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 11,
            'pernyataan' => 'Diabetes atau gula darah tinggi',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 12,
            'pernyataan' => 'Gangguan kejiwaan (stess), gangguan tidur (insomnia)',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 13,
            'pernyataan' => 'Kehilangan kesadaran, pingsan, stroke atau lumpuh',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 14,
            'pernyataan' => 'Kehilangan anggota tubuh (jari, tangan, lengan, kaki, paha)',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 15,
            'pernyataan' => 'Cedera atau sakit pada tulang belakang, sakit pinggang menahun',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);

        DB::table('mst_mcu')->insert([
        	'id' => 16,
            'pernyataan' => 'Peminum alkohol, narkoba atau kebiasaan minum obat-obatan',
            'user_id' => '0',
            'role_id' => '0',
            'soft_delete' => '0',
            'created_at' => $date
        ]);
    }
}
