<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat\SuratKetTidakMampu as Model;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class SuratKetTidakMampuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = User::all()->where('level_id', 2);

        return view('surat/surat_ket_tidak_mampu/v_create', ['user_approve' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notif = array(
            'pesan' => 'Surat berhasil ditambah !',
            'alert' => 'success',
        );

        $request->validate([
            'no_surat' => 'required|max:100',
            'user_approve' => 'required',
            'tgl_surat' => 'required',
            'nama_pemohon' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'nik' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'is_antar' => 'required',
        ]);

        $data = new Model();

        $data->no_surat = $request->get('no_surat');
        $data->user_approve = $request->get('user_approve');
        $data->tgl_surat = $request->get('tgl_surat');
        $data->nama_pemohon = $request->get('nama_pemohon');
        $data->tempat_lahir = $request->get('tempat_lahir');
        $data->tgl_lahir = $request->get('tgl_lahir');
        $data->nik = $request->get('nik');
        $data->pekerjaan = $request->get('pekerjaan');
        $data->alamat = $request->get('alamat');
        $data->is_antar = $request->get('is_antar');
        $data->jenis_surat = "Surat Keterangan Tidak Mampu";
        $data->save();

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
        $surat = Model::where('id', $id)->with('approve_by')->first();
        $data = [
            'sktmShow' => $surat,
        ];
        return view('surat.surat_ket_tidak_mampu.v_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surat = Model::where('id', $id)->with('approve_by')->first();
        $data = [
            'sktmEdit' => $surat,
        ];
        $data2 = User::all()->where('level_id', 2);
        return view('surat.surat_ket_tidak_mampu.v_edit', $data, ['user_approve' => $data2]);
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
        $notif = array(
            'pesan' => 'Surat berhasil diupdate !',
            'alert' => 'success',
        );

        $data = Model::findOrFail($id);

        $request->validate([
            'no_surat' => 'required|max:100',
            'user_approve' => 'required',
            'tgl_surat' => 'required',
            'nama_pemohon' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'nik' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
            'is_antar' => 'required',
        ]);

        $data->no_surat = $request->get('no_surat');
        $data->user_approve = $request->get('user_approve');
        $data->tgl_surat = $request->get('tgl_surat');
        $data->nama_pemohon = $request->get('nama_pemohon');
        $data->tempat_lahir = $request->get('tempat_lahir');
        $data->tgl_lahir = $request->get('tgl_lahir');
        $data->nik = $request->get('nik');
        $data->pekerjaan = $request->get('pekerjaan');
        $data->alamat = $request->get('alamat');
        $data->is_antar = $request->get('is_antar');
        $data->save();

        return redirect()->route('surat_index')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
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
