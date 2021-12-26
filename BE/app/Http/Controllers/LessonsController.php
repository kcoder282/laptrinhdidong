<?php

namespace App\Http\Controllers;

use App\Models\lessons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return lessons::all();
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
            $lesson = new lessons();
            $lesson->name = $request->name;
            $lesson->id_type = $request->id_type;
            $lesson->id_user = $user->id;
            $img = str_replace("public/", "", $request->file("img")->store("public/lessons"));
            $lesson->img = $img;
            $name = Str::random(20).".json";
            Storage::put("public/lessons/$name", json_encode(["data" => $request->content]));
            $lesson->content = $name;
            if($lesson->save()){
                return true;
            }else
            {
                Storage::delete($img);
                Storage::delete("public/lessons/$name");
                return false;
            }
        }else return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lessons  $lessons
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = lessons::find($id);
        $lesson->content = json_decode(Storage::get('public/lessons/'.$lesson->content))->data;
        return $lesson;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lessons  $lessons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = UsersController::auth();
        if ($user) {
            $lesson = lessons::find($id);
            $lesson->name = $request->name?? $lesson->name;
            $lesson->id_type = $request->id_type?? $lesson->id_type;
            $lesson->id_user = $user->id;
            if($request->hasFile("img"))
            {
                Storage::delete('public/'.$lesson->img);
                $img = str_replace("public/", "", $request->file("img")->store("public/lessons"));
                $lesson->img = $img;
            }
            if($request->content)
            {
                $name = $lesson->content;
                Storage::put("public/lessons/$name", json_encode(["data" => $request->content]));
            }
            return $lesson->save();
        } else return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lessons  $lessons
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (UsersController::auth()) {  
            return lessons::find($id)->delete();
        } else return 0;
    }
}
