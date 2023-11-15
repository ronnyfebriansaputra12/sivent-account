<?php

namespace App\Http\Controllers;

use App\Models\Penyelenggara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenyelenggaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyelenggara = Penyelenggara::with('role')->get();
        if (count($penyelenggara) > 0) {
            return $this->status('Data Found', true, $penyelenggara);
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
            'nama_penyelenggara' => 'required',
            'email' => 'required|email|unique:penyelenggaras',
            'username_penyelenggara' => 'required',
            'password' => 'required',
            'contact_penyelenggara' => 'required',
            'role_id' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $data['password'] = Hash::make($request->password);

        $create = Penyelenggara::create($data);
        if ($create) {
            return $this->status('Data Created', true, $create);
        }
        return $this->status('Data doesnt created', false);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyelenggara  $penyelenggara
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penyelenggara = Penyelenggara::where('id', $id)->first();
        if (!empty($penyelenggara)) {
            return $this->status('Data Found', true, $penyelenggara);
        }
        return $this->status('Data Not Found', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyelenggara  $penyelenggara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_penyelenggara' => 'required',
            'email' => 'required',
            'username_penyelenggara' => 'required',
            'password' => 'required',
            'contact_penyelenggara' => 'required',
            'role_id' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }
        
        $data['password'] = Hash::make($request->password);

        $update = Penyelenggara::where('id', $id)->update($data);
        if ($update) {
            return $this->status('Data Updated', true, $data);
        }
        return $this->status('Data doesnt update', false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyelenggara  $penyelenggara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Penyelenggara::where('id', $request->id)->delete();
        if ($delete) {
            return $this->status('Data Deleted', true);
        }
        return $this->status('Data Doesnt Deleted', false);
    }
}
