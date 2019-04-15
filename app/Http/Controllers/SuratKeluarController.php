<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        return view('admin.surat_keluar.index');
    }

    public function getCreate()
    {
        return view('admin.surat_keluar.create');
    }
}
