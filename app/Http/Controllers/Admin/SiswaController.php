<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function naik_kelas()
    {
        $data = [];
        for ($i = 1; $i <= 6; $i++) {
            $data[$i] = Siswa::where('kelas', $i)
                ->where('status', 'aktif')
                ->get();
        }

        return view('admin.masterdata.naikkelas.index', compact('data'));
    }

    public function naikSemua(Request $request)
    {
        $kelas = $request->input('kelas');
        if (6 == $kelas) {
            Siswa::where('kelas', 6)->update(['status' => 'lulus']);
        } else {
            Siswa::where('kelas', $kelas)->update(['kelas' => $kelas + 1]);
        }

        return redirect()->route('admin.siswa.naikkelas')->with('toast_success', 'Siswa berhasil dinaikkan.');
    }

    public function naikSingel(Request $request)
    {
        $nis   = $request->input('nis');
        $kelas = $request->input('kelas');

        $siswa = Siswa::where('nis', $nis)->first();
        if (6 == $kelas) {

            $siswa->status = 'lulus';
        } else {

            $siswa->kelas = $kelas + 1;
        }

        $siswa->save();

        return redirect()->route('admin.siswa.naikkelas')->with('toast_success', 'Siswa berhasil dinaikkan.');
    }

    public function siswaLulus()
    {
        $siswaLulus = Siswa::where('status', 'lulus')->get();
        return view('admin.masterdata.siswa.siswalulus', compact('siswaLulus'));
    }

    public function hapusSiswaLulus($nis)
    {
        if ($nis) {
            Siswa::where('status', 'lulus')->where('nis', $nis)->update(['status' => 'aktif']);
            return redirect()->back()->with('toast_success', 'Data kelulusan siswa dihapus.');
        } else {
            Siswa::where('status', 'lulus')->update(['status' => 'aktif']);
            return redirect()->back()->with('toast_success', 'Seluruh data kelulusan siswa berhasil dihapus.');
        }
    }

    public function index()
    {
        $siswa      = Siswa::all();
        $totalSiswa = Siswa::getTotalSiswa();
        return view('admin.masterdata.siswa.index', compact('siswa', 'totalSiswa'));
    }

    public function create()
    {

        return view('admin.masterdata.siswa.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nis'           => 'required|unique:siswas,nis',
            'nama'          => 'required',
            'alamat'        => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp'          => 'required',
            'kelas'         => 'required',
            'foto'          => 'nullable|image|mimes:jpg,png,jpeg,jfif|max:2048',
        ], [
            'nis.required'           => 'NIS wajib diisi.',
            'nis.unique'             => 'NIS sudah terdaftar.',
            'nama.required'          => 'Nama wajib diisi.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'nohp.required'          => 'Nomor HP wajib diisi.',
            'kelas.required'         => 'Kelas wajib diisi.',
            'foto.image'             => 'Foto harus berupa gambar.',
            'foto.mimes'             => 'Foto harus berformat jpg, png, jpeg, atau jfif.',
            'foto.max'               => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            $foto                  = $request->file('foto');
            $filename              = date('d-m-y') . '_' . $validatedData['nama'] . '.' . $foto->getClientOriginalExtension();
            $path                  = $foto->storeAs('foto-siswa', $filename, 'public');
            $validatedData['foto'] = $filename;
        }
        $validatedData['status'] = 'aktif';

        $siswa = Siswa::create($validatedData);

        $password = substr($siswa->nis, -6);

        $siswa->password = Hash::make($password);
        $siswa->save();

        return redirect()->route('admin.siswa.index')->with('toast_success', 'Data siswa berhasil disimpan.');
    }

    public function edit($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        return view('admin.masterdata.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nis)
    {

        $validatedData = $request->validate([
            // 'nis' => 'required|unique:siswa,nis',
            'nama'          => 'required',
            'alamat'        => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'nohp'          => 'required',
            'kelas'         => 'required',
            'foto'          => 'nullable|image|mimes:jpg,png,jpeg,jfif|max:2048',
        ], [
            'nis.required'           => 'NIS wajib diisi.',
            'nis.unique'             => 'NIS sudah terdaftar.',
            'nama.required'          => 'Nama wajib diisi.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'nohp.required'          => 'Nomor HP wajib diisi.',
            'kelas.required'         => 'Kelas wajib diisi.',
            'foto.image'             => 'Foto harus berupa gambar.',
            'foto.mimes'             => 'Foto harus berformat jpg, png, jpeg, atau jfif.',
            'foto.max'               => 'Ukuran foto maksimal 2MB.',
        ]);
        $validatedData['status'] = 'aktif';

        $siswa = Siswa::findOrFail($nis);

        if ($request->input('nis') !== $siswa->nis) {

            $validatedData['nis'] = $request->input('nis');
        }

        if ($request->hasFile('foto')) {

            if ($siswa->foto) {
                Storage::disk('public')->delete('foto-siswa/' . $siswa->foto);
            }

            $foto                  = $request->file('foto');
            $filename              = date('d-m-y') . '_' . $validatedData['nama'] . '.' . $foto->getClientOriginalExtension();
            $path                  = $foto->storeAs('foto-siswa', $filename, 'public');
            $validatedData['foto'] = $filename;
        }

        $siswa->update($validatedData);

        return redirect()->route('admin.siswa.index')->with('toast_success', 'Data siswa berhasil diperbarui.');
    }

    public function delete($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();

        if ($siswa->foto) {

            Storage::disk('public')->delete('foto-siswa/' . $siswa->foto);
        }

        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('toast_success', 'Data siswa berhasil dihapus.');
    }
}