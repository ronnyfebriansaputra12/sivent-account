<?php

namespace App\Http\Controllers;

use App\Models\Privilage;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivilageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privilage = Privilage::with('role', 'menu')->get();
        if (count($privilage) > 0) {
            return $this->status('Data Found', true, $privilage);
        }
        return $this->status('Data not found', false);
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
            'role_id' => 'required',
            'menu_id' => 'required',
            'view' => 'required',
            'add' => 'required',
            'edit' => 'required',
            'delete' => 'required',
            'other' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $create = Privilage::create($data);
        if ($create) {
            return $this->status('Data Created', true, $data);
        }
        return $this->status('Data doesnt created', false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privilage  $privilage
     * @return \Illuminate\Http\Response
     */
    public function edit(Privilage $privilage, $id)
    {
        $privilage = Privilage::where('id', $id)->first();
        if (!empty($privilage)) {
            return $this->status('Data Found', true, $privilage);
        }
        return $this->status('Data not found', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Privilage  $privilage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privilage $privilage, $id)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'role_id' => 'required',
            'menu_id' => 'required',
            'view' => 'required',
            'add' => 'required',
            'edit' => 'required',
            'delete' => 'required',
            'other' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $update = Privilage::where('id', $id)->update($data);
        if ($update) {
            return $this->status('Data Updated', true, $data);
        }
        return $this->status('Data doesnt update', false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Privilage  $privilage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Privilage::where('id', $request->id)->delete();
        if ($delete) {
            return $this->status('Data Deleted', true);
        }
        return $this->status('Data doesnt deleted', false);
    }
}
