<?php

namespace App\Http\Controllers;

use App\Models\files;
use Illuminate\Http\Request;

class FilesController extends Controller
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
            $file = new Files();
            $file->name = $request->username;
            $file->code = $request->code;
            $file->public = $request->public;
            $file->description = $request->description;
            $file->id_user = $request->id_user;
            return ["result" => $file->save()];
        } else return ["result" => -1];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\files  $files
     * @return \Illuminate\Http\Response
     */
    public function show(files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\files  $files
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (UsersController::auth()) {
            $file = Files::find($id);
            $file->name = $request->username;
            $file->code = $request->code;
            $file->public = $request->public;
            $file->description = $request->description;
            $file->id_user = $request->id_user;
            return ["result" => $file->save()];
        } else return ["result" => -1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (UsersController::auth()) {
            Files::find($id)->delete();
        } else return ["result" => -1];
    }
}
