/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

var CKEDITOR_BASEPATH = '/src/app-assets/vendors/js/ckeditor/';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token.content
        }
    });
}
$(function () {
    jQuery.extend(jQuery.validator.messages, {
        required: "Data wajib diisi.",
        remote: "Silakan perbaiki bagian ini.",
        email: "Harap masukan email yang valid.",
        url: "Harap masukan URL yang valid.",
        date: "Harap masukkan tanggal yang valid.",
        dateISO: "Harap masukkan tanggal (ISO) yang valid.",
        number: "Harap masukkan nomor yang valid.",
        digits: "Harap masukkan hanya digit.",
        creditcard: "Masukkan nomor kartu kredit yang valid.",
        equalTo: "Silakan masukkan nilai yang sama lagi.",
        accept: "Harap masukkan nilai dengan ekstensi yang valid.",
        maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
        minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
        rangelength: jQuery.validator.format("Masukkan nilai antara {0} dan {1} karakter."),
        range: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1}."),
        max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
        min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
    });
});

function form_validation(element, rule) {
    jQuery.validator.addMethod("phone", function (value, element) {
        return this.optional(element) || /^08[0-9]{9,}$/.test(value);
    }, "Masukan nomor telephone yang benar.");

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z," ",.]+$/i.test(value);
    }, "Letters and spaces only");

    jQuery.validator.addMethod("extension", function(value, element, param) {
        param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
        return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
    }, jQuery.validator.format("Mohon masukan ekstensi yang valid."));


    // Limit the size of each individual file in a FileList.
    $.validator.addMethod( "maxsize", function( value, element, param ) {
        if ( this.optional( element ) ) {
            return true;
        }

        if ( $( element ).attr( "type" ) === "file" ) {
            if ( element.files && element.files.length ) {
                for ( var i = 0; i < element.files.length; i++ ) {
                    if ( element.files[ i ].size > param ) {
                        return false;
                    }
                }
            }
        }

        return true;
    }, $.validator.format( "File size must not exceed {0} bytes each." ) );

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    // Accept a value from a file input based on a required mimetype
    jQuery.validator.addMethod( "accept", function( value, element, param ) {

        // Split mime on commas in case we have multiple types we can accept
        var typeParam = typeof param === "string" ? param.replace( /\s/g, "" ) : "image/*",
        optionalValue = this.optional( element ),
        i, file, regex;

        // Element is optional
        if ( optionalValue ) {
            return optionalValue;
        }

        if ( $( element ).attr( "type" ) === "file" ) {

            // Escape string to be used in the regex
            // see: http://stackoverflow.com/questions/3446170/escape-string-for-use-in-javascript-regex
            // Escape also "/*" as "/.*" as a wildcard
            typeParam = typeParam.replace( /[\-\[\]\/\{\}\(\)\+\?\.\\\^\$\|]/g, "\\$&" ).replace( /,/g, "|" ).replace( "\/*", "/.*" );

            // Check if the element has a FileList before checking each file
            if ( element.files && element.files.length ) {
                regex = new RegExp( ".?(" + typeParam + ")$", "i" );
                for ( i = 0; i < element.files.length; i++ ) {
                    file = element.files[ i ];

                    // Grab the mimetype from the loaded file, verify it matches
                    if ( !file.type.match( regex ) ) {
                        return false;
                    }
                }
            }
        }

        // Either return true because we've validated each file, or because the
        // browser does not support element.files and the FileList feature
        return true;
    }, jQuery.validator.format( "Mohon masukan mime type yang valid.." ) );

    $(element).validate({
        errorElement: 'em',
        focusInvalid: true,
        ignore: "",
        rules: rule,
        messages: {
            username:{
                remote: jQuery.validator.format("Username {0} sudah terpakai.")
            },
            old_password:{
                remote: jQuery.validator.format("Password lama salah.")
            },
            cpassword:{
                equalTo: "Konfirmasi password tidak sesuai"
            },
            captcha: {
                required: "Silahkan masukan hasil penjumlahan"
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("help-block");
            element.parents(".form-group").addClass("has-feedback");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent("label"));
            } else if (element.prop("type") === "radio") {
                error.insertAfter($(element).parents(".radio"));
            } else if (hasClass(element[0], "selectpicker")) {
                error.insertAfter($(element).parents(".dropdown"));
            } else if (element.attr('prop') === 'date') {
                error.insertAfter($(element).parents(".input-group"));
            } else {
                error.insertAfter(element);
                $("#spinner").removeClass("fa-spinner fa-spin");
            }
            if (!element.next("span")[0]) {
                // $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
                $("#spinner").removeClass("fa-spinner fa-spin");
            }
        },
        success: function (label, element) {
            // Add the span element, if doesn't exists, and apply the icon classes to it.
            // if ( !$( element ).next( "span" )[ 0 ] ) {
            //     $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
            // }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
            $("#spinner").removeClass("fa-spinner fa-spin" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        },

        submitHandler: function (form, e) {
            e.preventDefault();
            Swal.fire({
                title: 'LOADING...',
                html: 'Mohon tunggu.',
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
                onOpen: () => {
                    $( 'input[data-type="currency"]' ).unmask();
                    $form = $(element);
                    // $form.find('.loading').addClass('loader');
                    var formData = new FormData(form);
                    $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            try {
                                if (response.success) {
                                    Swal.fire({
                                        position: 'center',
                                        type: 'success',
                                        title: "Berhasil",
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    if (response.reload) {
                                        setTimeout(function () {
                                            if (response.trigger) {
                                                sessionStorage.setItem("reloading", response.trigger);
                                                $form.trigger("reset");
                                                location.reload();
                                            }
                                            if (response.url) {
                                                window.location.href = response.url;
                                            } else {
                                                $form.trigger("reset");
                                                location.reload();
                                            }
                                        }, 1500);
                                    }
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Oops...',
                                        text: response.message,
                                    });
                                    if (response.reload) {
                                        setTimeout(function () {
                                            if (response.trigger) {
                                                sessionStorage.setItem("reloading", response.trigger);
                                                $form.trigger("reset");
                                                location.reload();
                                            }
                                            if (response.url) {
                                                window.location.href = response.url;
                                            } else {
                                                $form.trigger("reset");
                                                location.reload();
                                            }
                                        }, 1500);
                                    }
                                }
                                // $form.find('.loading').removeClass('loader');
                            } catch (e) {
                                console.log();
                                // location.reload();
                            }
                        }
                    });
                }
            }).then((result) => {
                
            })
        },
        invalidHandler: function (form) {}
    });



    function hasClass(element, className) {
        return element.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(element.className);
    }

    window.onload = function () {
        var reloading = sessionStorage.getItem("reloading");
        // Check browser support
        if (typeof (Storage) !== "undefined") {
            sessionStorage.removeItem("reloading");
            $('#profile-jobseeker-' + reloading).trigger('click');
        } else {
            console.log("Sorry, your browser does not support Web Storage...");
        }
    }
}

$('#content').on('submit', '.confirm-on-submit', function (e) {
    e.preventDefault();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    });
      
    swalWithBootstrapButtons.fire({
        title: 'Apakah anda yakin?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya!',
        cancelButtonText: 'Tidak!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'LOADING...',
                html: 'Mohon tunggu.',
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
                onOpen: () => {
                    $form = $(this);
                    var formData = new FormData(this);
                    $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if(response.success){
                                Swal.fire(
                                    'Berhasil',
                                    response.massage,
                                    'success'
                                );
                                if (response.reload) {
                                    setTimeout(function () {
                                        if (response.url) {
                                            window.location.href = response.url;
                                        } else {
                                            $form.trigger("reset");
                                            location.reload();
                                        }
                                    }, 1500);
                                }
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                );
                                if (response.reload) {
                                    setTimeout(function () {
                                        if (response.url) {
                                            window.location.href = response.url;
                                        } else {
                                            $form.trigger("reset");
                                            location.reload();
                                        }
                                    }, 1500);
                                }
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            }).then((result) => {
                
            })
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ){
            swalWithBootstrapButtons.fire(
                'Batal',
                'Proses dibatalkan',
                'error'
            )
        }
    });
});

var base_url = $('#url').val();
mainJs = {
    deleteFile: function (rowId,filePath='',controller='delete_file') {
        Swal.fire({
            title: 'Hapus File!',
            text: "Apakah anda yakin?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url +'/ajax/'+controller,
                    type: 'POST',
                    data:{mode:'delete-file',id:rowId,filePath:filePath},
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType : 'json', 
                    success: function(response) {
                        if(response.success){
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                type: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Oke!',
                            }).then((result) => {
                                if (response.url) {
                                    window.location.href = response.url;
                                } else {
                                    location.reload();
                                }
                            });
                            
                            setTimeout(function(){
                                if (response.url) {
                                    window.location.href = response.url;
                                } else {
                                    location.reload();
                                }
                            },3000);    
                        }else{
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error',
                            )
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    },
    optionSelectpicker:function(route,mode='selectpicker',placeholder='Cari berdasarkan nama'){
        var options = {
            ajax: {
                url: base_url+'/ajax/'+route,
                type: "POST",
                dataType: "json",
                data: {
                    mode:mode,
                    q: "{{{q}}}"
                }
            },
            locale: {
                emptyTitle: placeholder,
                searchPlaceholder: placeholder,
                statusSearching:'Sedang mencari...'
            },
            log: 3,
            preprocessData: function (data) {
                var array = [];
                $.each(data,function(i,val){
                    array.push(
                        $.extend(true, i, {
                            text: val.name,
                            value: val.id,
                            data: {
                                subtext: ''
                            }
                        })
                    );
                });
                return array;
            }
        };
        return options;
    },
}

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    viewMode: 'years',
    // startDate: '-3d',
    showOnFocus:true,
    todayHighlight:true,
    todayBtn:true
});

$('.fancybox').fancybox({
    autoSize: true,
    autoWidth : true,
    helpers:  {
        openEffect  : 'elastic',
        title : {
            type : 'fade'
        },
        overlay : {
            css : {
                'background' : 'rgba(0,0,0,0.5)'
            }
        }
    },
});

$( 'input[data-type="currency"]' ).mask('000.000.000.000.000.000', {reverse: true});
$( 'input[data-type="year-mask"]' ).mask('0000',{placeholder:'yyyy'});

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr('data-link')).select();
    document.execCommand("copy");
    $temp.remove();
    Swal.fire(
        'Copied',
        $(element).attr('data-link'),
        'success'
    );
}
  
/*=========================================================================================
    File Name: adminJobfair.js
    Description: Jobfair Admin Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobfairs-page'),
        $form = $('#form-jobfairs'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();   
            
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }
    
            form_validation($form,{
                name : {
                    required : true,
                },
                price : {
                    required : true,
                },
                price_earlybird : {
                    required : true,
                },              
                description : {
                    required : true,
                },
                quota_post : {
                    required : true,
                },
                expired : {
                    required : true,
                },
            }); 

            $page.on('click','.booth-add',function(){
                booth_name   = $('#booth_name').val();
                booth_price   = $('#booth_price').val();
                booth_price_early_bird   = $('#booth_price_early_bird').val();
                booth_count   = $('#booth_count').val();
                booth_count   = parseInt(booth_count) + 1;
                new_data = '<tr id="data_'+booth_count+'">';
                new_data += '<td>'+booth_name;
                new_data += '<input type="hidden" name="booth_name[]" value="'+booth_name+'">';
                new_data += '</td>';
                new_data += '<td>'+booth_price;
                new_data += '<input type="hidden" name="booth_price[]" value="'+booth_price+'">';
                new_data += '</td>';
                new_data += '<td>'+booth_price_early_bird;
                new_data += '<input type="hidden" name="booth_price_early_bird[]" value="'+booth_price_early_bird+'">';
                new_data += '</td>';
                new_data += '<td><button type="button" class="btn-action booth_delete" title="delete" data_id="'+booth_count+'"><i class="fa fa-trash"></i></button></td>';
                new_data += '</tr>';
                $('#booth_table tbody').append(new_data);
                $('#booth_count').val(booth_count);
                $('#booth_name').val('');
                $('#booth_price').val('');
                $('#booth_price_early_bird').val('');
                
            }); 

            $page.on('click','.booth_delete',function(){
                booth_count   = $('#booth_count').val();
                booth_count   = parseInt(booth_count) - 1;
                data_id = $(this).attr('data_id');
                $('#data_'+data_id).remove();
                $('#booth_count').val(booth_count);
            }); 
        },
        initDatatable: function () {
            $table = $page.find('#jobfairs-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/jobfair",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'date', name: 'date' },
                    { data: 'place', name: 'place' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});

/*=========================================================================================
    File Name: adminJobfairBooth.js
    Description: Jobfair Booth Admin Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobfairs-booth-page'),
        $form = $('#form-jobfairs-booth'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();   
            
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }
    
            form_validation($form,{
                name : {
                    required : true,
                },
                price : {
                    required : true,
                },
                price_earlybird : {
                    required : true,
                },
            }); 

        },
        initDatatable: function () {
            $table = $page.find('#jobfairs-booth-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/jobfairBooth",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'price_earlybird', name: 'price_earlybird' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});

/*=========================================================================================
    File Name: adminJobfairBoothNumber.js
    Description: Jobfair Booth Number Admin Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#booth-number-list-page'),
        $form = $('#form-booth-numbers'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();   
            
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }
    
            form_validation($form,{
                name : {
                    required : true,
                },
                price : {
                    required : true,
                },
                price_earlybird : {
                    required : true,
                },              
                description : {
                    required : true,
                },
                quota_post : {
                    required : true,
                },
                expired : {
                    required : true,
                },
            });     
        },
        initDatatable: function () {
            $table = $page.find('#booth-numbers-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/jobfair",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable-booth-number'; 
                        d.jobfair_booth_id = $("#jobfair_booth_id").val();
                    },
                },
                "columns": [
                    { data: 'number', name: 'number' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.status){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});

/*=========================================================================================
    File Name: jobnet.js
    Description: Jobnet Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobnets-page'),
        $form = $('#form-jobnets'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();   
            
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }
    
            form_validation($form,{
                name : {
                    required : true,
                },
                price : {
                    required : true,
                },
                price_earlybird : {
                    required : true,
                },              
                description : {
                    required : true,
                },
                quota_post : {
                    required : true,
                },
                expired : {
                    required : true,
                },
            });     
        },
        initDatatable: function () {
            $table = $page.find('#jobnets-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/jobnet",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'price_earlybird', name: 'price_earlybird' },
                    { data: 'price', name: 'price' },
                    { data: 'expired', name: 'expired' },
                    { data: 'quota_post', name: 'quota_post' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});

/*=========================================================================================
    File Name: events.js
    Description: Events Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobnet-test-page'),
        $form = $('#form-jobnet-test'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }

            form_validation($form,{
                name : {
                    required : true,
                },
                mst_paket_tes_id : {
                    required : true,
                },
                mst_category_id : {
                    required : true,
                },
                price_earlybird : {
                    required : true,
                },
                price : {
                    required : true,
                },
                place : {
                    required : true,
                },
                city_id : {
                    required : true,
                },
                quota_manager : {
                    required : true,
                },
                quota_operator : {
                    required : true,
                },
                quota_supervisor : {
                    required : true,
                },
                quota_staff : {
                    required : true,
                },
                description : {
                    required : true,
                },
                expired : {
                    required : true,
                },
            }); 
        },
        initDatatable: function () {
            $table = $page.find('#jobnet-test-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/lolosTest",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'lokasi', name: 'lokasi' },
                    { data: 'description', name: 'description' },
                    { data: 'quota_manager', name: 'quota_manager' },
                    { data: 'quota_operator', name: 'quota_operator' },
                    { data: 'quota_supervisor', name: 'quota_supervisor' },
                    { data: 'quota_staff', name: 'quota_staff' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});

$(document).ready(function () {
    var $page = $('#company-package-list-company-page'),
        $table = {};
         
    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-package-list-company-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/package",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable-list-company'; 
                        d.package_id = $("#package_id").val();
                        d.search = {
                            keyword: $("#keyword").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'company', name: 'company' },
                    { data: 'package_name', name: 'package_name' },
                    { data: 'booth', name: 'booth' },
                    { data: 'price', name: 'price' },
                    { data: 'payment', name: 'payment' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });
        },
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});

/*=========================================================================================
    File Name: events.js
    Description: Events Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#package-page'),
        $form = $('#form-package'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }

            form_validation($form,{
                name : {
                    required : true,
                },
                mst_paket_tes_id : {
                    required : true,
                },
                mst_category_id : {
                    required : true,
                },
                price_earlybird : {
                    required : true,
                },
                price : {
                    required : true,
                },
                place : {
                    required : true,
                },
                city_id : {
                    required : true,
                },
                quota_manager : {
                    required : true,
                },
                quota_operator : {
                    required : true,
                },
                quota_supervisor : {
                    required : true,
                },
                quota_staff : {
                    required : true,
                },
                description : {
                    required : true,
                },
                expired : {
                    required : true,
                },
            }); 
        },
        initDatatable: function () {
            $table = $page.find('#package-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/package",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'jobnet', name: 'jobnet' },
                    { data: 'lolosTest', name: 'lolosTest' },
                    { data: 'jobfair', name: 'jobfair' },
                    { data: 'price', name: 'price' },
                    { data: 'location', name: 'location' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});

Dropzone.autoDiscover = false;
$(document).ready(function () {
    var $page = $('#package-order-page');
     
    var page = {
        init: function () {
                var id = $('.package_all_id').val();
                console.log(id);
                $.ajax({
                    url : '/admin/ajax/package?mode=get-select-package',
                    type : 'get',
                    data : 'package_all_id='+id,
                    dataType : 'html',
                    beforeSend:function(){
                        $page.find('#package_all_id').selectpicker('destroy');
                    },
                    success:function(html){
                        $page.find('#package_all_id').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Pilih Package',
                            size : 10,
                        });
                        $page.find('#package_all_id').attr('required', 'required');
                    }
                });
                if($('.package_all_id').val() !== undefined) {
                    $.ajax({
                        url : '/admin/ajax/package?mode=get-detail-package',
                        type : 'get',
                        data : 'package_all_id='+id,
                        dataType : 'html',
                        beforeSend:function(){
                            $page.find('#detail_package').show();
                        },
                        success:function(html){
                            $page.find('#detail_package').html(html);
                        }
                    });
                }
                $('#package_all_id').on("change", function(e) {
                    $.ajax({
                        url : '/admin/ajax/package?mode=get-detail-package',
                        type : 'get',
                        data : 'package_all_id='+$(this).val(),
                        dataType : 'html',
                        beforeSend:function(){
                            $page.find('#detail_package').show();
                        },
                        success:function(html){
                            $page.find('#detail_package').html(html);
                        }
                    });
                });
        },
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#applicant-page'),
        $table = {};
    var url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            $page.find('#applicant-datatable_wrapper').attr('style','width:100% !important');
        },
        initDatatable: function () {
            $table = $page.find('#applicant-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: url + "/ajax/applicant",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable-jobseeker'; 
                        d.search = {
                            posisi_pekerjaan: $("#posisi-pekerjaan").val(),
                            perusahaan: $("#perusahaan").val(),
                            lokasi: $("#lokasi").val(),
                            gaji: $("#gaji").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'job', name: 'job' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).data('id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#company-page'),
        $form = $('#form-'+action),
        $table = {};
    var url = $('#url').val(); 

    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: current_url + "/jobs/datatable",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val(),
                            location: $("#location").val()
                        }
                    }
                },
                "columns": [
                    { data: 'nomor', name: 'nomor' },
                    { data: 'company', name: 'company' },
                    { data: 'title', name: 'title' },
                    { data: 'salary', name: 'salary' },
                    { data: 'description', name: 'description' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).data('id');
                datatablePage.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        datatablePage.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        datatablePage.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-applicant-page'),
        $table = {};

    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            advancedSearch = $page.find('#advanced-search');
            advancedSearch.hide();
            $page.find('#btn-advanced-search').on('click', function (e) {
                e.preventDefault();
                if(advancedSearch.is(":visible")){
                    advancedSearch.hide();
                } else {
                    advancedSearch.show();
                }
                    
            })

            $page.find('#university_graduate').selectpicker().ajaxSelectPicker({
                ajax: {
                    url: "/dashboard/ajax/applicant?mode=options-university",
                    type: "POST",
                    dataType: "Json",
                    data: {
                        q: '{{{q}}}'
                    }
                },
                minLength: 3,
                locale: {
                  emptyTitle: "Pilih universitas"
                },

                // function to preprocess JSON data
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];
                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].name,
                                value: data[i].id
                            }));
                        }
                    }
                    return array;
                }

            });

            /** Trigger filter */
            $page.find("#keyword").on('keydown', function (e) {
                if (e.keyCode === 13) {
                    datatablePage.dtTable.draw();
                }
            });
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });
        },
        initDatatable: function () {
            $table = $page.find('#company-applicant-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "pageLength":25,
                "ajax": {
                    url: "/dashboard/ajax/applicant",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) {
                        d.mode = 'datatable';
                        d.search = {
                            keyword: $("#keyword").val(),
                            is_recommend: $("#is_recommend").val(),
                            from_age: $("#from_age").val(),
                            is_candidate: $("#is_candidate").val(),
                            job_id: $("#job_id").val(),
                            to_age: $("#to_age").val(),
                            work_experience: $("#work_experience").val(),
                            min_education: $("#min_education").val(),
                            university_program: $("#university_program").val(),
                            university_graduate: $("#university_graduate").val(),
                            sex: $("#sex").val(),
                            weight: $("#weight").val(),
                            height: $("#height").val(),
                            marital_status: $("#marital_status").val(),
                        }
                    }
                },
                "columns": [{
                        data: 'candidate',
                        name: 'candidate'
                    },
                    {
                        data: 'job',
                        name: 'job'
                    },
                    {
                        data: 'jobseeker_name',
                        name: 'jobseeker_name'
                    },
                    {
                        data: 'jobseeker_age',
                        name: 'jobseeker_age'
                    },
                    {
                        data: 'jobseeker_expected_salary',
                        name: 'jobseeker_expected_salary'
                    },
                    {
                        data: 'jobseeker_last_education',
                        name: 'jobseeker_last_education'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                "columnDefs": [{
                        className: "dt-center",
                        targets: 0
                    },
                    {
                        className: "dt-center",
                        targets: 6
                    },
                    {
                        targets: 'no-sort',
                        orderable: false
                    }
                ],
            });

            $table.on('click', '#trigger-candidate', function (e) {
                e.preventDefault();
                rowId = $(this).data('id');
                is_candidate = $(this).data('value') == 1 ? 0 : 1;
                $.ajax({
                    url: '/dashboard/ajax/applicant?mode=change-candidate&id='+rowId+'&is_candidate='+is_candidate,
                    type: "POST",
                    dataType: 'JSON',
                    success: function(response) {
                        datatablePage.dtTable.draw();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        },
    };

    if ($page.length) {
        datatablePage.init();
    }
});

$(document).ready(function () {
    var $page = $('#company-dashboard-page'),
        $table = {};
         
    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-jobs-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: "/ajax/job",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val(),
                            location: $("#location").val()
                        }
                    }
                },
                "columns": [
                    { data: 'title', name: 'title' },
                    { data: 'salary', name: 'salary' },
                    { data: 'city', name: 'city' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
        },
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#company-jobs-page'),
        $table = {};
         
    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-jobs-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: "/ajax/job?mode=datatable",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val(),
                            location: $("#location").val()
                        }
                    }
                },
                "columns": [
                    { data: 'title', name: 'title' },
                    { data: 'company_name', name: 'company_name' },
                    { data: 'salary', name: 'salary' },
                    { data: 'status', name: 'status' },
                    { data: 'city', name: 'city' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });

            if($page.find('#company_id').length) {
                var column = page.dtTable.column(1);
                column.visible( ! column.visible() );
            }
            
            /** Trigger filter */
            $page.find("#keyword").on('keydown', function (e) {
                if(e.keyCode === 13) {
                    page.dtTable.draw();
                }
            });
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).data('id');
                page.deleteData(rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/job/' + rowId,
                        type: 'DELETE',
                        dataType : 'json',
                        success: function(response) {
                            if(response.status){
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-jobfair-page'),
        $table = {};
         
    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-jobfair-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: "/dashboard/ajax/jobfair?mode=datatable",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'date', name: 'date' },
                    { data: 'location', name: 'location' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });
        },
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});
Dropzone.autoDiscover = false;
$(document).ready(function () {
    var $page = $('#jobfair-booking-page');
     
    var page = {
        init: function () {
            if($('.checked-booth_id').val() !== undefined) {
                $.ajax({
                    url : '/dashboard/ajax/jobfair?mode=get-select-booth-number',
                    type : 'get',
                    data : 'booth_id=' + $('.checked-booth_id').val() + 
                            '&booth_no=' + $('.booth_no').val(),
                    dataType : 'html',
                    beforeSend:function(){
                        $page.find('#booth_no').selectpicker('destroy');
                    },
                    success:function(html){
                        $page.find('#booth_no').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Pilih Booth',
                            size : 5,
                        });
                        $page.find('#booth_no').attr('required', 'required');
                    }
                });
            }

            $page.find(".booth_id").on("click", function(e){
                $.ajax({
                    url : '/dashboard/ajax/jobfair?mode=get-select-booth-number',
                    type : 'get',
                    data : 'booth_id=' +$(this).val(),
                    dataType : 'html',
                    beforeSend:function(){
                        $page.find('#booth_no').selectpicker('destroy');
                    },
                    success:function(html){
                        $page.find('#booth_no').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Pilih Booth',
                            size : 10,
                        });
                        $page.find('#booth_no').attr('required', 'required');
                    }
                });
            });
        },
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-jobfair-list-company-page'),
        $table = {};
         
    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-jobfair-list-company-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: "/dashboard/ajax/jobfair",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable-list-company'; 
                        d.jobfair_id = $("#jobfair_id").val();
                        d.search = {
                            keyword: $("#keyword").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'company', name: 'company' },
                    { data: 'booth', name: 'booth' },
                    { data: 'package', name: 'package' },
                    { data: 'price', name: 'price' },
                    { data: 'payment', name: 'payment' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });
        },
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-jobs-form');

    var page = {
        dtTable: {},
        init: function () {
            $('#min_salary').number(true, 0, ',', '.');
            $('#max_salary').number(true, 0, ',', '.');

            $.ajax({
                url : '/province/get-select/city',
                type : 'get',
                data : { city_id : $('#arr_city').val() },
                dataType : 'html',
                beforeSend:function(){
                    $('#city_id').selectpicker('destroy');
                },
                success:function(html){
                    $('#city_id').html(html).addClass('show-menu-arrow').selectpicker({
                        liveSearch: true,
                        liveSearchPlaceholder : 'Kota/kabupaten ...',
                        size : 10,
                    });
                }
            });
        },
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-jobseeker-page'),
        $table = {};
         
    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            $('#city_id').selectpicker().ajaxSelectPicker({
                ajax: {
                    url: "/dashboard/ajax/jobseeker?mode=options-city",
                    type: "POST",
                    dataType: "Json",
                    data: {
                        q: '{{{q}}}'
                    }
                },
                minLength: 3,
                locale: {
                  emptyTitle: "Pilih Kota"
                },
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];
                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].name,
                                value: data[i].id
                            }));
                        }
                    }
                    return array;
                }
            });
            $('#job_location').selectpicker().ajaxSelectPicker({
                ajax: {
                    url: "/dashboard/ajax/jobseeker?mode=options-city",
                    type: "POST",
                    dataType: "Json",
                    data: {
                        q: '{{{q}}}'
                    }
                },
                minLength: 3,
                locale: {
                  emptyTitle: "Pilih Kota"
                },
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];
                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].name,
                                value: data[i].id
                            }));
                        }
                    }
                    return array;
                }
            });
            
        },
        initDatatable: function () {
            $table = $page.find('#company-jobseeker-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "pageLength":25,
                "ajax": {
                    url: "/dashboard/ajax/jobseeker?mode=datatable",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.type = 'company-jobseeker';
                        d.search = {
                            keyword: $("#keyword").val(),
                            location: $("#location").val(),
                            from_age: $("#from_age").val(),
                            to_age: $("#to_age").val(),
                            sex: $("#sex").val(),
                            min_education: $("#min_education").val(),
                            university_program: $("#university_program").val(),
                            city_id: $("#city_id").val(),
                            job_location: $("#job_location").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'age', name: 'age' },
                    { data: 'last_education', name: 'last_education' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#keyword").on('keydown', function (e) {
                if(e.keyCode === 13) {
                    datatablePage.dtTable.draw();
                }
            });
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });
        },
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-package-page'),
        $table = {};
         
    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-package-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: "/dashboard/ajax/package?mode=datatable",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'jobnet', name: 'jobnet' },
                    { data: 'lolosTest', name: 'lolosTest' },
                    { data: 'jobfair', name: 'jobfair' },
                    { data: 'price', name: 'price' },
                    { data: 'location', name: 'location' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });
        },
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});

Dropzone.autoDiscover = false;
$(document).ready(function () {
    var $page = $('#company-profile-page');
     
    var page = {
        init: function () {
            $("div#company-image").dropzone({ 
                paramName: "file",
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
                maxFiles: 1,      
                thumbnailWidth: 265,
                thumbnailHeight: 320,
                init: function() {      
                    var myDropzone = this;      
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    });
        
                    if($page.find('#image_id').val()) {
                        $.ajax({
                            url: "/dashboard/ajax/profile?mode=get-image&company_id=" +$page.find('input[name="company_id"]').val(),
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if(response.status) {
                                    var mockFile = { name: $page.find('#name').val(), size: response.data.image.size }; 
                                    myDropzone.emit("addedfile", mockFile);
                                    myDropzone.emit("thumbnail", mockFile, response.data.image.url);
                                    myDropzone.emit("complete", mockFile);
                                    myDropzone.files = [mockFile];
                                }
                            }
                        });
                    }
                    
                    this.on("sending", function(file, response) {
                        $page.find('.btn-dashboard[type="submit"]').attr('disabled','disabled');
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                    });                         
                    
                    this.on("success", function(file, response) {
                        $page.find('.btn-dashboard[type="submit"]').removeAttr('disabled');
                        $page.find('#image_id').val(response.id);
                    });             
                    
                    this.on('error', function(file, response) {
                        $page.find('.btn-dashboard[type="submit"]').removeAttr('disabled');
                    });                                                                                                                                                                                                                                                                                                                                                                             
                },
                url: "/dashboard/ajax/profile",
                params: {
                    mode: 'post-image',
                    company_id: $page.find('input[name="company_id"]').val(),
                },
                headers: {
                    'x-csrf-token': token.content,
                },
            });
        
            $(".selectpicker").selectpicker();

            if($("#province_id").val() > 0){
                $.ajax({
                    url : '/province/get-select/city',
                    type : 'get',
                    data : {province_id:$("#province_id").val(),city_id:$('#city_id').val()},
                    dataType : 'html',
                    beforeSend:function(){
                        $('#city_id').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#city_id').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 5,
                        });
                    }
                });
            }

            $("#province_id").on("change",function(e){
                e.preventDefault();
                $.ajax({
                    url : '/province/get-select/city',
                    type : 'get',
                    data : 'province_id=' +$(this).val(),
                    dataType : 'html',
                    beforeSend:function(){
                        $('#city_id').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#city_id').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 10,
                        });
                    }
                });
            });
        },
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-test-online-page'),
        $table = {};
         
    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-test-online-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: "/dashboard/ajax/test-online?mode=datatable",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'date', name: 'date' },
                    { data: 'test_package', name: 'test_package'},
                    { data: 'participant', name: 'participant' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#keyword").on('keydown', function (e) {
                if(e.keyCode === 13) {
                    page.dtTable.draw();
                }
            });
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).data('id');
                page.deleteData(rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/dashboard/ajax/test-online?mode=delete&id=" +rowId,
                        type: 'POST',
                        dataType : 'json',
                        success: function(response) {
                            if(response.status){
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-test-online-detail-page'),
        $table = {};
         
    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#company-test-online-detail-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "order": [],
                "ajax": {
                    url: "/dashboard/ajax/test-online",
                    type: "POST",
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable-detail'; 
                        d.search = {
                            test_online_id: $("#test-online-id").val(),
                            keyword: $("#keyword").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'jobseeker_name', name: 'jobseeker_name' },
                    { data: 'jobseeker_age', name: 'jobseeker_age' },
                    { data: 'job', name: 'job' },
                    { data: 'jobseeker_expected_salary', name: 'jobseeker_expected_salary' },
                    { data: 'jobseeker_last_education', name: 'jobseeker_last_education' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#keyword").on('keydown', function (e) {
                if(e.keyCode === 13) {
                    page.dtTable.draw();
                }
            });
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).data('id');
                page.deleteData(rowId);
            });
            
            $('#applicant_id').selectpicker().ajaxSelectPicker({
                ajax: {
                    url: "/dashboard/ajax/applicant?mode=options",
                    type: "POST",
                    dataType: "Json",
                    data: {
                        q: '{{{q}}}'
                    }
                },
                minLength: 3,
                locale: {
                  emptyTitle: "Pilih Peserta"
                },
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];
                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].jobseeker.name + ' (' + data[i].job.title + ')',
                                value: data[i].id
                            }));
                        }
                    }
                    return array;
                }
            });

            $('#post-detail').on('submit', function (e) {
                e.preventDefault();             
                $.ajax({
                    url: "/dashboard/ajax/test-online?mode=post-detail",
                    type: 'POST',
                    data : $(this).serialize(),
                    success: function(response) {
                        if(response.status){
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                type: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Oke!',
                            }).then((result) => {
                                if (result.value) {
                                    page.dtTable.draw();
                                }
                            });

                            $('#modal-detail').modal('hide');
                            page.dtTable.draw();
                            $("#applicant_id").val('').selectpicker("refresh");
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.message,
                                'error',
                            )
                        }
                    }
                });
            });

        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/dashboard/ajax/test-online?mode=delete-detail&id=" +rowId,
                        type: 'POST',
                        dataType : 'json',
                        success: function(response) {
                            if(response.status){
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var $page = $('#company-test-online-form');

    var page = {
        dtTable: {},
        init: function () {
            
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                showOnFocus: true,
                todayHighlight: true,
                todayBtn: true
            });

            $('.timepicker').timepicker({
                timeFormat: 'H:mm',
                interval: 15,
                minTime: '6',
                maxTime: '23:50pm',
                defaultTime: '08',
                startTime: '06:00',
                endTime: '23:45',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });

            $('#package_all_id').change(function(){
                var id = $(this).val();
                $.ajax({
                    url: "/dashboard/ajax/testOnline?mode=position-options&id="+id,
                    type: "POST",
                    success: function (data) {
                        $('#position').append(data);
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            });
        },
    };
    
    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: events.js
    Description: Events Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#events-page'),
        $form = $('#form-events'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });

            $page.on('click','#delete-file',function(){
                id   = $(this).attr('data-id');
                path = $(this).attr('data-path');
                mainJs.deleteFile(id, path);
            });

            if($("#province_id").val() > 0){
                $.ajax({
                    url : base_url + '/province/get-select/city',
                    type : 'get',
                    data : {province_id:$("#province_id").val(),city_id:$("#city_id").val()},
                    dataType : 'html',
                    beforeSend:function(){
                        $('#city_id').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#city_id').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 5,
                        });
                    }
                });
            }

            $("#province_id").on("change",function(e){
                e.preventDefault();
                $.ajax({
                    url : base_url + '/province/get-select/city',
                    type : 'get',
                    data : 'province_id='+$(this).val(),
                    dataType : 'html',
                    beforeSend:function(){
                        $('#city_id').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#city_id').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 5,
                        });
                    }
                });
            });
        
            form_validation($form,{
                name : {
                    required : true,
                },
                date_start : {
                    required : true,
                },
                date_end : {
                    required : true,
                },
                place : {
                    required : true,
                },
                city_id : {
                    required : true,
                },
                description : {
                    required : true,
                },
                is_popup : {
                    required : true,
                },
                file : {
                    // required : true,
                    extension: "jpg|jpeg|JPEG|JPG|png|PNG",
                    filesize:1048576
                },
            });     
        },
        initDatatable: function () {
            $table = $page.find('#events-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                // "language": {
                //  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                // },
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/events",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'date', name: 'date' },
                    { data: 'place', name: 'place' },
                    { data: 'description', name: 'description' },
                    { data: 'popup', name: 'popup' },
                    { data: 'poster', name: 'poster' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobs-page'),
        $form = $('#form-'+action),
        $table = {};
    var url = $('#url').val(); 

    var datatablePage = {
        dtTable: {},
        init: function () {
            this.initDatatable();
        },
        initDatatable: function () {
            $table = $page.find('#jobs-datatable');
            datatablePage.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: current_url + "/jobs/datatable",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            posisi_pekerjaan: $("#posisi-pekerjaan").val(),
                            perusahaan: $("#perusahaan").val(),
                            lokasi: $("#lokasi").val(),
                            gaji: $("#gaji").val(),
                        }
                    }
                },
                "columns": [
                    { data: 'nomor', name: 'nomor' },
                    { data: 'title', name: 'title' },
                    { data: 'company', name: 'company' },
                    { data: 'salary', name: 'salary' },
                    { data: 'description', name: 'description' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                datatablePage.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).data('id');
                datatablePage.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        datatablePage.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        datatablePage.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    
    if ($page.length) {
        datatablePage.init();
    } 
});
/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-page'),
        $profile = $('#profile'),
        $dashboard = $('#dashboard-jobseeker'),
        $form = $('#form-jobseeker'),
        $formGantiPassword = $('#form-jobseeker-ganti-password'),
        $formAdditionanInfo = $('#form-jobseeker-additional-info'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }

            $page.on('click','#delete-file',function(){
                id   = $(this).attr('data-id');
                path = $(this).attr('data-path');
                mainJs.deleteFile(id, path,'jobseeker');
            });
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });
        
            if($("#province_id").val() > 0){
                $.ajax({
                    url : base_url + '/province/get-select/city',
                    type : 'get',
                    data : {province_id:$("#province_id").val(),city_id:$('#city_id').val()},
                    dataType : 'html',
                    beforeSend:function(){
                        $('#city_id').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#city_id').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 5,
                        });
                    }
                });
            }
            if($("#province").val() > 0){
                $.ajax({
                    url : base_url + '/province/get-select/city',
                    type : 'get',
                    data : {province_id:$("#province").val(),city_id:$("#birth_place").val()},
                    dataType : 'html',
                    beforeSend:function(){
                        $('#birth_place').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#birth_place').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 5,
                        });
                    }
                });
            }
        
            $("#province_id").on("change",function(e){
                e.preventDefault();
                $.ajax({
                    url : base_url + '/province/get-select/city',
                    type : 'get',
                    data : 'province_id='+$(this).val(),
                    dataType : 'html',
                    beforeSend:function(){
                        $('#city_id').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#city_id').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 5,
                        });
                    }
                });
            });
        
            $("#province").on("change",function(e){
                e.preventDefault();
                $.ajax({
                    url : base_url + '/province/get-select/city',
                    type : 'get',
                    data : 'province_id='+$(this).val(),
                    dataType : 'html',
                    beforeSend:function(){
                        $('#birth_place').selectpicker('destroy');
                    },
                    success:function(html){
                        $('#birth_place').html(html).addClass('show-menu-arrow').selectpicker({
                            liveSearch: true,
                            liveSearchPlaceholder : 'Kota/kabupaten ...',
                            size : 5,
                        });
                    }
                });
            });

            form_validation($formGantiPassword,{
                old_password : {
                    required : true,
                    minlength : 6,
                    remote : {
                        url: base_url+"/jobseeker-cek-password-lama",
                        type: 'post',
                        // async: false,
                    }
                },
                password : {
                    minlength : 6,
                    required : true
                },
                conf_password : {
                    required : true,
                    minlength : 6,
                    equalTo : "#password"
                },
            });
            
            switch(action) {
                case 'create':
                    form_validation($form,{
                        kode : {
                            minlength : 5,
                            required : true,
                        },
                        pass_default : {
                            required : true
                        },
                        nama : {
                            required : true
                        },
                        alamat : {
                            required : true
                        },
                        telp : {
                            required : true
                        },
                        fax : {
                            required : true
                        },
                        email : {
                            required : true
                        },
                        cp_nama : {
                            required : true
                        },
                        cp_telp : {
                            required : true
                        },
                    });
                    break;
                case 'update-biodata':
                    form_validation($form,{
                        name : {
                            required : true
                        },
                        email : {
                            required : true
                        },
                        sex : {
                            required : true
                        },
                        birth_place : {
                            required : true
                        },
                        birth_date : {
                            required : true
                        },
                        address : {
                            required : true
                        },
                        city_id : {
                            required : true
                        },
                        phone : {
                            required : true
                        },
                        nik : {
                            maxlength: 16,
                            required : true
                        },
                        marital_status : {
                            required : true
                        },
                        file : {
                            // required : true,
                            extension: "pdf",
                            filesize:1048576
                        },
                    });
                    break;
                case 'additional-info':
                    form_validation($formAdditionanInfo,{
                        expected_salary : {
                            required : true
                        },
                        expected_benefits : {
                            required : true
                        },
                        expected_work_location : {
                            required : true
                        },
                        other_info : {
                            maxlength:110,
                        },
                    });
                    break;
                default:
                // code block
            }
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: current_url + "/datatable",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    }
                },
                "columns": [
                    { data: 'kode', name: 'kode' },
                    { data: 'nama', name: 'nama' },
                    { data: 'kontak', name: 'kontak' },
                    { data: 'cp', name: 'cp' },
                    { data: 'pass_default', name: 'pass_default' },
                    { data: 'aksi', name: 'aksi' }
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).data('id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    }

    $("div#jobseeker-image").dropzone({ 
        clickable:'#profileClickable',
        paramName: "image",
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
        maxFiles: 1,      
        thumbnailWidth: 265,
        thumbnailHeight: 320,
        init: function() {      
            var myDropzone = this;      
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });

            if($profile.find('#image_id').val()) {
                $.ajax({
                    url: base_url+"/ajax/jobseeker?mode=get-image&jobseeker_id=" +$profile.find('input[name="jobseeker_id"]').val(),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if(response.status) {
                            var mockFile = { name: $profile.find('#name').val(), size: response.data.image.size }; 
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit("thumbnail", mockFile, response.data.image.url);
                            myDropzone.emit("complete", mockFile);
                            myDropzone.files = [mockFile];
                        }
                    }
                });
            }
            
            this.on("sending", function(file, response) {
                $profile.find('.btn-dashboard[type="submit"]').attr('disabled','disabled');
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });                         
            
            this.on("success", function(file, response) {
                $profile.find('.btn-dashboard[type="submit"]').removeAttr('disabled');
                $profile.find('#image_id').val(response.id);
            });             
            
            this.on('error', function(file, response) {
                $profile.find('.btn-dashboard[type="submit"]').removeAttr('disabled');
            });                                                                                                                                                                                                                                                                                                                                                                             
        },
        url: base_url+"/ajax/jobseeker",
        params: {
            mode: 'post-image',
            jobseeker_id: $profile.find('input[name="jobseeker_id"]').val(),
        },
        headers: {
            'x-csrf-token': token.content,
        },
    });

    if ($page.length) {
        page.init();
    } 
    if ($dashboard.length) {
        $("a#inline").fancybox({
            'showCloseButton':true,
            'hideOnContentClick': true,
            helpers:  {
                openEffect  : 'elastic',
                title : {
                    type : 'fade'
                },
                overlay : {
                    css : {
                        'background' : 'rgba(0,0,0,0.35)'
                    }
                }
            },
        });
        $(document).on('click',"#copy-link-cv",function(){
            copyToClipboard(this);
        });

        $(document).on('click','#btn-search',function(){
            $('#post-data').html('');
            posisi = $("#posisi-pekerjaan").val();
            perusahaan = $("#perusahaan").val();
            province = $("#province").val();
            gaji_awal = $("#gaji_awal").val();
            gaji_akhir = $("#gaji_akhir").val();
            keyword = '';
            pageJobs.init(keyword,posisi,perusahaan,province,gaji_awal,gaji_akhir);
        });

        $(document).on('click','#icon-search',function(){
            $('#post-data').html('');
            keyword = $("#keyword").val();
            pageJobs.init(keyword);
        });

        var page   = 1;
        var action = 'inactive';
        pageJobs = {
            init: function (search='',posisi='',perusahaan='',province='',gaji_awal='',gaji_akhir='') {
                var page   = 1;
                var action = 'inactive';
                pageJobs.loadMoreData();
                if (action == 'inactive') {
                    pageJobs.lazzy_loader();
                    setTimeout(function () {
                        pageJobs.loadMoreData(page,search,posisi,perusahaan,province,gaji_awal,gaji_akhir);
                    }, 1000);
                }
                
                $("p.next").click(function() {
                    pageJobs.lazzy_loader();
                    setTimeout(function () {
                        pageJobs.loadMoreData(++page,search,posisi,perusahaan,province,gaji_awal,gaji_akhir);
                    }, 1000);
                });
            },
            lazzy_loader : function(){
                var output = '';
                for (var count = 0; count < 10; count++) {
                    output += '<div class="post_data">';
                    output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
                    output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
                    output += '</div>';
                }
                $('#load_data_message').html(output);   
            },
            loadMoreData : function(page, search='',posisi='',perusahaan='',province='',gaji_awal='',gaji_akhir=''){
                $.ajax({
                    url: current_url,
                    type: "get",
                    data:{
                        page:page,
                        keyword:search,
                        posisi:posisi,
                        perusahaan:perusahaan,
                        province:province,
                        gaji_awal:gaji_awal,
                        gaji_akhir:gaji_akhir
                    },
                    dataType:"json",
                    beforeSend: function () {
                        pageJobs.lazzy_loader();
                    }
                })
                .done(function(data) {
                    // data = JSON.parse(data);
                    if (data.data=="") {
                        $('#load_data_message').html("<p class='data-kosong'>Data tidak ditemukan<p>");
                        $('p.next').hide();
                        action = 'active';  
                        return;
                    }
                    if(data.total<data.limit){
                        $('p.next').hide();
                    }
                    $('#load_data_message').html("");
                    $.each(data.data,function(i,val){
                        console.log(val.saved_job);
                        detail = '';
                        if(val.description_job.length>200){
                            detail = '...... <a href="'+base_url+'/job/'+val.id+'" class="orange-jobnet" target="_blank">selengkapnya</a>';
                        }
                        htmljob = '<div class="row justify-content-center mt-3 mb-5">\
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 shadow-sm card-vacancy">\
                                <div class="row justify-content-center p-3">\
                                    <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12 text-center order-lg-1 order-md-1 order-sm-1 col-xs-1">\
                                        <img src="'+val.company.image_url+'" alt="Jobnet.id" class="img-fluid img-lowongan">\
                                    </div>\
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-md-2 order-sm-2 col-xs-2">\
                                        <div class="content-lowongan">\
                                            <a href="#" class="link-orange-jobnet"><h4>'+val.title+'</h4></a> \
                                            <a href="'+val.company_url+'" class="link-orange-jobnet"><h5>'+val.company.name+'</h5></a> \
                                            <p><i class="fa fa-map-marker pr-2"> </i>'+val.company_city+'</p>';
                                            if(val.salary_status=='show'){
                                                htmljob +='<p>Rp. '+val.formatted_min_salary+' - '+val.formatted_max_salary+'</p>';
                                            }
                                        htmljob +='</div>\
                                    </div>\
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-12 order-lg-3 order-md-4 order-sm-4 order-4">\
                                        <a href="'+base_url+'/job/'+val.id+'" target="_blank" class="btn btn-outline-orange-jobnet btn-block" id="detailPekerjaan" data-id="'+val.id+'">Detail</a>';
                                        if((typeof val.saved_job !== 'undefined') && (typeof val.saved_job[0] !== 'undefined') && (val.saved_job[0].deleted_at == null)){
                                            console.log('notnull '+val.saved_job[0].deleted_at);
                                            htmljob +='<a href="" target="_blank" class="btn btn-block" id="savedJob" style="border: 2px solid black;border-radius: 3px;color:black;" data-id="'+val.id+'"><span class="fa fa-bookmark" id="bookmark"></span>  Simpan</a>';
                                        }else{
                                            htmljob +='<a href="" target="_blank" class="btn btn-block" id="savedJob" style="border: 2px solid black;border-radius: 3px;color:black;" data-id="'+val.id+'"><span class="fa fa-bookmark-o" id="bookmark"></span>  Simpan</a>';
                                        }
                                    htmljob +='</div>\
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-12 order-lg-4 order-md-3 order-sm-3 order-3">\
                                        <p class="text-justify">'+(val.description_job).substring(0,200)+''+detail+'</p>\
                                    </div>\
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-4 order-md-3 order-sm-3 order-3">\
                                        <p style="float:right;text-align:right;font-style: italic;font-size:10pt">Tanggal Posting : '+val.tanggal_posting+'</p>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>';
                        $("#post-data").append(htmljob);
                    });
                    action = 'inactive';
                });
            }

        }

        $(function(){
            pageJobs.init();
        });

        // QR CODE
        var demoParams = {
            title: "Logo",
            config: {
                text: base_url+'/jobseeker/cv/'+$("#imgqrcode").attr('jobseeker'), // Content
                width: 200, // Widht
                height: 200, // Height
                colorDark: "#000000", // Dark color
                colorLight: "#ffffff", // Light color
                // logo: "logo-transparent.png", // LOGO
                logo:$("#imgqrcode").val(),  
                logoWidth:80, 
                logoHeight:80,
                logoBackgroundColor: '#ffffff', // Logo backgroud color, Invalid when `logBgTransparent` is true; default is '#ffffff'
                logoBackgroundTransparent: false, // Whether use transparent image, default is false
    
                correctLevel: QRCode.CorrectLevel.H // L, M, Q, H
            }
        }

        var container = document.getElementById('qrcodes');
        qrcode = new QRCode(container, demoParams.config);
        // $('#qrcodesimg').html(container.firstElementChild.nextElementSibling.attributes.src);
        // END QR CODE

        $(document).on('click','#detailPekerjaan',function(){
            id = $("#detailPekerjaan").attr('data-id');
            modal = $('#modalDetailLowongan');
            $.ajax({
                url: base_url +'/ajax/job',
                type: 'GET',
                dataType : 'json',
                data: {mode:'detail-job',id:id},
                success: function(response) {
                    modal.find('#judul').text(response.title);
                    modal.find('#perusahaan').text(response.company.name);
                    modal.find('#lokasi').text(response.company.city.name);
                    modal.find('#range-gaji').text("Rp. "+response.formatted_min_salary+" - "+response.formatted_max_salary);
                    modal.find('#deskripsi').text(response.description);
                    modal.find('#job_id').val(response.id);
                    modal.find('#applied').remove();
                    if(response.cek_applicant_jobseeker_count){
                        $("#melamar").remove();
                        modal.find('form').append("<p id='applied' class='btn btn-orange-jobnet btn-block mt-2'>Anda sudah melamar</p>");
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    } 
});
/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-archievement-page'),
        $form = $('#form-jobseeker-archievement'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });
        
            form_validation($form,{
                archievement : {
                    required : true,
                },
            });
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-archievement-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_archievement",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    }
                },
                "columns": [
                    { data: 'archievement', name: 'archievement' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };

    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: jobseekerSavedJob.js
    Description: Jobseekers Saved Job Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-saved-job-page'),
        $form = $('#form-'+action),
        $table = {};
    var url = $('#url').val();
    var page   = 1;
    $('#post-data-saved').html('');

    var action = 'inactive';
        pageJobsSaved = {
            init: function () {
                var page   = 1;
                var action = 'inactive';
                pageJobsSaved.loadMoreData();
                if (action == 'inactive') {
                    pageJobsSaved.lazzy_loader();
                    setTimeout(function () {
                        pageJobsSaved.loadMoreData(page);
                    }, 1000);
                }
                
                $("p.next").click(function() {
                    pageJobsSaved.lazzy_loader();
                    setTimeout(function () {
                        pageJobsSaved.loadMoreData(++page);
                    }, 1000);
                });
            },
            lazzy_loader : function(){
                var output = '';
                for (var count = 0; count < 10; count++) {
                    output += '<div class="post_data">';
                    output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
                    output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
                    output += '</div>';
                }
                $('#load_data_message-saved').html(output); 
            },
            loadMoreData : function(page){
                $.ajax({
                    url: current_url,
                    type: "get",
                    data:{
                        page:page
                    },
                    dataType:"json",
                    beforeSend: function () {
                        pageJobsSaved.lazzy_loader();
                    }
                })
                .done(function(data) {
                    // data = JSON.parse(data);
                    if (data.data=="") {
                        $('#load_data_message-saved').html("<p class='data-kosong'>Data tidak ditemukan<p>");
                        $('p.next').hide();
                        action = 'active';  
                        return;
                    }
                    if(data.total<data.limit){
                        $('p.next').hide();
                    }
                    $('#load_data_message-saved').html("");
                    $.each(data.data,function(i,val){
                        detail = '';
                        if(val.description_job.length>200){
                            detail = '...... <a href="'+base_url+'/job/'+val.id+'" class="orange-jobnet" target="_blank">selengkapnya</a>';
                        }
                        htmljob = '<div class="row justify-content-center mt-3 mb-5">\
                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 shadow-sm card-vacancy">\
                                <div class="row justify-content-center p-3">\
                                    <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12 text-center order-lg-1 order-md-1 order-sm-1 col-xs-1">\
                                        <img src="'+val.company.image_url+'" alt="Jobnet.id" class="img-fluid img-lowongan">\
                                    </div>\
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 order-lg-2 order-md-2 order-sm-2 col-xs-2">\
                                        <div class="content-lowongan">\
                                            <a href="#" class="link-orange-jobnet"><h4>'+val.title+'</h4></a> \
                                            <a href="'+val.company_url+'" class="link-orange-jobnet"><h5>'+val.company.name+'</h5></a> \
                                            <p><i class="fa fa-map-marker pr-2"> </i>'+val.company_city+'</p>';
                                            if(val.salary_status=='show'){
                                                htmljob +='<p>Rp. '+val.formatted_min_salary+' - '+val.formatted_max_salary+'</p>';
                                            }
                                        htmljob +='</div>\
                                    </div>\
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-12 order-lg-3 order-md-4 order-sm-4 order-4">\
                                        <a href="'+base_url+'/job/'+val.id+'" target="_blank" class="btn btn-outline-orange-jobnet btn-block" id="detailPekerjaan" data-id="'+val.id+'">Detail</a>\
                                        <a href="" class="btn btn-block" id="savedJob" style="border: 2px solid black;border-radius: 3px;color:black;" data-id="'+val.id+'"><span class="fa fa-bookmark" id="bookmark"></span>  Simpan</a>\
                                    </div>\
                                    <div class="col-lg-10 col-md-10 col-sm-12 col-12 order-lg-4 order-md-3 order-sm-3 order-3">\
                                        <p class="text-justify">'+(val.description_job).substring(0,200)+''+detail+'</p>\
                                    </div>\
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 order-lg-4 order-md-3 order-sm-3 order-3">\
                                        <p style="float:right;text-align:right;font-style: italic;font-size:10pt">Tanggal Posting : '+val.tanggal_posting+'</p>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>';
                        $("#post-data-saved").append(htmljob);
                    });
                    action = 'inactive';
                });
            }

        }

        $(function(){
            pageJobsSaved.init();
        });

        $(document).on('click','#savedJob',function(e){
            e.preventDefault();
                data_id = $(this).attr('data-id');
                is_candidate = $(this).data('value') == 1 ? 0 : 1;
                $.ajax({
                    url: url+'/ajax/jobseeker-saved-job?mode=delete-saved&id='+data_id,
                    type: "POST",
                    beforeSend: function () {
                        if( $('#post-data').length ){
                            $('#post-data').html('');
                            pageJobs.lazzy_loader();
                        }
                        if($('#post-data-saved').length){
                            $('#post-data-saved').html('');
                            pageJobsSaved.lazzy_loader();
                        }
                    },
                    success: function(response) {
                        if( $('#post-data').length ){
                            $('#post-data').html('');
                            pageJobs.init();
                        }
                        if($('#post-data-saved').length){
                            $('#post-data-saved').html('');
                            pageJobsSaved.init();
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
        });
});


/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-education-page'),
        $form = $('#form-jobseeker-education'),
        $table = {};
    var base_url = $('#url').val();

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                // $('.selectpicker').selectpicker('mobile');
            }

            $('.selectpicker').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder: 'Kata kunci ...',
                size: 5,
            });
            if ($('#education_id').val() > 0 && $("#collegeid").val() > 0) {
                page.getEducationProgram($('#education_id').val(),$('#department_id').val());
                $.ajax({
                    url: base_url + '/jobseeker_education/get-select/institute',
                    type: 'get',
                    data: {
                        education_id: $('#education_id').val(),
                        college_id: $("#collegeid").val()
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.point < 40) {
                            $("#name_html").html(response.html);
                        } else {
                            $('#name_html').html(response.html).children('.form-control').addClass('show-menu-arrow').selectpicker({
                                style: 'outline-blue-jobnet',
                                liveSearch: true,
                                liveSearchPlaceholder: 'Pilih universitas ...',
                                size: 5,
                            }).ajaxSelectPicker(page.optionSelectpicker('jobseeker_education','get-univesitas','Cari berdasarkan nama'));
                        }
                    }
                });
            }

            $("#education_id").on("change", function (e) {
                e.preventDefault();
                page.getEducationProgram($(this).val(),$('#department_id').val());
                $.ajax({
                    url: base_url + '/jobseeker_education/get-select/institute',
                    type: 'get',
                    data: {
                        education_id: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function () {
                        $('#name_html').children('.form-control').selectpicker('destroy');
                    },
                    success: function (response) {
                        if (response.point < 40) {
                            $("#name_html").html(response.html);
                        } else {
                            $('#name_html').html(response.html).children('.form-control').addClass('show-menu-arrow').selectpicker({
                                style: 'outline-blue-jobnet',
                                liveSearch: true,
                                liveSearchPlaceholder: 'Pilih universitas ...',
                                size: 5,
                            }).ajaxSelectPicker(page.optionSelectpicker('jobseeker_education','get-univesitas','Cari berdasarkan nama'))
                        }
                    }
                });
            });
            
            $(document).on("change","#department",function (e) {
                e.preventDefault();
                $.ajax({
                    url: base_url + '/jobseeker_education/get-select/department',
                    type: 'get',
                    data: {
                        department: $(this).val(),
                    },
                    dataType: "json",
                    beforeSend: function () {

                    },
                    success: function (response) {
                        $('#department_id').val(response.id);
                    }
                });
            });
            
            $('#city_id').selectpicker({
                liveSearchPlaceholder: 'Isikan nama kota/kabupaten ...',
            }).ajaxSelectPicker(mainJs.optionSelectpicker('jobseeker_education','get-city','Isikan nama kota/kabupaten ...'))

            $("#name_html").on("change", "#college_id", function (e) {
                e.preventDefault();
                $.ajax({
                    url: base_url + '/jobseeker_education/get-select/name',
                    type: 'get',
                    data: {
                        education_id: $(this).val()
                    },
                    dataType: "html",
                    success: function (html) {
                        $("#name_html2").html(html);
                    }
                });
            });

            form_validation($form, {
                education_id: {
                    required: true,
                },
                department: {
                    required: true
                },
                name: {
                    required: true
                },
                city_id: {
                    required: true
                },
                from: {
                    required: true
                },
                to: {
                    required: true
                },
                is_graduate: {
                    required: true
                },
                score: {
                    required: true,
                    number: true
                },
                file: {
                    // required : true,
                    extension: "pdf",
                    filesize: 1048576
                },
            });

            $page.on('click', '#delete-file', function () {
                id = $(this).attr('data-id');
                path = $(this).attr('data-path');
                mainJs.deleteFile(id, path, 'jobseeker_education');
            });
        },
        getEducationProgram: function (education_id,department_id) {
            $.ajax({
                url: base_url + '/jobseeker_education/get-select/program',
                type: 'get',
                data: {
                    education_id : education_id,
                    department_id : department_id
                },
                dataType: "json",
                success: function (response) {
                    if (response.point < 40) {
                        $("#html_department").html(response.html);
                    }else{
                        $("#html_department").html(response.html).children('.form-control').addClass('show-menu-arrow').selectpicker({
                            style: 'outline-blue-jobnet',
                            liveSearch: true,
                            liveSearchPlaceholder: 'Pilih jurusan ...',
                            size: 5,
                        });
                    }
                }
            });
        },
        optionSelectpicker:function(route,mode='selectpicker',placeholder='Select and Begin Typing'){
            var options = {
                ajax: {
                    url: base_url+'/ajax/'+route,
                    type: "POST",
                    dataType: "json",
                    data: {
                        mode:mode,
                        q: "{{{q}}}"
                    }
                },
                locale: {
                    emptyTitle: placeholder
                },
                log: 3,
                preprocessData: function (data) {
                    var array = [];
                    $.each(data,function(i,val){
                        array.push(
                            $.extend(true, i, {
                                text: val.name,
                                value: val.id,
                                data: {
                                    subtext: val.detail.substring(0,40)+" . . ."
                                }
                            })
                        );
                    });
                    return array;
                }
            };
            return options;
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-education-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_education",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "Json",
                    data: function (d) {
                        d.mode = 'datatable';
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    }
                },
                "columns": [{
                        data: 'education_id',
                        name: 'education_id'
                    },
                    {
                        data: 'department',
                        name: 'department'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'score',
                        name: 'score'
                    },
                    {
                        data: 'document',
                        name: 'document'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                "columnDefs": [{
                    targets: 'no-sort',
                    orderable: false
                }],
            });

            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url + '/' + rowId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });

                                setTimeout(function () {
                                    if (refresh) {
                                        page.dtTable.draw();
                                    }
                                }, 3000);
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };

    if ($page.length) {
        page.init();
    }
});

/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-education-non-formal-page'),
        $form = $('#form-jobseeker-education-non-formal'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });
        
            form_validation($form,{
                type : {
                    required : true,
                },
                title : {
                    required : true
                },
                organizer : {
                    required : true
                },
                city_id : {
                    required : true
                },
                long_education : {
                    required : true
                },
                year : {
                    required : true
                },
            });
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-education-non-formal-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_education_non_formal",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    }
                },
                "columns": [
                    { data: 'nomor', name: 'nomor' },
                    { data: 'type', name: 'type' },
                    { data: 'title', name: 'title' },
                    { data: 'organizer', name: 'organizer' },
                    { data: 'city_id', name: 'city_id' },
                    { data: 'long_education', name: 'long_education' },
                    { data: 'year', name: 'year' },
                    { data: 'financed_by', name: 'financed_by' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };

    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-language-skill-page'),
        $form = $('#form-jobseeker-language-skill'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });
        
            form_validation($form,{
                language : {
                    required : true,
                },
                speaking_score : {
                    required : true,
                },
                writing_score : {
                    required : true,
                },
            });
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-language-skill-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                // "language": {
                //  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                // },
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_language_skill",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'language', name: 'language' },
                    { data: 'speaking_score', name: 'speaking_score' },
                    { data: 'speaking_score', name: 'speaking_score' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };

    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-sertification-page'),
        $form = $('#form-jobseeker-sertification'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });

            $page.on('click','#delete-file',function(){
                id   = $(this).attr('data-id');
                path = $(this).attr('data-path');
                mainJs.deleteFile(id, path,'jobseeker_sertification');
            });
        
            form_validation($form,{
                sertification_name : {
                    required : true,
                },
                issued_by : {
                    required : true,
                },
                year : {
                    required : true,
                },
                file : {
                    // required : true,
                    accept: "application/pdf",
                    filesize:1048576
                },
            });     
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-sertification-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                // "language": {
                //  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                // },
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_sertification",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'sertification_name', name: 'sertification_name' },
                    { data: 'issued_by', name: 'issued_by' },
                    { data: 'year', name: 'year' },
                    { data: 'document', name: 'document' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    
    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-social-activity-page'),
        $form = $('#form-jobseeker-social-activity'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });
        
            form_validation($form,{
                organize_name : {
                    required : true,
                },
                date_in : {
                    required : true
                },
                date_out : {
                    required : true
                },
                last_position : {
                    required : true
                },
            });
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-social-activity-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_social_activity",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    }
                },
                "columns": [
                    { data: 'organize_name', name: 'organize_name' },
                    { data: 'date_in', name: 'date_in' },
                    { data: 'date_out', name: 'date_out' },
                    { data: 'last_position', name: 'last_position' },
                    { data: 'description', name: 'description' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };

    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-special-skill-page'),
        $form = $('#form-jobseeker-special-skill'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });
        
            form_validation($form,{
                skill : {
                    required : true,
                },
                level : {
                    required : true,
                },
            });
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-special-skill-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                // "language": {
                //  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                // },
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_special_skill",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'skill', name: 'skill' },
                    { data: 'level', name: 'level' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };

    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: jobseekers.js
    Description: Jobseekers Page
==========================================================================================*/
$(document).ready(function () {
    var action = $('#action').val();
    var current_url = $('#hidden_current_url').val(),
        $page = $('#jobseeker-working-exps-page'),
        $form = $('#form-jobseeker-working-exps'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                // $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });

            $page.on('click','#delete-file',function(){
                id   = $(this).attr('data-id');
                path = $(this).attr('data-path');
                mainJs.deleteFile(id, path,'jobseeker_working_exps');
            });
        
            form_validation($form,{
                company_name : {
                    required : true,
                },
                company_location : {
                    required : true
                },
                company_industry : {
                    required : true
                },
                date_in : {
                    required : true
                },
                date_out : {
                    required : true
                },
                specialization : {
                    required : true
                },
                job_sector : {
                    required : true
                },
                position : {
                    required : true
                },
                salary : {
                    required : true
                },
                job_description : {
                    required : true,
                    maxlength:200,
                },
                file : {
                    // required : true,
                    extension: "pdf",
                    filesize:1048576
                },
            }); 
        },
        initDatatable: function () {
            $table = $page.find('#jobseeker-working-exps-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/ajax/jobseeker_working_exps",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    }
                },
                "columns": [
                    { data: 'company', name: 'company' },
                    { data: 'date_in', name: 'date_in' },
                    { data: 'date_out', name: 'date_out' },
                    { data: 'specialization', name: 'specialization' },
                    { data: 'job_sector', name: 'job_sector' },
                    { data: 'position', name: 'position' },
                    { data: 'salary', name: 'salary' },
                    { data: 'job_description', name: 'job_description' },
                    { data: 'document', name: 'document' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };

    if ($page.length) {
        page.init();
    } 
});
/*=========================================================================================
    File Name: events.js
    Description: Events Page
==========================================================================================*/
$(document).ready(function () {
    var current_url = $('#hidden_current_url').val(),
        $page = $('#logos-page'),
        $form = $('#form-logos'),
        $table = {};
    var base_url = $('#url').val(); 

    var page = {
        dtTable: {},
        init: function () {
            this.initDatatable();
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                $('.selectpicker').selectpicker('mobile');
            }
        
            $('.selectpicker').addClass('show-menu-arrow').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder : 'Kata kunci ...',
                size : 5,
            });

            $page.on('click','#delete-file',function(){
                id   = $(this).attr('data-id');
                path = $(this).attr('data-path');
                mainJs.deleteFile(id, path);
            });
            form_validation($form,{
                title : {
                    required : true,
                },
                order : {
                    required : true,
                },
                status : {
                    required : true,
                },
                file : {
                    // required : true,
                    extension: "jpg|jpeg|JPEG|JPG|png|PNG",
                    filesize:1048576
                },
            });     
        },
        initDatatable: function () {
            $table = $page.find('#logos-datatable');
            page.dtTable = $table.DataTable({
                "processing": true,
                // "language": {
                //  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                // },
                "serverSide": true,
                "searching": false,
                "lengthChange": false,
                "ajax": {
                    url: base_url + "/admin/ajax/logos",
                    type: "POST",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    dataType: "Json",
                    data: function (d) { 
                        d.mode = 'datatable'; 
                        d.search = {
                            keyword: $("#keyword").val()
                        }
                    },
                },
                "columns": [
                    { data: 'title', name: 'title' },
                    { data: 'order', name: 'order' },
                    { data: 'status', name: 'status' },
                    { data: 'logo', name: 'logo' },
                    { data: 'action', name: 'action' },
                ],
                "columnDefs": [
                    { targets: 'no-sort', orderable: false }
                ],
            });
            
            /** Trigger filter */
            $page.find("#btn-search").on('click', function (e) {
                e.preventDefault();
                page.dtTable.draw();
            });

            $table.on('click', '#hapus', function () {
                rowId = $(this).attr('data-id');
                page.deleteData(rowId);
                // deleteConfirm('Are you sure to delete this data?', perusahaanPage.deleteData, rowId);
            });
        },
        deleteData: function (rowId) {
            Swal.fire({
                title: 'Hapus Data!',
                text: "Apakah anda yakin?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: current_url +'/'+ rowId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType : 'json',
                        success: function(response) {
                            if(response.success){
                                var refresh = true;
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Oke!',
                                }).then((result) => {
                                    if (result.value) {
                                        page.dtTable.draw();
                                        refresh = false;
                                    }
                                });
                                
                                setTimeout(function(){
                                    if(refresh){
                                        page.dtTable.draw();
                                    }
                                },3000);    
                            }else{
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error',
                                )
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        }
    };
    if ($page.length) {
        page.init();
    } 
});
