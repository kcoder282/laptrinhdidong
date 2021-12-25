<?php

namespace App\Http\Controllers;

use App\Models\exams;
use Illuminate\Http\Request;

class ExamsController extends Controller
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
            $exam = new Exams();
            $exam->question = $request->question;
            $exam->option1 = $request->option1;
            $exam->option2 = $request->option2;
            $exam->option3 = $request->option3;
            $exam->option4 = $request->option4;
            $exam->exactly = $request->exactly;
            $exam->id_user = $request->id_user;
            $exam->id_type = $request->id_type;
            return ["result" => $exam->save()];
        } else return ["result" => -1];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\exams  $exams
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
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (UsersController::auth()) {
            $exam = Exams::find($id);
            $exam->question = $request->question;
            $exam->option1 = $request->option1;
            $exam->option2 = $request->option2;
            $exam->option3 = $request->option3;
            $exam->option4 = $request->option4;
            $exam->exactly = $request->exactly;
            $exam->id_user = $request->id_user;
            $exam->id_type = $request->id_type;
            return ["result" => $exam->save()];
        } else return ["result" => -1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (UsersController::auth()) {
            Exams::find($id)->delete();
        } else return ["result" => -1];
    }
}
