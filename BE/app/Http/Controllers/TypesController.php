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
        $type = new Type();
        $type->name = $request->typename;
        
        return ["result"=>$type->save()];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\types  $types
     * @return \Illuminate\Http\Response
     */
    public function show(types $types)
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
    public function update(Request $request, types $types)
    {
        $type = Type::find($id);
        $type->name = $request->typename;
        
        return ["result" => $type->save()];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\types  $types
     * @return \Illuminate\Http\Response
     */
    public function destroy(types $types)
    {
         Type::find($id)->delete();
    }
}
