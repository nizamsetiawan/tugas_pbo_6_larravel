<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if (strlen($katakunci)) {
            $data = mahasiswa::where('nim', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('jurusan', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = mahasiswa::orderBy('nim', 'desc')->paginate($jumlahbaris);
        }
        return view('mahasiswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);
        Session::flash('jenis_kelamin', $request->jenis_kelamin);
        Session::flash('alamat', $request->alamat);
        Session::flash('email', $request->email);

        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required|',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg,gif',
        ], [
                'nim.required' => 'NIM masih kosong',
                'nim.numeric' => 'NIM wajib dengan angka',
                'nim.unique' => 'NIM yang sudah diisikan sudah ada',
                'nama.required' => 'nama masih kosong',
                'jurusan.required' => 'prodi masih kosong',
                'alamat.required' => 'alamat masih kosong',
                'email.required' => 'email masih kosong',
                'jenis_kelamin.required' => 'jenis kelamin masih kosong',
                'foto.required' => 'Silahkan masukkan foto',
                'foto.mimes' => 'Foto hanya diperbolehkan PNG, JPG, JPEG, dan GIF',
            ]);
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $foto_nama,
        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|',
            'jurusan' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ], [
                'nama.required' => 'nama masih kosong',
                'jurusan.required' => 'prodi masih kosong',
                'alamat.required' => 'alamat masih kosong',
                'email.required' => 'email masih kosong',
                'jenis_kelamin.required' => 'jenis kelamin masih kosong',
                'foto.required' => 'Silahkan masukkan foto',
            ]);
        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:png,jpg,jpeg,gif'
            ], [
                    'foto.mimes' => 'Foto hanya diperbolehkan PNG, JPG, JPEG, dan GIF'
                ]);
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('foto'), $foto_nama);

            $data_foto = mahasiswa::where('nim', $id)->first();
            File::delete(public_path('foto') . '/' . $data_foto->foto);

            //$data = [
            //    'foto' => $foto_nama
            // ];
            $data['foto'] = $foto_nama;
        }
        mahasiswa::where('nim', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil melakukan update data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        File::delete(public_path('foto') . '/' . $data->foto);
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success', 'Berhasil melakukan delete data');
    }
}