
@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ganti Password</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="demo-form2" class="form-horizontal form-label-left" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Password Lama<span class="required">*</span>:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="pass_lama" name="pass_lama" required="required" class="nama form-control col-md-7 col-xs-12" placeholder="Password Lama">
                                    <p style="color: red;display: none;" class="cocok_lama">Password Lama Tidak Cocok</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Password Baru<span class="required">*</span>:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="pass_baru" name="pass_baru" required="required" class="pass_baru form-control col-md-7 col-xs-12" placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nama">Konfirmasi Password<span class="required">*</span>:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="pass_konfirm" name="pass_konfirm" required="required" class="pass_konfirm form-control col-md-7 col-xs-12" placeholder="Ulangi Password Baru">
                                    <p style="color: red;display: none;" class="tidak_cocok">Password Tidak Cocok</p>
                                </div>
                            </div>

                                
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a class="btn btn-primary" type="button" href="{{url('admin/pegawai')}}">Cancel</a>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
<script type="text/javascript">
    var password = document.getElementById("pass_baru")
  , confirm_password = document.getElementById("pass_konfirm"), pass_lama = document.getElementById('pass_lama');

    var password_lama = <?php echo \Auth::user()->pass_asli; ?>;

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
        $('.submit').attr('disabled','disabled');
        $('.tidak_cocok').show();
      } else {
        $('.submit').removeAttr('disabled');
        $('.tidak_cocok').hide();
        confirm_password.setCustomValidity('');
      }
    }

    function validatePasswordLama(){
      if(pass_lama.value != password_lama) {
        console.log('dsf');
        $('.submit').attr('disabled','disabled');
        $('.cocok_lama').show();
      } else {
        $('.submit').removeAttr('disabled');
        $('.cocok_lama').hide();
      }
    }

    pass_lama.onchange = validatePasswordLama;
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    $(document).ready(function(){
      $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
        });
      $('#datepicker2').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
        });
    });

</script>
@endpush