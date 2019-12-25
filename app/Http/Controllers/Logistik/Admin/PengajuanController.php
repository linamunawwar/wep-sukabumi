<?php

namespace App\Http\Controllers\Logistik\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;
use App\Models\LogPengajuanMaterial;
use App\Pegawai;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = LogPengajuanMaterial::where('soft_delete', 0)->get();
        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->id_admin != 1) {
                if ($pengajuan->id_admin == null) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Proses Pengecekan";
                } elseif ($pengajuan->id_admin == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By Admin";
                }
            } elseif ($pengajuan->is_som != 1) {
                if ($pengajuan->is_som == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Accepted By ADMIN";
                } elseif ($pengajuan->is_som == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SOM";
                }
            } elseif ($pengajuan->id_splem != 1) {
                if ($pengajuan->id_splem == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Acepted By SOM";
                } elseif ($pengajuan->id_splem == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SPLEM";
                }
            } elseif ($pengajuan->id_splem == 1) {
                $pengajuan->color = "#74B9FF";
                $pengajuan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.admin.pengajuan.index', ['pengajuans' => $pengajuans]);
    }

    public function beforeApprovePengajuan($id)
    {
        $findPengajuan = LogPengajuanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($findPengajuan) {
            $getDetailPengajuan = LogDetailPengajuanMaterial::where('pengajuan_id', $findPengajuan->id)->where('soft_delete', 0)->get();
        }

        return view('logistik.admin.pengajuan.approve', ['pengajuan' => $findPengajuan, 'details' => $getDetailPengajuan]);
    }

    public function approvePengajuan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $find = LogPengajuanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        if ($find) {
            $cekApprove = \Input::get('approve');
            $cekReject = \Input::get('reject');
            $jml = \input::get('jumlahData');
            $detailId = \input::get('detailId');
            $penyerahanSatuan = \input::get('penyerahanSatuan');
            $penyerahanJumlah = \input::get('penyerahanJumlah');

            if (\Auth::user()->pegawai->posisi_id == 30) { //splem
                if (isset($cekApprove)) {
                    $dt['is_admin'] = 1;
                    $dt['is_admin_at'] = date('Y-m-d H:i:s');

                } elseif (isset($cekReject)) {
                    $dt['is_admin'] = 0;
                    $dt['is_admin_at'] = date('Y-m-d H:i:s');
                }
                $dt['note_admin'] = \Input::get('note');
                $update = LogPengajuanMaterial::where('id', $id)->update($dt);
                if ($update) {
                    for ($i = 0; $i < $jml; $i++) {
                        $dp['penyerahan_satuan'] = $penyerahanSatuan[$i];
                        $dp['pemyerahan_jumlah'] = $penyerahanJumlah[$i];

                        $updateDetail = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'id' => $detailId[$i]])->update($dp);
                    }
                }
            }
        }
        return redirect('Logistik/admin/pengajuan');
    }

    public function getDetailByPengajuanId($id)
    {
        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'soft_delete' => 0])->get();
        return view('logistik.admin.pengajuan.detail', ['details' => $details]);
    }

    public function getPengajuanById($id)
    {
        $pengajuan = LogPengajuanMaterial::where(['id' => $id, 'soft_delete' => 0])->first();
        $detailPengajuan = LogDetailPengajuanMaterial::where(['pengajuan_id' => $pengajuan->id, 'soft_delete' => 0])->get();
        $jenisPekerjaans = LogJenis::where('soft_delete', 0)->get();
        $lokasiPekerjaans = LogLokasi::where('soft_delete', 0)->get();

        return view('logistik.admin.pengajuan.edit', ['pengajuan' => $pengajuan, 'details' => $detailPengajuan, 'jenisPekerjaans' => $jenisPekerjaans, 'lokasiPekerjaans' => $lokasiPekerjaans]);
    }

    public function updatePengajuan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $jml = \Input::get('jumlah_data');

        $kode_penerimaan = \Input::get('kodePenerimaan');
        $jenis_pekerjaan = \Input::get('jenisPekerjaan');
        $lokasi_pekerjaan = \Input::get('lokasiPekerjaan');
        $volume = \Input::get('volume');
        $no_wbs = \Input::get('no_wbs');

        $detailPengajuanId = \Input::get('detailPengajuanId');
        $element_activity = \Input::get('elementActivity');
        $material = \Input::get('material');
        $permintaan_satuan = \Input::get('permintaanSatuan');
        $permintaan_jumlah = \Input::get('permintaan_jumlah');
        $penyerahan_satuan = \Input::get('penyerahanSatuan');
        $penyerahan_jumlah = \Input::get('pemyerahanJumlah');

        $toUpdatePengajuanMaterial['jenis_pekerjaan_id'] = $jenis_pekerjaan;
        $toUpdatePengajuanMaterial['lokasi_kerja_id'] = $lokasi_pekerjaan;
        $toUpdatePengajuanMaterial['volume'] = $volume;
        $toUpdatePengajuanMaterial['no_wbs'] = $no_wbs;
        $toUpdatePengajuanMaterial['updated_at'] = date('Y-m-d');
        $updatedPengajuanMaterial = LogPengajuanMaterial::where(['id' => $id, 'kode_penerimaan' => $kode_penerimaan])->update($toUpdatePengajuanMaterial);

        for ($i = 0; $i < $jml; $i++) {
            $toUpdateDetailPengajuanMaterial['element_activity'] = $element_activity[$i];
            $toUpdateDetailPengajuanMaterial['material_id'] = $material[$i];
            $toUpdateDetailPengajuanMaterial['permintaan_satuan'] = $permintaan_satuan[$i];
            $toUpdateDetailPengajuanMaterial['permintaan_jumlah'] = $permintaan_jumlah[$i];
            $toUpdateDetailPengajuanMaterial['penyerahan_satuan'] = $penyerahan_satuan[$i];
            $toUpdateDetailPengajuanMaterial['pemyerahan_jumlah'] = $penyerahan_jumlah[$i];

            $updatedDetailPengajuanMaterial = LogDetailPengajuanMaterial::where(['id' => $detailPengajuanId[$i], 'pengajuan_id' => $id])->update($toUpdateDetailPengajuanMaterial);
        }

        return redirect('Logistik/admin/pengajuan');
    }

    public function getUnduhPengajuan($id)
    {
        $findPengajuan = LogPengajuanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        $getDetailPengajuan = LogDetailPengajuanMaterial::where('pengajuan_id', $findPengajuan->id)->where('soft_delete', 0)->get();
        if ($findPengajuan) {
            $som = Pegawai::where('posisi_id', 8)->where('soft_delete', 0)->first();
            $splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();

            $excel = \Excel::create('Formulir_Pengajuan_Material', function ($excel) use ($findPengajuan, $getDetailPengajuan, $som, $splem) {
                $excel->sheet('New Sheet', function ($sheet) use ($findPengajuan, $getDetailPengajuan, $som, $splem) {
                    $sheet->loadview('logistik.admin.pengajuan.unduh',
                        ['pengajuan' => $findPengajuan,
                            'detailPengajuan' => $getDetailPengajuan,
                            'som' => $som,
                            'splem' => $splem]);
                    $objDrawing = new PHPExcel_Worksheet_Drawing;
                    $objDrawing->setPath(public_path('img/Waskita.png'));
                    $objDrawing->setCoordinates('C1');
                    $objDrawing->setWorksheet($sheet);
                    $objDrawing->setResizeProportional(false);

                    // set width later
                    $objDrawing->setWidth(40);
                    $objDrawing->setHeight(35);
                    $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                    $sheet->getStyle('A13:H14')->getAlignment()->setWrapText(true);
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
                    $sheet->cell('D8:E8', function ($cell) {
                        $cell->setBorder('', '', 'thin', '');
                    });
                    $sheet->cell('K2:K3', function ($cell) {
                        $cell->setBorder('', '', '', 'thin');
                    });
                    $sheet->cell('C4', function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                    $sheet->cell('C6', function ($cell) {
                        $cell->setalignment('center');
                        $cell->setValignment('center');
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
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
}