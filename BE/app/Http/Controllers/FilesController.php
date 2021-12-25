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
        $file = new File();
        $file->name = $request->username;
        $file->code = $request->code;
        $file->public = $request->public;
        $file->description = $request->description;
        $file->id_user = $request->id_user;
        
        return ["result"=>$file->save()];
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
    public function update(Request $request, files $files)
    {
        $file = File::find($id);
        $file->name = $request->username;
        $file->code = $request->code;
        $file->public = $request->public;
        $file->description = $request->description;
        $file->id_user = $request->id_user;
        
        return ["result"=>$file->save()];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(files $files)
    {
       File::find($id)->delete();
    }
}
