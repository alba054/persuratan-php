<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat\SuratKetTidakMampu as Model;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class SuratKetLahirController extends Controller
{

    public function create()
    {
        $data = User::all()->where('level_id', 2);
        return view('surat/surat_ket_lahir/v_create', ['user_approve' => $data]);
    }

    public function store(Request $request)
    {
        $notif = array(
            'pesan' => 'Surat berhasil ditambah !',
            'alert' => 'success',
        );

        // dump($request->all());

        $request->validate([
            'no_surat' => 'required|max:100',
            'hari_lahir' => 'required',
            'tgl_lahir' => 'required',
            'pukul_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|max:50',
            'nama_bayi' => 'required|max:100',
            'nama_ibu' => 'required|max:100',
            'nik_ibu' => 'required|max:20',
            'nama_ayah' => 'required|max:100',
            'nik_ayah' => 'required|max:20',
            'alamat' => 'required|max:100',
            'kecamatan' => 'required|max:100',
            'kabupaten' => 'required|max:100',
            'tgl_surat' => 'required',
            'user_approve' => 'required',
            'is_antar' => 'required'
        ]);

        // dd("rerer");



        $data = new Model();

        $data->no_surat = $request->get('no_surat');
        $data->hari_lahir = $request->get('hari_lahir');
        $data->tgl_lahir = $request->get('tgl_lahir');
        $data->pukul_lahir = $request->get('pukul_lahir');
        $data->jenis_kelamin = $request->get('jenis_kelamin');
        $data->tempat_lahir = $request->get('tempat_lahir');
        $data->nama_bayi = $request->get('nama_bayi');
        $data->nama_ibu = $request->get('nama_ibu');
        $data->nik_ibu = $request->get('nik_ibu');
        $data->nama_ayah = $request->get('nama_ayah');
        $data->nik_ayah = $request->get('nik_ayah');
        $data->alamat = $request->get('alamat');
        $data->kecamatan = $request->get('kecamatan');
        $data->kabupaten = $request->get('kabupaten');
        $data->tgl_surat = $request->get('tgl_surat');
        $data->user_approve = $request->get('user_approve');
        $data->is_antar = $request->get('is_antar');
        $data->jenis_surat = "Surat Keterangan Kelahiran";
        $data->save();

        // dd($data);

        return redirect()->route('surat_index')->with($notif);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
