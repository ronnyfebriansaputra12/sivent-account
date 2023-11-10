<?php

namespace App\Http\Controllers;

use App\Models\GroupMenu;
use Illuminate\Http\Middleware\TrustHosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupMenu = GroupMenu::with('menu')->get();
        // $groupMenu = GroupMenu::all();
        
        if (count($groupMenu) > 0) {
            return $this->status('Data Group Menu', true, $groupMenu);
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
            'nama_group_menu' => 'required',
            'deskripsi' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $create = GroupMenu::create($data);
        if ($create) {
            return $this->status('Data Created', true, $data);
        }
        return $this->status('Data doesnt created', false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupMenu  $groupMenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = GroupMenu::where('id',$id)->first();
        if(empty($data)){
            return $this->status('Data Not Found',false);
        }
        return $this->status('Data Found',true,$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupMenu  $groupMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupMenu $groupMenu,$id)
    {
        $data = $request->all();
        $validate = Validator::make($data,[
            'nama_group_menu' => 'required',
            'deskripsi' => 'required'
        ]);

        if($validate->fails()){
            return $this->status($validate->getMessageBag()->first(),false);
        }

        $update = GroupMenu::where('id',$id)->update($data);

        if($update){
            return $this->status('Data updated',true,$data);
        }
        return $this->status('Data doesnt update',false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupMenu  $groupMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = GroupMenu::where('id',$request->id)->delete();
        if($delete){
            return $this->status('Data deleted', true);
        }
        return $this->status('Data doesent Deleted',false);
    }
}
