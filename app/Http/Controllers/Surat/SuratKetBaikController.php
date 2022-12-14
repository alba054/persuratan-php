<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat\SuratKetTidakMampu as Model;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SuratKetBaikController extends Controller
{
    public function create()
    {
        $data = User::all()->where('level_id', 2);

        return view('surat/surat_ket_baik/v_create', ['user_approve' => $data]);
    }

    public function store(Request $request)
    {
        $notif = array(
            'pesan' => 'Surat berhasil ditambah !',
            'alert' => 'success',
        );

        $request->validate([
            'no_surat' => 'required|max:100',
            'nama_pemohon' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required',
            'nik' => 'required|max:20',
            'jenis_kelamin' => 'required',
            'status_kawin' => 'required',
            'warga_negara' => 'required',
            'pekerjaan' => 'required|max:100',
            'alamat' => 'required|max:100',
            'tgl_surat' => 'required',
            'user_approve' => 'required',
            'is_antar' => 'required'
        ]);

        $data = new Model();

        $data->no_surat = $request->get('no_surat');
        $data->nama_pemohon = $request->get('nama_pemohon');
        $data->tempat_lahir = $request->get('tempat_lahir');
        $data->tgl_lahir = $request->get('tgl_lahir');
        $data->nik = $request->get('nik');
        $data->jenis_kelamin = $request->get('jenis_kelamin');
        $data->status_kawin = $request->get('status_kawin');
        $data->warga_negara = $request->get('warga_negara');
        $data->pekerjaan = $request->get('pekerjaan');
        $data->alamat = $request->get('alamat');
        $data->tgl_surat = $request->get('tgl_surat');
        $data->user_approve = $request->get('user_approve');
        $data->is_antar = $request->get('is_antar');
        $data->jenis_surat = "Surat Keterangan Berkelakuan Baik";
        $data->save();

        return redirect()->route('surat_index')->with($notif);
    }

    public function show($id)
    {

        $surat = Model::where('id', $id)->with('approve_by')->first();
        $data = [
            'baikShow' => $surat,
        ];
        return view('surat.surat_ket_baik.v_show', $data);
    }

    public function edit($id)
    {
        $surat = Model::where('id', $id)->with('approve_by')->first();
        $data = [
            'baikEdit' => $surat,
        ];
        $data2 = User::all()->where('level_id', 2);
        return view('surat.surat_ket_baik.v_edit', $data, ['user_approve' => $data2]);
    }

    public function update(Request $request, $id)
    {

        $notif = array(
            'pesan' => 'Surat berhasil diupdate !',
            'alert' => 'success',
        );

        $data = Model::findOrFail($id);

        $request->validate([
            'no_surat' => 'required|max:100',
            'nama_pemohon' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required',
            'nik' => 'required|max:20',
            'jenis_kelamin' => 'required',
            'status_kawin' => 'required',
            'warga_negara' => 'required',
            'pekerjaan' => 'required|max:100',
            'alamat' => 'required|max:100',
            'tgl_surat' => 'required',
            'user_approve' => 'required',
            'is_antar' => 'required'
        ]);

        $data->no_surat = $request->get('no_surat');
        $data->nama_pemohon = $request->get('nama_pemohon');
        $data->tempat_lahir = $request->get('tempat_lahir');
        $data->tgl_lahir = $request->get('tgl_lahir');
        $data->nik = $request->get('nik');
        $data->jenis_kelamin = $request->get('jenis_kelamin');
        $data->status_kawin = $request->get('status_kawin');
        $data->warga_negara = $request->get('warga_negara');
        $data->pekerjaan = $request->get('pekerjaan');
        $data->alamat = $request->get('alamat');
        $data->tgl_surat = $request->get('tgl_surat');
        $data->user_approve = $request->get('user_approve');
        $data->is_antar = $request->get('is_antar');
        $data->save();

        return redirect()->route('surat_index')->with($notif);
    }

    public function delete(Request $request)
    {
        $notif = array(
            'pesan' => 'Surat dihapus !',
            'alert' => 'error',
        );

        $id = $request->id;
        $data = Model::find($id);
        if ($data->file_surat) {
            Storage::delete("file-suratKeluar/" . $data->file_surat);
        }
        $data->delete();

        return redirect()->back()->with($notif);
    }
}
