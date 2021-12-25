<?php

namespace App\Http\Controllers;

use App\Models\types;
use Illuminate\Http\Request;

class TypesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (UsersController::auth()) {    
            $type = new Types();
            $type->name = $request->typename;
            return ["result"=>$type->save()];
        }
        else
            return ["result"=> -1];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\types  $types
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\types  $types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (UsersController::auth()) {
            $type = Types::find($id);
            $type->name = $request->typename;
            return ["result" => $type->save()];
        }else return ["result" => -1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\types  $types
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (UsersController::auth()) {
            Types::find($id)->delete();
        }else return ['result'=>-1];
    }
}
