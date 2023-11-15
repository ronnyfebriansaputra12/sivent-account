<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengunjung = Pengunjung::all();
        if (count($pengunjung) > 0) {
            return $this->status('Data Found', true, $pengunjung);
        }
        return $this->status('Data Not Found', false);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_pengunjung' => 'required',
            'email' => 'required|email',
            'username_pengunjung' => 'required',
            'password' => 'required',
            'contact_pengunjung' => 'required',
            'role_id' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }
        $data['password'] = Hash::make($request->password);

        $create = Pengunjung::create($data);
        if ($create) {
            return $this->status('Data Created', true, $data);
        }
        return $this->status('Data doenst created', false);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengunjung = Pengunjung::where('id', $id)->get();
        if (!empty($pengunjung)) {
            return $this->status('Data Found', true, $pengunjung);
        }
        return $this->status('Data Not Found', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengunjung $pengunjung, $id)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_pengunjung' => 'required',
            'email' => 'required|email',
            'username_pengunjung' => 'required',
            'password' => 'required',
            'contact_pengunjung' => 'required',
            'role_id' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $data['password'] = Hash::make($request->password);

        $update = Pengunjung::where('id', $id)->update($data);
        if ($update) {
            return $this->status('Data Created', true, $data);
        }
        return $this->status('Data doesnt update', false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengunjung  $pengunjung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Pengunjung::where('id', $request->id)->delete();
        if ($delete) {
            return $this->status('Data Deleted', true);
        }
        return $this->status('Data doesnt delete', false);
    }
}
