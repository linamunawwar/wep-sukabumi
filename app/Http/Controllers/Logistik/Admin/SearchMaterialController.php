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
            $detailPermintaan = LogDetailPenerimaanMaterial::where(['material_id' => $val->id, 'soft_delete' => 0])
                                                    ->orderBy('id', 'desc')
                                                    ->first();
            if ($detailPermintaan) {
                $val->jumlahStok = $detailPermintaan->sisa_stok;
            }else{
                $val->jumlahStok = 0;
            }
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
                                                        ->select('*','log_tr_pengajuan_detail.updated_at as tanggal_keluar', 'users.name as penerimaKeluar')
                                                        ->orderBy('log_tr_pengajuan_detail.id', 'ASC')
                                                        ->get()
                                                        ->toArray();
        
        $detailLaporanMaterial = array_merge($detailLaporanMasuk, $detailLaporanKeluar);

        // dd($detailLaporanMaterial);
        return view('logistik.admin.search_material.detail', ['material' => $detailMaterial, 'details' => $detailLaporanMaterial]);
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
                
        $excel = \Excel::create('Formulir_Laporan_Penggunaan_Material', function ($excel) use ($detailMaterial, $detailLaporanMaterial) {
            $excel->sheet('New Sheet', function ($sheet) use ($detailMaterial, $detailLaporanMaterial) {
                $sheet->loadview('logistik.admin.search_material.newUnduh',
                    [
                        'material' => $detailMaterial,
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
