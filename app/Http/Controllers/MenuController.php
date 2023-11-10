<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('groupMenu')->get();
        if (count($menu) > 0) {
            return $this->status('Data Found', true, $menu);
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
            'nama_menu' => 'required',
            'url' => 'required',
            'group_menu_id' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $create = Menu::create($data);
        if ($create) {
            return $this->status('Data Created', true, $data);
        }
        return $this->status('Data dosent created', false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Menu::where('id', $id)->first();
        if (empty($data)) {
            return $this->status('Data Not Found', false);
        }
        return $this->status('Data Found', true, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu, $id)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_menu' => 'required',
            'url' => 'required',
            'group_menu_id' => 'required'
        ]);

        if($validate->fails()){
            return $this->status($validate->getMessageBag()->first(),false);
        }
        
        $update = Menu::where('id',$id)->update($data);
        if($update){
            return $this->status('Data Updated',true,$data);
        }
        return $this->status('Data doesnt Update',false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Menu::where('id',$request->id)->delete();
        if($delete){
            return $this->status('Data deleted',true);
        }
        return $this->status('Data doesnt Deleted',false);
    }
}
