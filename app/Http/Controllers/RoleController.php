<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::with('admins')->get();
        if (count($role) > 0) {
            return $this->status('Data Found', true, $role);
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
        $data =  $request->all();
        $validate = Validator::make($data, [
            'nama_role' => 'required|unique:roles',
            'deskripsi' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $create = Role::create($data);
        if ($create) {
            return $this->status('Data Created', true, $data);
        }
        return $this->status('Data doesnt created', false);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, $id)
    {
        $data = Role::where('id', $id)->first();
        if (empty($data)) {
            return $this->status('Data Not Found', false);
        }
        return $this->status('Data Found', true, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, $id)
    {
        $data =  $request->all();
        $validate = Validator::make($data, [
            'nama_role' => 'required',
            'deskripsi' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $update = Role::where('id', $id)->update($data);
        if ($update) {
            return $this->status('Data Updated', true, $data);
        }
        return $this->status('Data doesnt updated', false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Role::where('id', $request->id)->delete();
        if ($delete) {
            return $this->status('Data Deleted', true);
        }
        return $this->status('Data doesnt deleted', false);
    }
}
