<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::all();
        // $totalTagihan = $tagihan->sum('total_tagihan');
        return view('admin.tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        return view('admin.tagihan.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'kelas' => 'required|unique:tagihan,kelas',
                'tagihan_perbulan' => 'required',
            ],
            [
                'kelas.unique' => 'Tagihan Sudah Ada !',
            ]
        );

        $tagperbulan = str_replace('.', '', $request->tagihan_perbulan);


        $tagihan = new Tagihan();
        $tagihan->kelas = $request->kelas;

        $tagihan->tagihan_perbulan = $tagperbulan;
        $tagihan->total_tagihan = $tagperbulan * 12;

        $tagihan->updateTotalTagihan();


        $tagihan->save();

        return redirect()->route('tagihan.index')
            ->with('toast_success', 'Tagihan Berhasil ditanbahkan');
    }



    public function edit($kelas)
    {
        $tagihan = Tagihan::find($kelas);
        return view('admin.tagihan.edit', compact('tagihan'));
    }

    public function update(Request $request, $kelas)
    {
        $tagihan = Tagihan::find($kelas);


        if ($request->kelas == $tagihan->kelas) {
            $request->validate([
                'tagihan_perbulan' => 'required',
            ]);
        } else {
            $request->validate([
                'kelas' => 'required|unique:tagihan,kelas',
                'tagihan_perbulan' => 'required',
            ], [
                'kelas.unique' => 'Tagihan Sudah Ada !',
            ]);
        }

        $tagperbulan = str_replace('.', '', $request->tagihan_perbulan);


        $tagihan->kelas = $request->kelas;
        $tagihan->tagihan_perbulan = $tagperbulan;

        $tagihan->updateTotalTagihan();


        $tagihan->save();

        return redirect()->route('tagihan.index')
            ->with('toast_success', 'Tagihan Berhasil diperbarui');
    }
        public function delete($kelas)
    {
        Tagihan::find($kelas)->delete();
        return redirect()->route('tagihan.index')
            ->with('toast_success', 'Tagihan Berhasil dihapus');
    }
}
