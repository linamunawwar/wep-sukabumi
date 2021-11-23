<?php

namespace App\Http\Controllers\Logistik\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\LogMaterial;
use App\Models\LogDetailPengajuanPakai;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogDetailPenerimaanMaterial;

use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class SearchMaterialController extends Controller
{
    public function index()
    {
        $materials = LogMaterial::where('soft_delete', 0)->get();
        foreach ($materials as $key => $val) {
            $detailLaporanMasuk = LogDetailPenerimaanMaterial::
                where(['material_id' => $val->id, 'soft_delete' => 0])
                ->select('penerimaan_id', 'vol_saat_ini')
                ->orderBy('log_tr_penerimaan_detail.id', 'ASC')
                ->get()
                ->toArray();

            $detailLaporanKeluar = LogDetailPengajuanMaterial::
                where(['material_id' =>  $val->id, 'soft_delete' => 0])
                ->select('pengajuan_id', 'pemyerahan_jumlah')
                ->orderBy('log_tr_pengajuan_detail.id', 'ASC')
                ->get()
                ->toArray();

            $detailLaporanMaterial = array_merge($detailLaporanMasuk, $detailLaporanKeluar);

            $stok = 0;

            for ($i=0; $i < count($detailLaporanMaterial); $i++) { 
                if (isset($detailLaporanMaterial[$i]['penerimaan_id'])) {
                    $stok += floatval($detailLaporanMaterial[$i]['vol_saat_ini']);
                }

                if (isset($detailLaporanMaterial[$i]['pengajuan_id'])) {
                    $stok -= floatval($detailLaporanMaterial[$i]['pemyerahan_jumlah']);
                }
            }

            $val->jumlahStok = $stok;
        }
        return view('logistik.admin.search_material.index', ['materials' => $materials]);
    }

    public function getDetailBySearchMaterialId($id)
    {
        $detailMaterial = LogDetailPenerimaanMaterial::where(['material_id' => $id, 'soft_delete' => 0])
                                                    ->select('material_id', 'sisa_stok')
                                                    ->orderBy('id', 'desc')
                                                    ->first();
        
        $detailLaporanMasuk = LogDetailPenerimaanMaterial::
                                                        join('users', 'users.id', '=', 'log_tr_penerimaan_detail.user_id')
                                                        ->where(['material_id' => $id, 'soft_delete' => 0])
                                                        ->select('*','users.name as penerimaMasuk')
                                                        ->orderBy('log_tr_penerimaan_detail.id', 'ASC')
                                                        ->get()
                                                        ->toArray();

        $detailLaporanKeluar = LogDetailPengajuanMaterial::
                                                        join('users', 'users.id', '=', 'log_tr_pengajuan_detail.user_id')
                                                        ->where(['material_id' => $id, 'soft_delete' => 0])
                                                        ->whereNotNull('pemyerahan_jumlah')
                                                        ->select('*','log_tr_pengajuan_detail.updated_at as tanggal_keluar', 'users.name as penerimaKeluar')
                                                        ->orderBy('log_tr_pengajuan_detail.id', 'ASC')
                                                        ->get()
                                                        ->toArray();
        
        $detailLaporanMaterial = array_merge($detailLaporanMasuk, $detailLaporanKeluar);

        $stok = 0;

        for ($i=0; $i < count($detailLaporanMaterial); $i++) { 
            if (isset($detailLaporanMaterial[$i]['penerimaan_id'])) {
                $stok += floatval($detailLaporanMaterial[$i]['vol_saat_ini']);
            }

            if (isset($detailLaporanMaterial[$i]['pengajuan_id'])) {
                $stok -= floatval($detailLaporanMaterial[$i]['pemyerahan_jumlah']);
            }
        }

        return view('logistik.admin.search_material.detail', ['material' => $detailMaterial, 'stok' => $stok, 'details' => $detailLaporanMaterial]);
    }

    public function getUnduhSearchMaterial($id)
    {   
        $detailMaterial = LogDetailPenerimaanMaterial::where(['material_id' => $id, 'soft_delete' => 0])
                                                    ->select('material_id', 'sisa_stok')
                                                    ->orderBy('id', 'desc')
                                                    ->first();
        
        $detailLaporanMasuk = LogDetailPenerimaanMaterial::
                                                        join('users', 'users.id', '=', 'log_tr_penerimaan_detail.user_id')
                                                        ->where(['material_id' => $id, 'soft_delete' => 0])
                                                        ->select('*','users.name as penerimaMasuk')
                                                        ->orderBy('log_tr_penerimaan_detail.id', 'ASC')
                                                        ->get()
                                                        ->toArray();

        $detailLaporanKeluar = LogDetailPengajuanMaterial::
                                                        join('users', 'users.id', '=', 'log_tr_pengajuan_detail.user_id')
                                                        ->where(['material_id' => $id, 'soft_delete' => 0])
                                                        ->select('*','log_tr_pengajuan_detail.updated_at as tanggal_keluar', 'users.name as penerimaKeluar')
                                                        ->orderBy('log_tr_pengajuan_detail.id', 'ASC')
                                                        ->get()
                                                        ->toArray();
        
        $detailLaporanMaterial = array_merge($detailLaporanMasuk, $detailLaporanKeluar);

        $stok = 0;

        for ($i=0; $i < count($detailLaporanMaterial); $i++) { 
            if (isset($detailLaporanMaterial[$i]['penerimaan_id'])) {
                $stok += floatval($detailLaporanMaterial[$i]['vol_saat_ini']);
            }

            if (isset($detailLaporanMaterial[$i]['pengajuan_id'])) {
                $stok -= floatval($detailLaporanMaterial[$i]['pemyerahan_jumlah']);
            }
        }
                
        $excel = \Excel::create('Formulir_Laporan_Penggunaan_Material', function ($excel) use ($detailMaterial, $stok, $detailLaporanMaterial) {
            $excel->sheet('New Sheet', function ($sheet) use ($detailMaterial, $stok, $detailLaporanMaterial) {
                $sheet->loadview('logistik.admin.search_material.newUnduh',
                    [
                        'material' => $detailMaterial,
                        'stok' => $stok,
                        'details' => $detailLaporanMaterial
                    ]);
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('img/Waskita.png'));
                $objDrawing->setCoordinates('C1');
                $objDrawing->setWorksheet($sheet);
                $objDrawing->setResizeProportional(false);

                // set width later
                $objDrawing->setWidth(40);
                $objDrawing->setHeight(55);
                $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                $sheet->getStyle('A13:I30')->getAlignment()->setWrapText(true);
                $sheet->getStyle('A2:H36')->getFont()->setName('Tahoma');
                $sheet->getStyle('A13:H15')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center')
                );
                $sheet->cells('A9:H11', function ($cells) {
                    $cells->setValignment('center');
                    $cells->setFontFamily('Tahoma');
                });

                $sheet->cell('D9:E11', function ($cell) {
                    $cell->setValignment('center');
                });
                $sheet->cell('K2:K3', function ($cell) {
                    $cell->setBorder('', '', '', 'thin');
                });
                
            });
        });
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $styleArray = array(
            'font' => array(
                'name' => 'Tahoma',
            ));
        $excel->getDefaultStyle()
            ->applyFromArray($styleArray);
        return $excel->export('xls');
    }
}
