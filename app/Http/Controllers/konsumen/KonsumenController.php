<?php

namespace App\Http\Controllers\konsumen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\konsumen;

class KonsumenController extends Controller
{
    function index() {
        return View::make('konsumen.index');
    }

    function dataSource(Request $request) {
        $data = konsumen::all()->makeHidden(['created_at','updated_at'])->toArray();
        $new_data = array();
        foreach ($data as $key=>$value) {
            $tmp_data = array();
            foreach ($value as $k=>$v) {
                if ($k != 'id')
                $tmp_data[] = $v;
            }
            $btn = "<a class='btn btn-warning' title='ubah' onclick='ubahKonsumen(\"".$value['id']."\")'><span><i class='fa fa-pencil'></i></span></a>";
            $btn .= "<a class='btn btn-danger' title='hapus' onclick='hapusKonsumen(\"".$value['id']."\")'><span><i class='fa fa-trash'></i></span></a>";
            $tmp_data[] = $btn;
            $new_data[] = $tmp_data;
        }
        return response()->json(['data' => $new_data]);
    }

    function insert(Request $request) {
        $data = new konsumen();
        $data->nm_konsumen = $request->nm_konsumen;
        $data->jns_kendaraan = $request->jns_kendaraan;
        $data->nopol = $request->nopol;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jns_kelamin = $request->jns_kelamin;
        $data->no_hp = $request->no_hp;
        if ($data->save()) {
            return response()->json('Data berhasil disimpan');
        } else {
            return response()->json('Data gagal disimpan');
        }
    }

    function update(Request $request) {
        $data = konsumen::find($request->id);
        $data->nm_konsumen = $request->nm_konsumen;
        $data->jns_kendaraan = $request->jns_kendaraan;
        $data->nopol = $request->nopol;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jns_kelamin = $request->jns_kelamin;
        $data->no_hp = $request->no_hp;
        if ($data->save()) {
            return response()->json('Data berhasil disimpan');
        } else {
            return response()->json('Data gagal disimpan');
        }
    }

    function getID($id) {
        $data = konsumen::find($id);
        if($data !== null) {
            return response()->json(['status' => 1, 'data' => $data->toArray()]);
        } else {
            return response()->json(['status' => 0, 'data' => (object) array("Data tidak ditemukan")]);
        }
    }
}
