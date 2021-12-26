<?php

namespace App\Http\Controllers;

use App\Models\types;
use Illuminate\Http\Request;

class typesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return types::all();
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
            $type = new types();
            $type->name = $request->name;
            return $type->save();
        } else
            return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\types  $types
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return types::find($id);
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
            $type = types::find($id);
            $type->name = $request->name;
            return $type->save();
        } else return false;
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
            return types::find($id)->delete();
        } else return 0;
    }
}
