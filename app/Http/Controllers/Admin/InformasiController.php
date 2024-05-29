<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{

    public function index()
    {
        $informasi = Informasi::all();

        return view('admin.informasi.index', compact('informasi'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'judul' => 'required',
            'info' => 'required',
            'tanggal' => 'required|date',
        ],[
            'judul.required'=>'Berikan Judul Informasi',
            'info.required'=> 'Berikan Informasi',
            'tanggal.required'=> 'Tanggal harap diisi',
        ]
    );
        $validatedData['tampil'] = 0;
        Informasi::create($validatedData);
        return redirect()->route('informasi.index')->with('toast_success', 'Informasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);

        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'judul' => 'required',
            'info' => 'required',
            'tanggal' => 'required|date',
        ]);
        $validatedData['tampil'] = 0;

        $informasi = Informasi::findOrFail($id);
        $informasi->update($validatedData);

        return redirect()->route('informasi.index')->with('toast_success', 'Informasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $informasi = Informasi::findOrFail($id);

        $informasi->delete();

        return redirect()->route('informasi.index');
    }
    public function tampil($id)
    {
        $informasi = Informasi::findOrFail($id);

        if ($informasi->tampil != 0) {
            return redirect()->back()->with('toast_error', 'Informasi sudah ditampilkan.');
        }


        $informasi->tampil = 1;
        $informasi->save();


        return redirect()->route('informasi.index')->with('toast_success', 'Informasi berhasil ditampilkan.');
    }
    


}
