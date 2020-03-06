@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
    <style type="text/css">
      h3, h4 {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      }
      #data {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 14px;
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
      }

      #data td, #data th {
        border: 1px solid black;
        text-align: center;
      }

      #data tbody .nama{
        width: 15%;
        table-layout: fixed;
        text-align: left;
      }

      #data tr .nomor{
        width: 3%;
        table-layout: fixed;
        text-align: left;
      }

      #data tr .barang{
        text-align: left;
      }

      #data tr:nth-child(even){background-color: #f2f2f2;}
      
      #data th {
        text-align: center;
        background-color: #4CAF50;
        color: white;
      }
    </style>
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Edit Role</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form id="demo-form2" class="form-horizontal form-label-left" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <img src="{{ asset("public/img/kop.png") }}" style="width: 100%; height: 130px;"/>
              <div style="text-align: center;">
                <h4 style="font-family: "Times New Roman";">PERJANJIAN KERJA WAKTU TERTENTU (PKWT)</h4>
                <p style="text-align: center;font-family: "Times New Roman";font-size: 13px;">NOMOR : 
                @if($pkwt)
                  <input type="text" name="no_pkwt" value="{{$pkwt->no_pkwt}}" required="required">
                @else
                  <input type="text" name="no_pkwt" value="" required="required">
                @endif
              </div>
              <?php
                $pm = getPM();
                $tanggal = explode(' ', $pegawai->created_at);
              ?>

              <div style='font-family: "Times New Roman", Times, serif;font-size: 13px;line-height: 1.6;'>
                Pada hari ini tanggal {{date('d-m-Y')}}, kami yang bertandatangan dibawah ini :
                <ol type="1">
                  <li>Pihak Perusahaan 
                    <ul style="list-style-type:none;">
                      <li>Nama Perusahaan   : PT. Waskita Karya (Persero), Tbk. Proyek Pembangunan Jalan Tol Becakayu 2A Ujung</li>
                      <li>Alamat Perusahaan : Jl. Ahmad Yani Ruko Mutiara Bekasi Center Blok A9 nomor 7, Bekasi Utara, Bekasi, Jawa Barat</li>
                    </ul>
                    Dalam hal ini diwakili oleh
                    <ul style="list-style-type:none;">
                      <li>Nama  : Mochamad Waskito Adi, ST</li>
                      <li>Jabatan : Kepala Proyek</li>
                    </ul>
                    Dalam hal ini bertindak untuk dan atas nama PT. Waskita Karya (Persero) Tbk Proyek Pembangunan Jalan Tol Becakayu 2A Ujung, selanjutnya dalam Perjanjian Kerja Waktu Tertentu ini disebut sebagai PIHAK PERTAMA.
                  </li><br><br>
                  <li>Pihak Pekerja
                    <ul style="list-style-type:none;">
                      <li>Nama  : {{$pegawai->nama}}</li>
                      <li>
                        <div>
                          <div style="display: inline-block;">No. KTP : </div>
                          <p style="display: inline-block;padding: 0;margin: 0;">{{$pegawai->no_ktp}}</p>
                        </div>
                      </li><br>
                    </ul>
                    Dalam hal ini bertindak untuk dan atas nama diri sendiri,  selanjutnya dalam Perjanjian Kerja Waktu Tertentu ini disebut sebagai PIHAK KEDUA.<br>
                  </li>
                </ol> 
                Pihak Pertama dan Pihak Kedua secara bersama – sama disebut Para Pihak. Terlebih dahulu menerangkan hal-hal sebagai berikut:<br>
                <ol type="A">
                  <li>  Bahwa Pihak Pertama adalah Proyek Badan Usaha Milik Negara yang memiliki kegiatan usaha utama dalam bidang Industri Jasa Konstruksi.</li>
                  <li>  Bahwa Pihak Pertama dalam melaksanakan kegiatan usahanya tersebut membutuhkan sumber daya manusia yang memiliki kemampuan dan keahlian di bidangnya maisng-masing.</li>
                  <li>  Bahwa Pihak Kedua telah melaksanakan proses seleksi dalam rangka memenuhi kebutuhan sumber daya manusia sebagaimana tersebut pada poin B diatas.</li>
                  <li>  Bahwa Pihak Kedua telah mengikuti seluruh rangkaian proses seleksi yang diadakan oleh Pihak Pertama, dan dinyatakan lulus.</li>

                </ol>
                <br>
                  Berdasarkan hal-hal tersebut diatas, Pihak Pertama dan pihak Kedua sepakat untuk mengikatkan diri satu sama lain dalam perjanjian Kerja Waktu Tertentu, dengan ketentuan sebagaimana dituangkan dalam pasal-pasal di bawah ini :
                <br><br>
                <div style="text-align: center;">
                  Pasal 1<br>
                  PENGERTIAN
                </div>
                <ol type="1">
                  <li>
                    Yang dimaksud Perusahaan dalam perjanjian ini adalah PT. Waskita Karya (Persero) Tbk Proyek Pembangunan Tol Becakayu 2A Ujung.
                  </li>
                  <li>
                    Perjanjian Kerja Waktu Tertentu (yang selanjutnya disebut PKWT) dalam perjanjian ini adalah perjanjian kerja antara Perusahaan dengan Pegawai yang dibuat secara tertulis untuk jangka waktu tertentu.
                  </li>
                </ol>
                <div style="text-align: center;">
                  Pasal 2<br>
                PENEMPATAN DAN LINGKUP PEKERJAAN
                </div>
                <ol type="1">
                  <li>
                    PIHAK PERTAMA akan mempekerjakan PIHAK KEDUA sebagai pekerja PT. Waskita Karya (Persero) Tbk Proyek Jalan Tol Becakayu 2A Ujung, dengan status / kedudukan sebagai pekerja waktu tertentu (tidak tetap) dan ditempatkan sebagai 
                    @if($pkwt)
                      <input type="text" name="posisi" required="required" value="{{$pkwt->posisi}}">
                    @else
                      <input type="text" name="posisi" required="required" value="">
                    @endif
                  </li>
                  <li>
                    PIHAK KEDUA bersedia menerima dan melaksankan tugas pekerjaannya dengan sebaik-baiknya dan penuh rasa tanggungjawab.
                  </li>
                  <li>
                    Penempatan, penugasan, dan ruang lingkup tugas / pekerjaan PIHAK KEDUA oleh PIHAK PERTAMA ditetapkan melalui ketetapan Kepala Proyek, ditentukan dan dilaksanakan sesuai dengan ketetapan Proyek.
                  </li>
                </ol>
                <div style="text-align: center;">
                  Pasal 3<br>
                STATUS PEGAWAI
                </div>
                <ol type="1">
                  <li>
                    PIHAK KEDUA diterima bekerja sebagai pekerja Kontrak / Waktu Tertentu.
                  </li>
                  <li>
                    @if($pkwt)
                      PIHAK PERTAMA menerima PIHAK KEDUA sebagai Pegawai Honorer Proyek dan menandatangani PKWT dalam jangka waktu sampai dengan <input type="text" name="jangka_waktu" required="required" value="{{$pkwt->jangka_waktu}}" placeholder="Jangka Waktu"> , terhitung sejak ditandatangani yaitu tanggal <input type="date" name="tanggal_mulai" required="required" value="{{$pkwt->tanggal_mulai}}"> sampai dengan tanggal <input type="date" name="tanggal_selesai" required="required" value="{{$pkwt->tanggal_selesai}}"> Dengan catatan jika proyek ini sudah selesai sebelum tanggal tersebut pihak kedua tidak bisa menuntut pihak pertama.
                    @else
                      PIHAK PERTAMA menerima PIHAK KEDUA sebagai Pegawai Honorer Proyek dan menandatangani PKWT dalam jangka waktu sampai dengan <input type="text" name="jangka_waktu" required="required" value="}" placeholder="Jangka Waktu"> , terhitung sejak ditandatangani yaitu tanggal <input type="date" name="tanggal_mulai" required="required" value=""> sampai dengan tanggal <input type="date" name="tanggal_selesai" required="required" value=""> Dengan catatan jika proyek ini sudah selesai sebelum tanggal tersebut pihak kedua tidak bisa menuntut pihak pertama.
                    @endif
                  </li>
                </ol>
                <div style="text-align: center;">
                  Pasal 4<br>
                WAKTU KERJA DAN ISTIRAHAT
                </div>
                <ol type="1">
                  <li>
                    PIHAK KEDUA bersedia mengikuti jam kerja yang diatur oleh PT. Waskita Karya (Persero) Tbk Proyek Jalan Tol Becakayu 2A Ujung.
                  </li>
                  <li>
                    Sesuai dengan kebutuhan pelaksanaan pekerjaan di PT. Waskita Karya (Persero) Tbk Proyek Jalan Tol Becakayu 2A Ujung, PIHAK KEDUA bersedia bekerja secara bergiliran (shift) apabila diperlukan.
                  </li>
                </ol>
                <div style="text-align: center;">
                  Pasal 5<br>
                PENGHASILAN DAN FASILITAS
                </div>
                <ol type="1">
                  <li>
                    PIHAK PERTAMA akan membayar penghasilan kepada PIHAK KEDUA pada setiap akhir bulan.
                  </li>
                  <li>
                    Selain dari gaji pada ayat 1 (satu) di atas, PIHAK PERTAMA memberikan bantuan / fasilitas kepada PIHAK KEDUA berupa :
                    <ol type="a">
                      <li>Bantuan uang makan dalam bentuk uang.</li>
                      <li>Bantuan tempat tinggal atau mess bagi karyawan luar kota..</li>
                    </ol>
                  </li>
                  <li>
                    Tunjangan Hari Raya (THR).
                    <ol type="a">
                      <li>Bagi pekerja / pegawai yang telah bekerja selama 12 (dua belas) bulan terus menerus akan mendapat Tunjangan Hari Raya (THR) sebesar 1 (satu) bulan upah;</li>
                      <li>Bagi pekerja / pegawai yang telah bekerja kurang dari 12 (dua belas) bulan akan diberikan Tunjangan Hari Raya (THR) yang besarnya dihitung secara proporsional.</li>
                      <li>Bagi pekerja / pegawai yang bekerja kurang dari 3 (tiga) bulan tidak mendapat Tunjangan Hari Raya (THR).</li>
                    </ol>
                  </li>
                  <li>Segala pajak yang timbul ditanggung oleh pekerja yang bersangkutan kecuali Pajak Penghasilan (PPh Pasal 21) atas gaji.</li>
                </ol><br><br><br><br><br>
                <div style="text-align: center;">
                  Pasal 6<br>
                LEMBUR
                </div>
                <ol type="1">
                  <li>
                    Lembur adalah waktu kerja yng melebihi 7 (tujuh) jam sehari dan 40 (empat puluh) jam untuk 6 (enam) hari kerja dalam 1 (satu) minggu atau 8 (delapan) jam sehari dan 40 (empat puluh) jam 1 (satu) minggu untuk 5 (lima) hari kerja (KEPMENAKER No. : KEP.102/IV/2004.
                  </li>
                  <li>
                    Upah atas kerja lembur PIHAK KEDUA sudah termasuk di dalam gaji bulanan jadi pembayaran lembur tidak dibayarkan oleh PIHAK PERTAMA.
                  </li>
                </ol>
                <div style="text-align: center;">
                  Pasal 7<br>
                KEWAJIBAN PIHAK PERTAMA
                </div>
                <ol type="1">
                  <li>
                    PIHAK PERTAMA wajib untuk melaksanakan hak-hak PIHAK KEDUA sebagaimana diatur dalam Pasal 4 dan 5 Kesepakatan Kerja ini.
                  </li>
                  <li>User / Perusahaan pengguna jasa PIHAK KEDUA menyediakan alat-alat kerja yang diperlukan untuk menunjang pekerjaan yang dilakukan oleh PIHAK KEDUA secara wajar.</li>
                </ol>
                <div style="text-align: center;">
                  Pasal 8<br>
                KEWAJIBAN PIHAK KEDUA
                </div>
                <ol type="1">
                  <li>PIHAK KEDUA wajib melaksanakan tugas dengan penuh tanggungjawab dan sebaik-baiknya sesuai dengan petunjuk PIHAK PERTAMA dan atau perintah atasannya.</li>
                  <li>PIHAK KEDUA wajib untuk mentaati dan melaksanakan semua peraturan dan tata tertib PIHAK PERTAMA maupun yang berlaku di lokasi kerja PT. Waskita Karya (Persero) Tbk Proyek Jalan Tol Becakayu 2A Ujung.</li>
                  <li>.PIHAK KEDUA wajib mengganti kerugian yang diderita oleh PIHAK PERTAMA ataupun PT. Waskita Karya (Persero) Tbk, atas kehilangan dan / atau kerusakan barang ataupun asset yang terbukti dilakukan dan diakibatkan oleh kelalaian PIHAK KEDUA.</li>
                  <li>PIHAK KEDUA tidak diperkenankan bekerja pada Perusahaan lain dengan cara atau maksud apapun tanpa seijint tertulis dari PIHAK PERTAMA selama jangka waktu pelaksanaan perjanjian ini.</li>
                  <li>PIHAK KEDUA tidak menuntut fasilitas / hak / kesejahteraan lain selain yang telah ditentukan / ditetapkan oleh PIHAK PERTAMA dan / atau PT. Waskita Karya (Persero) Tbk.</li>
                </ol>

                <div style="text-align: center;">
                  Pasal 9<br>
                PENILAIAN PELAKSANAAN TUGAS DANPEMBINAAN PEGAWAI
                <br><br>
                  PIHAK PERTAMA akan melakukan penilaian pelaksanaan tugas PIHAK KEDUA setiap 1 (satu) tahun, sesuai dengan yang ditetapkan perusahaan.
                </div><br><br>
                <div style="text-align: center;">
                  Pasal 10<br>
                TATA TERTIB, DISIPLIN KERJA, DAN SANKSI
                </div>
                <ol type="1">
                  <li>PIHAK KEDUA wajib mengisi daftar hadir (finger print) setiap hari kerja sesuai dengan yang telah ditentukan.</li>
                  <li>PIHAK KEDUA harus sudah berada di lokasi kerja 15 (limabelas) menit sebelum pekerjaan dimulai dan dilarang meninggalkan pekerjaan sebelum waktunya kecuali mendapat izin dari atasannya PIHAK KEDUA.</li>
                  <li>PIHAK KEDUA wajib memelihara kerjasama dan saling menghormati satu sama lain demi terciptanya keharmonisan kerja.</li>
                  <li>PIHAK KEDUA dilarang bersenda-gurau dalam melaksanakan pekerjaan sehingga dapat dihindari sedini mungkin resiko kecelakaan kerja dan / atau kekeliruan dalam melaksanakan pekerjaan.</li>
                  <li>PIHAK KEDUA wajib menggunakan alat-alat keselamatan kerja yang telah disediakan sesuai dengan sifat pekerjaan.</li>
                  <li>PIHAK KEDUA wajib mematuhi perintah atasannya dalam pelaksanaan pekerjaan sehari-hari di kantor / lapangan yang belum diatur secara lengkap dalam kesepakatan ini.</li>
                  <li>Perusahaan akan mengenakan sanksi atas pelanggaran disiplin kerja yang dilakukan oleh PIHAK KEDUA, sesuai dengan ketentuan yang ditetapkan oleh perusahaan dan/ atau PKB.</li>
                </ol>
                <div style="text-align: center;">
                  Pasal 11<br>
                TIDAK MASUK KERJA TANPA UPAH
                </div>
                <ol type="1">
                  <li>
                    Apabila PIHAK KEDUA tidak masuk kerja tanpa alasan yang jelas (mangkir) atau tanpa alasan yang dapat dipertanggung-jawabkan maka upahnya tidak dibayarkan untuk hari-hari tidak bekerja tersebut sesuai dengan azas “Tidak Bekerja Tidak Dibayar” kecuali undang-undang menetapkan lain.
                  </li>
                  <li>
                    PIHAK PERTAMA berhak untuk melakukan pemotongan upah / imbalan PIHAK KEDUA yang ditempatkan di PT. Waskita Karya, apabila PIHAK KEDUA tidak masuk kerja tanpa keterangan yang dapat diterima, kecuali dengan keterangan yang dapat dibuktikan sedang menjalani perawatan inap, atau berobat jalan berdasarkan Surat Keterangan Dokter. Pemotongan yang dilakukan adalah sebesar Rp 100.000,- per hari ketidakhadiran sampai dengan maksimal 25% dari Gaji / Penghasilan.
                  </li>
                </ol>
                <div style="text-align: center;">
                  Pasal 12<br>
                BERAKHIRNYA HUBUNGAN KERJA
                </div>
                <ol type="1">
                  <li>PIHAK PERTAMA mempunyai hak untuk memutuskan Perjanjian Kerja Waktu Tertentu ini apabila kinerja dan hasil kerja PIHAK KEDUA dinilai tidak memenuhi apa yang ditugaskan kepada yang bersangkutan.</li>
                  <li>PWKT ini berakhir  demi hukum, dan hubungan kerja antara PIHAK KEDUA dan PIHAK PERTAMA putus dengan sendirinya, apabila jangka waktu tersebut pasal 3 ayat 2 terpenuhi, dan PIHAK KEDUA tidak berhak menuntut sesuai dengan PKB yang berlaku.</li>
                </ol>
                <div style="text-align: center;">
                  Pasal 13<br>
                PENGUNDURAN DIRI<br><br>
                PIHAK KEDUA wajib menyampaikan pemberitahuan secara tertulis perihal pengunduran diri kepada PIHAK PERTAMA paling lambat 30 (tigapuluh) hari sebelum pengunduran diri.<br><br>
                </div>

                <div style="text-align: center;">
                  Pasal 14<br>
                PENYELESAIAN KELUH KESAH<br><br>
                Apabila dalam melaksanakan tugas PIHAK KEDUA merasa tidak puas atas perlakuan dari pihak proyek dan setelah menyampaikan keluh kesah tersebut secara lisan kepada Atasannya, menurut PIHAK KEDUA dapat mengajukan keluh kesah secara tertulis kepada Atasannya yang lebih tinggi dari Atasannya itu.<br><br>
                </div>
                <div style="text-align: center;">
                  Pasal 15<br>
                PEMAHAMAN ISI DAN JANJI LAIN DILUAR PKWT
                </div>
                <ol type="1">
                  <li>Bahwa setelah membaca, mengerti dan memahami seluruh isi dan maksud yang terkandung dalam passal - pasal PKWT ini, maka PIHAK KEDUA setuju dan sepakat untuk mengikat kan diri dengan menandatangani PKWT ini.</li>
                  <li>Perusahaan dan PIHAK KEDUA menyatakan bahwa tidak ada janji-janji lainnya selain kesepakatan yang tertulis dalam pasal-pasal PKWT ini, kecuali surat-surat edaran dan kebijakan-kebijakan yang telah disepakati bersama oleh kedua belah pihak selama bertugas di proyek Pembangunan Jalan Tol Becakayu 2A Ujung.</li>
                </ol><br>
              <br>
              <br>
              <br>
                <div style="text-align: center;">
                  <br>Pasal 16<br>
                PENYELESAIAN PERSELISIHAN<br><br>
                Apabila terjadi perselisihan pendapa tmengena pelaksanaan PKWT ini, akan diselesaikan secara musyawarah antara Perusahaan dan PIHAK KEDUA, apabila perselisihan tersebut tidak terselesaikan antara kedua pihak, akan diselesaikan secara Bipartitantara Perusahaan dengan Serikat Pekerja Waskita, dan / atau secara Tripatit dengan pejabat perantara dari Departemen Tenaga Kerja RI.<br><br>
                </div>

                <div style="text-align: center;">
                  Pasal 17<br>
                LAIN-LAIN
                </div>
                <ol type="1">
                  <li>Hal-hal lain yang belum diatur dalam Perjanjian ini akan diatur kemudian apabila dianggap perlu untuk melakukan perubahan akan terlebih dahulu dibicarakan antara PIHAK PERTAMA dan PIHAK KEDUA secara musyawarah.</li>
                  <li>Apabila dikemudian hari ditemukan kekeliruan pada Perjanjian Kerja ini, maka akan diperbaiki sebagaimana mestinya.</li>
                </ol>

                <div style="text-align: center;">
                  Pasal 18<br>
                PENUTUP
                </div>
                <ol type="1">
                  <li>Perjanjian Kerja Waktu Tertentu ini dibuat dan ditandatangani bersama dan telah dipahami oleh kedua belah pihak serta dengan kesadaran penuh dan tanpa ada unsur paksaan dari pihak manapun untuk dilaksanakan sebagaimana mestinya.</li>
                  <li>PIHAK KEDUA dengan ini menyatakan tidak ada janji-janji, syarat-syarat atau pengertian lain apapun selain apa yang tercantum dalam perjanjian ini.</li>
                  <li>Perjanjian Kerja Waktu Tertentu ini dibuat dalam rangkap 2 (dua) yang masing-masing sama bunyinya, ditandatangani diatas materai Rp 6.000 dan mempunyai kekuatan hukum yang sama 1 (satu) rangkap dipegang oleh PIHAK PERTAMA dan 1 (satu) rangkap dipegang oleh PIHAK KEDUA.</li>
                </ol>
              <br>
                Demikian, Perjanjian Kerja ini dibuat dan ditandatangani pada tanggal yang disebutkan diatas untuk dilaksanakan dan dipatuhi.
              </div>
              <br><br><br>
              <table style="width: 100%; padding-left: 30px;" >
                <tr>
                  <td style="text-align: center;font-size: 13px;">PIHAK PERTAMA</td>
                  <td style="text-align: center;font-size: 13px;">PIHAK KEDUA</td>
                </tr>
                <tr>
                  <td style="text-align: center;">
                    <img src="{{asset('upload/pegawai/'.$pm->nip.'/'.$pm->ttd.'')}}" style="width: 220px; height: 60px; text-align: center;">
                  </td>
                  <td style="text-align: center;">
                    <img src="{{asset('upload/pegawai/'.$pegawai->nip.'/'.$pegawai->ttd.'')}}" style="width: 220px; height: 60px; text-align: center;">
                  </td>
                </tr>
                <tr>
                  <td style="text-align: center;font-size: 13px;"><b>({{$pm->nama}})</b></td>
                  <td style="text-align: center;font-size: 13px;"><b>({{$pegawai->nama}})</b></td>
                </tr>
              </table>
              <br><br>

              <br>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a class="btn btn-danger" type="button" href="{{url('admin/pegawai')}}">Cancel</a>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
