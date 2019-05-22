<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('public/img/Waskita.png')}}" rel='icon' type='image/x-icon'/>
        <title>WEP - Becakayu 2A </title>

        <!-- Bootstrap -->
        <link href="{{ asset("public/css/bootstrap.min.css") }}" rel="stylesheet">
        <!-- <link href="{{ asset("vendor/bower_components/daterangepicker/daterangepicker.css")}}" rel="stylesheet"> -->

        <link href="{{ asset("vendor/bower_components/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css")}}" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="{{ asset("public/css/font-awesome.min.css") }}" rel="stylesheet">

        <link href="{{ asset("vendor/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("vendor/bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("vendor/bower_components/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("vendor/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("vendor/bower_components/datatables.net-scroller-bs/css/scroller.bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("vendor/bower_components/orgchart/css/jquery.orgchart.css") }}" rel="stylesheet">
        <link href="{{ asset("vendor/bower_components/orgchart/css/jquery.orgchart.min.css") }}" rel="stylesheet">
        <link href="{{ asset("vendor/bower_components/select2/dist/css/select2.min.css") }}" rel="stylesheet" />
        <link href="{{ asset("vendor/bower_components/nprogress/nprogress.css") }}" rel="stylesheet" />

        <!-- Custom Theme Style -->
        <link href="{{ asset("public/css/gentelella.min.css") }}" rel="stylesheet">
        <link href="{{ asset("public/css/custom.min.css") }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{!!asset('public/js/datepicker/datepicker3.css')!!}">
        @stack('stylesheets')

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container" style="background: #00004E;">

                @include('includes/sidebar')

                @include('includes/topbar')

                @yield('main_container')

                @include('includes/footer')]

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("public/js/jquery.min.js") }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("public/js/bootstrap.min.js") }}"></script>

        <script src="{{ asset("vendor/bower_components/datatables.net/js/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-buttons/js/buttons.flash.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-buttons/js/buttons.html5.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-buttons/js/buttons.print.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-keytable/js/dataTables.keyTable.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-responsive-bs/js/responsive.bootstrap.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/datatables.net-scroller/js/dataTables.scroller.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/orgchart/js/html2canvas.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/orgchart/js/jspdf.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/orgchart/js/jquery.mockjax.min.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/orgchart/js/jquery.orgchart.js") }}"></script>
        <script src="{{ asset("vendor/bower_components/orgchart/js/jquery.orgchart.min.js") }}"></script>
        <!-- <script src="{{ asset("vendor/bower_components/orgchart/js/jquery.orgchart.min.js.map") }}"></script> -->
        <script src="{{ asset("vendor/bower_components/select2/dist/js/select2.min.js") }}"></script>

        
        <script src="{{ asset("vendor/bower_components/moment/min/moment.min.js")}}"></script>
        <!-- <script src="{{ asset("vendor/bower_components/daterangepicker/daterangepicker.js")}}"></script> -->
        <script type="text/javascript" src="{!!asset('public/js/datepicker/bootstrap-datepicker.js')!!}"></script>
        <script type="text/javascript" src="{!!asset('public/js/datepicker/bootstrap-datetimepicker-3.0.1.min.js')!!}"></script>
        <script src="{{ asset("vendor/bower_components/bootstrap-progressbar/bootstrap-progressbar.min.js")}}"></script>
        <script src="{{ asset("vendor/bower_components/chart.js/dist/Chart.min.js")}}"></script>
        <script src="{{ asset("vendor/bower_components/nprogress/nprogress.js")}}"></script>
        <script src="{{ asset("public/js/jquery.smartWizard.js") }}"></script>
        <!-- Custom Theme Scripts -->
        <!-- <script src="{{ asset("public/js/gentelella.min.js") }}"></script> -->
        <script src="{{ asset("public/js/custom.min.js") }}"></script>
        <script type="text/javascript">
            var laravel_base = <?php echo "'".url('/')."'"; ?>;
        </script>
        
        @stack('scripts')

    </body>
</html>