<?php

namespace App\Http\Controllers\logistik\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogLokasi;

class LokasiController extends Controller
{
    public function index()
    {
        $locations = LogLokasi::where('soft_delete', 0)->get();
        return view('logistik.admin.lokasi.index', ['locations' => $locations]);
    }

    public function beforePostLocation()
    {
        return view('logistik.admin.lokasi.create');
    }

    public function postLocation()
    {
        $data = \Input::all();

        $addLocation = new LogLokasi;
        $addLocation->nama = $data['nama'];
        $addLocation->keterangan = $data['keterangan'];
        $addLocation->user_id = \Auth::user()->id;
        $addLocation->soft_delete = 0;
        $addLocation->created_at = date('Y-m-d H:i:s');
        $addLocation->save();

        return redirect('/logistik/admin/lokasi');

    }

    public function getLocationById($id)
    {
        $getLocation = LogLokasi::find($id);
        return view('logistik.admin.lokasi.edit', ['location' => $getLocation]);
    }

    public function updateLocation($id)
    {
        $getLocation = LogLokasi::find($id);

        if ($getLocation) {
            $data = \Input::all();
            $toUpdateLocation['nama'] = $data['nama'];
            $toUpdateLocation['keterangan'] = $data['keterangan'];
            $toUpdateLocation['updated_at'] = date('Y-m-d H:i:s');

            $UpdatedLocation = LogLokasi::where('id', $data['id'])->update($toUpdateLocation);
        }

        return redirect('/logistik/admin/lokasi');

    }

    public function deleteLocation($id)
    {
        $deletedLocation = LogLokasi::where('id', $id)->update(['soft_delete' => 1]);
        if ($deletedLocation) {

            return redirect('/logistik/admin/lokasi');

        }
    }
}
