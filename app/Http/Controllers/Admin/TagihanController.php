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
        $tagihan->tagihan_aktif = 12;
        $tagihan->tagihan_perbulan = $tagperbulan;
        $tagihan->total_tagihan = $tagperbulan * 12;

        $tagihan->updateTotalTagihan();


        $tagihan->save();

        return redirect()->route('tagihan.index')
            ->with('toast_success', 'Tagihan created successfully.');
    }



    public function edit($kelas)
    {
        $tagihan = Tagihan::find($kelas);
        return view('admin.tagihan.edit', compact('tagihan'));
    }

    public function update(Request $request, $kelas)
    {
        $tagihan = Tagihan::find($kelas);

        // Jika kelas tidak diubah, kita tidak perlu melakukan validasi unik
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

        // Update atribut
        $tagihan->kelas = $request->kelas;
        $tagihan->tagihan_perbulan = $tagperbulan;

        // Memanggil metode updateTotalTagihan() untuk memperbarui total_tagihan
        $tagihan->updateTotalTagihan();

        // Menyimpan perubahan
        $tagihan->save();

        return redirect()->route('tagihan.index')
            ->with('toast_success', 'Tagihan updated successfully');
    }
        public function delete($kelas)
    {
        Tagihan::find($kelas)->delete();
        return redirect()->route('tagihan.index')
            ->with('toast_success', 'Tagihan deleted successfully');
    }
}
