<?php

namespace App\Http\Controllers\Logistik\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogDetailPenerimaanMaterial;
use App\Models\LogDetailPengajuanMaterial;
use App\Models\LogJenis;
use App\Models\LogLokasi;
use App\Models\LogMaterial;
use App\Models\LogPenerimaanMaterial;
use App\Models\LogPengajuanMaterial;
use App\Pegawai;
use App\Models\User;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_PageSetup;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = LogPengajuanMaterial::where('soft_delete', 0)->orderBy('id')->get();
        foreach ($pengajuans as $pengajuan) {
            if ($pengajuan->is_som != 1) {
                if ($pengajuan->is_som == null) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Proses Pengecekan";
                } elseif ($pengajuan->is_som == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SOM";
                }
            } elseif ($pengajuan->is_splem != 1) {
                if ($pengajuan->is_splem == null) {
                    $pengajuan->color = "#74B9FF";
                    $pengajuan->text = "Acepted By SOM";
                } elseif ($pengajuan->is_splem == 0) {
                    $pengajuan->color = "#D63031";
                    $pengajuan->text = "Rejected By SPLEM";
                }
            } elseif ($pengajuan->is_splem == 1) {
                $pengajuan->color = "#74B9FF";
                $pengajuan->text = "Accepted By SPLEM";
            }
        }
        return view('logistik.admin.pengajuan.index', ['pengajuans' => $pengajuans]);
    }

    public function getNote($id)
    {
        $pengajuan = LogPengajuanMaterial::where('id', $id)->where('soft_delete',0)->first();
        $note = '';
        if($pengajuan){
            if($pengajuan->is_splem === '0') {
                $note = $pengajuan->note_splem;
            }elseif($pengajuan->is_som === '0'){
                $note = $pengajuan->note_som ;
            }elseif($pengajuan->is_admin === '0'){
                $note = $pengajuan->note_admin ;
            }
        }
        
        return $note;
      
    }

    public function beforePostPengajuan()
    {
        $materials = LogMaterial::where('soft_delete', 0)->get();
        $jenisPekerjaans = LogJenis::where('soft_delete', 0)->get();
        $lokasiPekerjaans = LogLokasi::where('soft_delete', 0)->get();

        return view('logistik.admin.pengajuan.create', ['materials' => $materials, 'jenisPekerjaans' => $jenisPekerjaans, 'lokasiPekerjaans' => $lokasiPekerjaans]);
    }

    public function beforePostPengajuanByCode($kode)
    {
        $materials = LogMaterial::where('soft_delete', 0)->get();
        $jenisPekerjaans = LogJenis::where('soft_delete', 0)->get();
        $lokasiPekerjaans = LogLokasi::where('soft_delete', 0)->get();

        return view('logistik.admin.pengajuan.create', ['materials' => $materials, 'jenisPekerjaans' => $jenisPekerjaans, 'lokasiPekerjaans' => $lokasiPekerjaans,'kode_penerimaan'=>$kode]);
    }

    public function cekData()
    {        
        $kode_penerimaan = \Input::get('kode_penerimaan');
        $penerimaan = LogPenerimaanMaterial::where(['kode_penerimaan' => $kode_penerimaan, 'soft_delete' => 0])->first();
        $penerimaans = LogPenerimaanMaterial::where(['kode_penerimaan' => $kode_penerimaan, 'soft_delete' => 0,'is_splem'=>1])->get();
        
        if ($penerimaan  && $penerimaan->is_splem == 1) {
                $datas = LogDetailPenerimaanMaterial::where('penerimaan_id', $penerimaan->id)->where('soft_delete', 0)->get();
        } elseif($penerimaan && $penerimaan->is_splem != 1){
            $datas = 0;
        }else{
            $datas = null;
        }

        if ($datas) {
            foreach ($datas as $key => $data) {
                $stocks = LogDetailPenerimaanMaterial::where('material_id', $data->material_id)
                                            ->whereHas('penerimaan',function ($q) use($penerimaan){
                                              $q->where('kode_permintaan', $penerimaan->kode_permintaan);
                                            })
                                            ->where('soft_delete',0)
                                            ->get();
                $data->material_nama = $data->material->nama;
                $data->material_satuan = $data->material->satuan;
                if ($penerimaans) {
                    foreach ($penerimaans as $key => $penerimaan) {
                        $material = LogDetailPenerimaanMaterial::where('penerimaan_id', $penerimaan->id)->where('material_id', $data->material_id)->where('soft_delete', 0)->first();
                    }
                }
            }
        }
        // dd($kode_penerimaan);
        return json_encode($datas);
    }
    
    public function pengajuanValidasi()
    {
        $data = \Input::all();
        $penerimaan = LogPenerimaanMaterial::where(['kode_penerimaan' => $data['kode_penerimaan'], 'soft_delete' => 0])->first();
        $stocks = LogDetailPenerimaanMaterial::where('material_id', $data['material_id'])
                                            ->whereHas('penerimaan',function ($q) use($penerimaan){
                                              $q->where('kode_permintaan', $penerimaan->kode_permintaan);
                                            })
                                            ->where('soft_delete',0)
                                            ->get();
        $sisa_stok = 0;
        foreach ($stocks as $key => $stock) {
            $sisa_stok = $sisa_stok + $stock->vol_saat_ini;
        }
        
        return $sisa_stok;
    }

    public function postPengajuan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $jml = \Input::get('jumlah_data');

        $kode_penerimaan = \Input::get('kodePenerimaan');
        $jenis_pekerjaan = \Input::get('jenisPekerjaan');
        $lokasi_pekerjaan = \Input::get('lokasiPekerjaan');
        $volume = \Input::get('volume');
        $no_wbs = \Input::get('no_wbs');

        $tanggal_pengajuan = \Input::get('tanggal_pengajuan');
        $element_activity = \Input::get('element_activity');
        $material = \Input::get('material');
        $permintaan_satuan = \Input::get('permintaan_satuan');
        $permintaan_jumlah = \Input::get('permintaan_jumlah');

        $get_penerimaan = LogPenerimaanMaterial::where('kode_penerimaan',$kode_penerimaan)->where('soft_delete',0)->first();

        $addPengajuan = new LogPengajuanMaterial;
        $addPengajuan->kode_penerimaan = $kode_penerimaan;
        $addPengajuan->tanggal = date('Y-m-d');
        $addPengajuan->jenis_pekerjaan_id = $jenis_pekerjaan;
        $addPengajuan->lokasi_kerja_id = $lokasi_pekerjaan;
        $addPengajuan->volume = $volume;
        $addPengajuan->no_wbs = $no_wbs;
        $addPengajuan->user_id = \Auth::user()->id;
        $addPengajuan->created_at = date('Y-m-d');
        
        if (\Auth::user()->role_id == 6) { 
                $addPengajuan->is_admin = 1;
                $addPengajuan->is_admin_at = date('Y-m-d H:i:s');
        }

        if ($addPengajuan->save()) {
            $pengajuanId = $addPengajuan->id;
            for ($i = 0; $i < $jml; $i++) {
                $addDetailPengajuanMaterial = new LogDetailPengajuanMaterial;
                $addDetailPengajuanMaterial->pengajuan_id = $pengajuanId;
                $addDetailPengajuanMaterial->tanggal_pengajuan = $tanggal_pengajuan[$i];
                $addDetailPengajuanMaterial->element_activity = $element_activity[$i];
                $addDetailPengajuanMaterial->material_id = $material[$i];
                $addDetailPengajuanMaterial->permintaan_satuan = $permintaan_satuan[$i];
                $addDetailPengajuanMaterial->permintaan_jumlah = $permintaan_jumlah[$i];
                $addDetailPengajuanMaterial->user_id = \Auth::user()->id;
                $addDetailPengajuanMaterial->created_at = date('Y-m-d');

                $addDetailPengajuanMaterial->save();

                $data_penerimaan = LogDetailPenerimaanMaterial::where('penerimaan_id',$get_penerimaan->id)->where('material_id',$material[$i])->first();
                if($data_penerimaan){
                    $sisa =  (int)$data_penerimaan->sisa_stok - (int)$permintaan_jumlah[$i];
                    $update_sisa = LogDetailPenerimaanMaterial::where('penerimaan_id',$get_penerimaan->id)->where('material_id',$material[$i])->update(['sisa_stok'=>$sisa]);
                }

            }
        }
        return redirect('Logistik/admin/pengajuan');
    }

    public function getDetailByPengajuanId($id)
    {
        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $id, 'soft_delete' => 0])->get();
        session(['proses'=>1]);
        return view('logistik.admin.pengajuan.detail', ['details' => $details]);
    }

    public function getDetailNotifByPengajuanId($id)
    {
        $notifPengajuan = LogPengajuanMaterial::where(['id' => $id, 'soft_delete' => 0])->first();

        $toUpdateNotificationPengajuan['updated_at'] = date('Y-m-d');
        $toUpdateNotificationPengajuan['is_notif'] = -1;
        $updatedPengajuan = LogPengajuanMaterial::where('id', $notifPengajuan->id)->update($toUpdateNotificationPengajuan);

        
        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $notifPengajuan->id, 'soft_delete' => 0])->get();
        
        
        return view('logistik.admin.pengajuan.detail', ['details' => $details, 'notifPengajuan' => $notifPengajuan]);
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

        $get_penerimaan = LogPenerimaanMaterial::where('kode_penerimaan',$kode_penerimaan)->where('soft_delete',0)->first();

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

            $data_penerimaan = LogDetailPenerimaanMaterial::where('penerimaan_id',$get_penerimaan->id)->where('material_id',$material[$i])->first();
                if($data_penerimaan){
                    $sisa =  (int)$data_penerimaan->sisa_stok - (int)$permintaan_jumlah[$i];
                    $update_sisa = LogDetailPenerimaanMaterial::where('penerimaan_id',$get_penerimaan->id)->where('material_id',$material[$i])->update(['sisa_stok'=>$sisa]);
                }
        }

        return redirect('Logistik/admin/pengajuan');
    }

    public function getUnduhPengajuan($id)
    {
        $findPengajuan = LogPengajuanMaterial::where('id', $id)->where('soft_delete', 0)->first();
        $getDetailPengajuan = LogDetailPengajuanMaterial::where('pengajuan_id', $findPengajuan->id)->where('soft_delete', 0)->get();
        if ($findPengajuan) {
            $user = User::where('id',$findPengajuan->user_id)->first();
            $som = getManager('SO','Models\\LogPengajuanMaterial',$findPengajuan->id);
            $splem = getManager('SL','Models\\LogPengajuanMaterial',$findPengajuan->id);


            if(($user->role_id == 6) && ($user->pegawai_id == 'SL10001')){
                $superintendent = Pegawai::where('nip','SL311297')->first();
            }elseif(($user->role_id == 6) && ($user->pegawai_id == 'SL10002')){
                $superintendent = Pegawai::where('nip','SL240587')->first();
            }else{
                $superintendent = Pegawai::where('nip',$user->pegawai_id)->first();
            }
            $excel = \Excel::create('Formulir_Pengajuan_Material', function ($excel) use ($findPengajuan, $getDetailPengajuan, $som, $splem, $superintendent,$user) {
                $excel->sheet('New Sheet', function ($sheet) use ($findPengajuan, $getDetailPengajuan, $som, $splem, $superintendent,$user) {
                    $sheet->loadview('logistik.admin.pengajuan.unduh',
                        ['pengajuan' => $findPengajuan,
                            'detailPengajuan' => $getDetailPengajuan,
                            'som' => $som,
                            'splem' => $splem,
                            'user' => $user,
                            'superintendent' => $superintendent]);
                    $objDrawing = new PHPExcel_Worksheet_Drawing;
                    $objDrawing->setPath(public_path('img/Waskita.png'));
                    $objDrawing->setCoordinates('C4');
                    $objDrawing->setWorksheet($sheet);
                    $objDrawing->setResizeProportional(false);

                    // set width later
                    $objDrawing->setWidth(40);
                    $objDrawing->setHeight(35);
                    $sheet->getStyle('C1')->getAlignment()->setIndent(1);
                    $sheet->getStyle('A13:I50')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('A2:I50')->getFont()->setName('Arial');
                    $sheet->getStyle('A13:I15')->getAlignment()->applyFromArray(
                        array('horizontal' => 'center')
                    );
                    $sheet->cells('A14:I16', function ($cells) {
                        $cells->setValignment('center');
                    });

                    $sheet->cell('D9:E11', function ($cell) {
                        $cell->setValignment('center');
                    });
                    
                    $sheet->cell('C7', function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                    $sheet->cell('C9', function ($cell) {
                        $cell->setBorder('thin', 'thin', 'thin', 'thin');
                    });

                    //set image ttd pelaksana
                    // init drawing
                    if(file_exists("upload/pegawai/$superintendent->nip/$superintendent->ttd")){
                        $drawing = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing->setPath("upload/pegawai/$superintendent->nip/$superintendent->ttd");
                        $drawing->setWorksheet($sheet);
                        $drawing->setCoordinates('D43');
                        $drawing->setResizeProportional(false);
                        $drawing->setWidth(150);
                        $drawing->setHeight(90);
                    }

                    //set image ttd som
                    // init drawing
                    if(file_exists("upload/pegawai/$som->nip/$som->ttd")){
                        $drawing2 = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing2->setPath("upload/pegawai/$som->nip/$som->ttd");
                        $drawing2->setWorksheet($sheet);
                        $drawing2->setCoordinates('E43');
                        $drawing2->setResizeProportional(false);
                        $drawing2->setWidth(150);
                        $drawing2->setHeight(90);
                    }


                    //set image ttd splem
                    // init drawing
                    if(file_exists("upload/pegawai/$splem->nip/$splem->ttd")){
                        $drawing3 = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing3->setPath("upload/pegawai/$splem->nip/$splem->ttd");
                        $drawing3->setWorksheet($sheet);
                        $drawing3->setCoordinates('F43');
                        $drawing3->setResizeProportional(false);
                        $drawing3->setWidth(150);
                        $drawing3->setHeight(90);
                    }

                    //set image ttd pelaksana
                    // init drawing
                    if(file_exists("upload/pegawai/$superintendent->nip/$superintendent->ttd")){
                        $drawing4 = new PHPExcel_Worksheet_Drawing();
                        // Set image
                        $drawing4->setPath("upload/pegawai/$superintendent->nip/$superintendent->ttd");
                        $drawing4->setWorksheet($sheet);
                        $drawing4->setCoordinates('H43');
                        $drawing4->setResizeProportional(false);
                        $drawing4->setWidth(150);
                        $drawing4->setHeight(90);
                    }

                    $sheet->setHeight(43,70);
                    $sheet->setHeight(44,35);
                    $sheet->setHeight(28,20);

                    $sheet->setWidth(array(
                        'A'     =>  1,
                        'B'     =>  1,
                        'C'     =>  6,
                        'D'     =>  20,
                        'E'     =>  25,
                        'F'     =>  10,
                        'G'     =>  10,
                        'H'     =>  10,
                        'I'     =>  10
                    )); 

                });
            });
            
            $styleArray = array(
                'font' => array(
                    'name' => 'Arial',
                ));
            $excel->getDefaultStyle()
                ->applyFromArray($styleArray);
            return $excel->export('xls');
        }
    }

    public function deletePengajuan()
    {
        $dataDelete = \Input::all();
        $deletePengajuan = LogPengajuanMaterial::where('id', $dataDelete['id_pengajuan'])->update(['soft_delete' => 1]);

        if ($deletePengajuan) {
            $deleteAllDetailPengajuan = LogDetailPengajuanMaterial::where('pengajuan_id', $dataDelete['id_pengajuan'])->update(['soft_delete' => 1]);
            return redirect('Logistik/admin/pengajuan');
        }
    }

    public function getKonfirmasiByPengajuanId($id)
    {
        $konfirmasi = LogPengajuanMaterial::where('soft_delete', 0)
                            ->where('id', $id)
                            ->first();

        $details = LogDetailPengajuanMaterial::where(['pengajuan_id' => $konfirmasi->id, 'soft_delete' => 0])
                            ->get();

        
        $penerimaans = LogPenerimaanMaterial::where('kode_permintaan',$konfirmasi->pengajuanPenerimaanMaterial->kode_permintaan)->get();
        $jumlah = [];
        // foreach ($penerimaans as $penerimaan){
        //     $pengajuan = LogPengajuanMaterial::where('kode_penerimaan',$penerimaan->kode_penerimaan)->first();
            
        //     $pengajuan_details = LogDetailPengajuanMaterial::where('pengajuan_id',$pengajuan['id'])->get();
        //     // dd($pengajuan_details);
        //     foreach($pengajuan_details as $pengajuan_detail){
        //         if(!isset($jumlah[$pengajuan_detail->material_id])){
        //             $jumlah[$pengajuan_detail->material_id] = $pengajuan_detail->pemyerahan_jumlah;
        //         }else{
        //             $jumlah[$pengajuan_detail->material_id] = $jumlah[$pengajuan_detail->material_id] + $pengajuan_detail->pemyerahan_jumlah;
        //         }
        //     }
            
        // }
        // //masukkan jumlah penyerahan ke objek details
        // foreach($details as $detail){
        //     $detail->penyerahan_jumlah = $jumlah[$detail->material_id];
        // }
        
        $catatan = \Input::get('catatan');
        $sesuai = \Input::get('sesuai');
        $belumSesuai = \Input::get('belumSesuai');
                            
        if (isset($sesuai) || isset($belumSesuai)) {            
            if (isset($sesuai)) {
                $konfirm = 1;
            }elseif (isset($belumSesuai)) {
                $konfirm = -1;
            }

            $toUpdatedPenyerahan['catatan_penyerahan'] = $catatan;
            $toUpdatedPenyerahan['status_penyerahan'] = 0;
            $toUpdatedPenyerahan['status_konfirmasi'] = $konfirm;
            $toUpdatedPenyerahan['updated_at'] = date('Y-m-d H:i:s');
            
            $updatedPenyerahan = LogPengajuanMaterial::where('id', $konfirmasi->id)->update($toUpdatedPenyerahan);

            return redirect('Logistik/admin/pengajuan');
        }

        
        return view('logistik.admin.pengajuan.konfirmasi', ['details' => $details, 'penyerahan' => $konfirmasi]);
    }
}
