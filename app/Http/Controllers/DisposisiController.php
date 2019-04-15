<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    public function indexSuratMasuk()
    {
        return view('disposisi.surat_masuk.index');
    }

    public function getCreateSuratMasuk()
    {
        return view('disposisi.surat_masuk.create');
    }



    public function index()
    {
        return view('disposisi.index');
    }

    public function getCreate()
    {
        return view('disposisi.create');
    }

    public function getMonitor()
    {
        return view('disposisi.monitoring');
    }

    
    public function indexManager()
    {
        return view('manager.disposisi.index');
    }

    public function prosesManager()
    {
        return view('manager.disposisi.proses');
    }



    public function indexPM()
    {
        return view('pm.disposisi.index');
    }

    public function prosesPM()
    {
        return view('pm.disposisi.proses');
    }
}
