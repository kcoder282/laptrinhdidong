<?php

namespace App\Http\Controllers;

use App\Models\files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = UsersController::auth();
        if ($user) {
            return files::where("id_user", $user->id)->get();
        }
        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = UsersController::auth();
        if ($user) {
            if (Storage::disk("code")->exists($request->name)) {
                $file = files::where("name", $request->name)->first();
            } else
                $file = new files();

            $file->name = $request->name;
            Storage::put('code/' . $request->name, $request->code);
            $file->public = $request->public ?? false;
            $file->description = $request->description ?? "";
            $file->id_user = $user->id;
            if ($file->save())
                return files::compile($request->code) ?? files::RunCode($request->input ?? "");
            else {
                Storage::delete('code/' . $request->name);
                return "error";
            }
        } else return "error";
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
        // if (UsersController::auth()) {
        //     $file = files::find($id);
        //     $file->name = $request->username;
        //     $file->code = $request->code;
        //     $file->public = $request->public;
        //     $file->description = $request->description;
        //     $file->id_user = $request->id_user;
        //     return $file->save();
        // } else return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UsersController::auth();
        $file = files::find($id);
        if ($user && $file) {
            if ($user->id == $file->id_user) {
                Storage::delete('code/' . $file->name);
                return $file->delete();
            } else return false;
        } else return 0;
    }
}
