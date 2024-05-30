<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        $data_informasi = Informasi::orderBy('id', 'desc')->get();

        $pageTitle = 'Data Informasi - SD Kristen Pelita Hati';
        return view('admin.informasi.index', compact(
            'data_informasi',
            'pageTitle'
        ));
    }

    public function create(Request $request)
    {
        $request->validate([
            'judul'   => 'required',
            'info'    => 'required',
            'tanggal' => 'required',
            'tampil'  => 'required',
        ], [
            'judul.required'   => 'Kolom judul tidak boleh kosong !',
            'info.required'    => 'Kolom info tidak boleh kosong !',
            'tanggal.required' => 'Kolom tanggal tidak boleh kosong !',
            'tampil.required'  => 'Kolom tampil tidak boleh kosong !',
        ]);

        Informasi::create($request->all());

        return redirect()->route('informasi.index')->with('toast_success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $data_informasi = Informasi::findOrFail($id);

        $request->validate([
            'judul'   => 'required',
            'info'    => 'required',
            'tanggal' => 'required',
            'tampil'  => 'required',
        ], [
            'judul.required'   => 'Kolom judul tidak boleh kosong !',
            'info.required'    => 'Kolom info tidak boleh kosong !',
            'tanggal.required' => 'Kolom tanggal tidak boleh kosong !',
            'tampil.required'  => 'Kolom tampil tidak boleh kosong !',
        ]);

        $data_informasi->judul   = $request->judul;
        $data_informasi->info    = $request->info;
        $data_informasi->tanggal = $request->tanggal;
        $data_informasi->tampil  = $request->tampil;
        $data_informasi->save();

        return redirect()->route('informasi.index')->with('toast_success', 'Data berhasil diupdate.');
    }

    public function delete($id)
    {
        $data_informasi = Informasi::findOrFail($id);
        $data_informasi->delete();

        return redirect()->route('informasi.index')->with('toast_success', 'Data berhasil dihapus.');
    }
}
