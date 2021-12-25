<?php

namespace App\Http\Controllers;

use App\Models\lessons;
use Illuminate\Http\Request;

class LessonsController extends Controller
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
            $lesson = new Lessons();
            $lesson->name = $request->lessonname;
            $lesson->img = $request->img;
            $lesson->content = $request->content;
            $lesson->view = $request->view;
            $lesson->id_user = $request->id_user;
            return ["result"=>$lesson->save()];
        }else return ["result"=> -1];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lessons  $lessons
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
     * @param  \App\Models\lessons  $lessons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (UsersController::auth()) {  
            $lesson = Lessons::find($id);
            $lesson->name = $request->lessonname;
            $lesson->img = $request->img;
            $lesson->content = $request->content;
            $lesson->view = $request->view; 
            $lesson->id_user = $request->id_user;
            return ["result"=>$lesson->save()];
        } else return ["result" => -1];
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
            Lessons::find($id)->delete();
        } else return ["result" => -1];
    }
}
