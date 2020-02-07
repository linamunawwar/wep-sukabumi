<?php

namespace App\Http\Controllers\Logistik\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogDetailPermintaanMaterial;
use App\Models\LogMaterial;
use App\Models\LogPermintaanMaterial;
use App\Pegawai;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class PermintaanController extends Controller
{
    public function randomKey()
    {
        $panjang = 5;
        $Huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $Angka = "1234567890";
        $kodeHuruf = '';
        $kodeAngka = '';
        $kode = '';

        for ($i = 0; $i < $panjang; $i++) {
            $kodeHuruf .= $Huruf[rand(0, strlen($Huruf) - 1)];
            $kodeAngka .= $Angka[rand(0, strlen($Angka) - 1)];
        }

        $kode = $kodeHuruf . "" . $kodeAngka;
        return $kode;
    }

    public function index()
    {
        $permintaans = LogPermintaanMaterial::where('soft_delete', 0)->get();
        foreach ($permintaans as $permintaan) {
            if ($permintaan->is_som != 1) {
                if ($permintaan->is_som == Null) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Proses Pengecekan";
                } elseif ($permintaan->is_som == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SOM";
                }
            } elseif ($permintaan->is_slem != 1) {
                if ($permintaan->is_slem == Null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Accepted By SOM";
                } elseif ($permintaan->is_slem == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SPLEM";
                }
            } elseif ($permintaan->is_scarm != 1) {
                if ($permintaan->is_scarm == Null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Acepted By SPLEM";
                } elseif ($permintaan->is_scarm == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By SCARM";
                }
            } elseif ($permintaan->is_pm != 1) {
                if ($permintaan->is_pm == Null) {
                    $permintaan->color = "#74B9FF";
                    $permintaan->text = "Accepted By SPLEM";
                } elseif ($permintaan->is_pm == 0) {
                    $permintaan->color = "#D63031";
                    $permintaan->text = "Rejected By PM";
                }
            } elseif ($permintaan->is_pm == 1) {
                $permintaan->color = "#74B9FF";
                $permintaan->text = "Accepted By PM";
            }

            if($permintaan->is_notif == 1) {
                $permintaan->notifColor = "#6C7A89";
                $permintaan->notifStyle = 'margin-left:-22px; color:#F7CA18;';
                $permintaan->notifIcon = "fa fa-star ";
            }else {
                $permintaan->notifColor = "#FF9800";
                $permintaan->notifStyle = "";
                $permintaan->notifIcon = "";
            }
        }

        return view('logistik.admin.permintaan.index', ['permintaans' => $permintaans]);
    }

    public function getNote($id)
    {
        $permintaan = LogPermintaanMaterial::where('id', $id)->where('soft_delete',0)->first();
        $note = '';
        if($permintaan){
            if($permintaan->is_pm === '0') {
                $note = $permintaan->note_pm;
            }elseif($permintaan->is_scarm === '0'){
                $note = $permintaan->note_scarm ;
            }elseif($permintaan->is_slem === '0'){
                $note = $permintaan->note_slem ;
            }elseif($permintaan->is_som === '0'){
                $note = $permintaan->note_som ;
            }
        }
        
        return $note;
      
    }

    public function beforePostPermintaan()
    {

        $materials = LogMaterial::where('soft_delete', 0)->get();
        return view('logistik.admin.permintaan.create', ['materials' => $materials]);
    }

    public function getSatuanMaterial()
    {
        $materialId = \Input::get('material_id');
        $materials = LogMaterial::where('id', $materialId)
                                ->where('soft_delete', 0)
                                ->first();

        return json_encode($materials);
    }

    public function postPermintaan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
        $noPart = \Input::get('no_part');
        $volume = \Input::get('volume');
        $satuan = \Input::get('satuan');
        $keperluan = \Input::get('keperluan');
        $keterangan = \Input::get('keterangan');

        $kodePermintaan = PermintaanController::randomKey();
        $getKodePermintaan = LogPermintaanMaterial::where('kode_permintaan', $kodePermintaan)->get();
        while (empty($getKodePermintaan)) {
            $kodePermintaan = PermintaanController::randomKey();
        }

        $addPermintaan = new LogPermintaanMaterial;
        $addPermintaan->kode_permintaan = $kodePermintaan;
        $addPermintaan->tanggal = date('Y-m-d');
        $addPermintaan->user_id = \Auth::user()->id;
        $addPermintaan->soft_delete = 0;
        $addPermintaan->created_at = date('Y-m-d');

        if ($addPermintaan->save()) {
            $permintaanId = $addPermintaan->id;
            $jmlPermintaan = \Input::get('jumlah_data');
            for ($i = 0; $i < $jmlPermintaan; $i++) {
                $addDetailPemintaanMaterial = new LogDetailPermintaanMaterial;
                $addDetailPemintaanMaterial->permintaan_id = $permintaanId;
                $addDetailPemintaanMaterial->material_id = $materialId[$i];
                $addDetailPemintaanMaterial->no_part = $noPart[$i];
                $addDetailPemintaanMaterial->volume = $volume[$i];
                $addDetailPemintaanMaterial->satuan = $satuan[$i];
                $addDetailPemintaanMaterial->keperluan = $keperluan[$i];
                $addDetailPemintaanMaterial->keterangan = $keterangan[$i];
                $addDetailPemintaanMaterial->user_id = \Auth::user()->id;
                $addDetailPemintaanMaterial->soft_delete = 0;
                $addDetailPemintaanMaterial->created_at = date('Y-m-d');

                if ($addDetailPemintaanMaterial->save()) {
                    $saveStatus = 1;
                } else {
                    $saveStatus = 0;
                    die();
                }
            }
            return redirect('Logistik/admin/permintaan');
        }
    }

    public function getUnduhPermintaan($id)
    {
        $findPermintaan = LogPermintaanMaterial::find($id);
        $getDetailPermintaan = LogDetailPermintaanMaterial::where('permintaan_id', $findPermintaan->id)->where('soft_delete', 0)->get();
        if ($findPermintaan) {
            $som = Pegawai::where('posisi_id', 8)->where('soft_delete', 0)->first();
            $splem = Pegawai::where('posisi_id', 7)->where('soft_delete', 0)->first();
            $scarm = Pegawai::where('posisi_id', 5)->where('soft_delete', 0)->first();
            $pm = Pegawai::where('posisi_id', 1)->where('soft_delete', 0)->first();

            $excel = \Excel::create('Formulir_Permintaan_Material', function ($excel) use ($findPermintaan, $getDetailPermintaan, $som, $splem, $scarm, $pm) {
                $excel->sheet('New Sheet', function ($sheet) use ($findPermintaan, $getDetailPermintaan, $som, $splem, $scarm, $pm) {
                    $sheet->loadview('logistik.admin.permintaan.unduh',
                        ['permintaan' => $findPermintaan,
                            'detailPermintaan' => $getDetailPermintaan,
                            'som' => $som,
                            'splem' => $splem,
                            'scarm' => $scarm,
                            'pm' => $pm]);
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

    public function getDetailByPermintaanId($id)
    {
        $details = LogDetailPermintaanMaterial::where(['permintaan_id' => $id, 'soft_delete' => 0])->get();
        return view('logistik.admin.permintaan.detail', ['details' => $details]);
    }

    

    public function getPermintaanById($id)
    {
        $permintaan = LogPermintaanMaterial::where(['id' => $id, 'soft_delete' => 0])->first();
        $detailPermintaan = LogDetailPermintaanMaterial::where(['permintaan_id' => $permintaan->id, 'soft_delete' => 0])->get();
        $materials = LogMaterial::where('soft_delete', 0)->get();

        return view('logistik.admin.permintaan.edit', ['permintaan' => $permintaan, 'detail' => $detailPermintaan, 'materials' => $materials]);
    }

    public function updatePermintaan($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $materialId = \Input::get('material');
        $noPart = \Input::get('no_part');
        $volume = \Input::get('volume');
        $satuan = \Input::get('satuan');
        $keperluan = \Input::get('keperluan');
        $keterangan = \Input::get('keterangan');
        $cekKoreksi = \Input::get('koreksi');
        
        $toUpdatePermintaan['updated_at'] = date('Y-m-d');
        if (isset($cekKoreksi)) {
            $toUpdatePermintaan['is_admin'] = 1;
            $toUpdatePermintaan['is_admin_at'] = date('Y-m-d H:i:s');
            $toUpdatePermintaan['is_som'] = null;
            $toUpdatePermintaan['is_slem'] = null;
            $toUpdatePermintaan['is_scarm'] = null;
            $toUpdatePermintaan['is_pm'] = null;
        }
        $updatedPermintaan = LogPermintaanMaterial::where('id', $id)->update($toUpdatePermintaan);

        $jmlPermintaan = \Input::get('jumlah_data');
        for ($i = 0; $i < $jmlPermintaan; $i++) {
            $addDetailPemintaanMaterial = new LogDetailPermintaanMaterial;
            $addDetailPemintaanMaterial->permintaan_id = $id;
            $addDetailPemintaanMaterial->material_id = $materialId[$i];
            $addDetailPemintaanMaterial->no_part = $noPart[$i];
            $addDetailPemintaanMaterial->volume = $volume[$i];
            $addDetailPemintaanMaterial->satuan = $satuan[$i];
            $addDetailPemintaanMaterial->keperluan = $keperluan[$i];
            $addDetailPemintaanMaterial->keterangan = $keterangan[$i];
            $addDetailPemintaanMaterial->user_id = \Auth::user()->id;
            $addDetailPemintaanMaterial->soft_delete = 0;
            $addDetailPemintaanMaterial->created_at = date('Y-m-d');

            if ($addDetailPemintaanMaterial->save()) {
                $saveStatus = 1;
            } else {
                $saveStatus = 0;
                die();
            }
        }
        

        return redirect('Logistik/admin/permintaan');
    }

    public function deleteDetailPermintaanMaterial($detail, $permintaan)
    {
        $deleteDetailPermintaan = LogDetailPermintaanMaterial::where('id', $detail)->update(['soft_delete' => 1]);

        return redirect('Logistik/admin/permintaan/edit/' . $permintaan . '');

    }

    public function deletePermintaan()
    {
        $dataDelete = \Input::all();
        $deletePermintaan = LogPermintaanMaterial::where('id', $dataDelete['id_permintaan'])->update(['soft_delete' => 1]);

        if ($deletePermintaan) {
            $deleteAllDetailPermintaan = LogDetailPermintaanMaterial::where('permintaan_id', $dataDelete['id_permintaan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/admin/permintaan');
        }
    }
}
