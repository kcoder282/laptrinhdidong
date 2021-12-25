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
        $exam = new Exam();
        $exam->question = $request->question;
        $exam->option1 = $request->option1;
        $exam->option2 = $request->option2;
        $exam->option3 = $request->option3;
        $exam->option4 = $request->option4;
        $exam->exactly = $request->exactly;
        $exam->id_user = $request->id_user;
        $exam->id_type = $request->id_type;
        return ["result"=>$exam->save()];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function show(exams $exams)
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
    public function update(Request $request, exams $exams)
    {
        $exam = Exam::find($id);
        $exam->question = $request->question;
        $exam->option1 = $request->option1;
        $exam->option2 = $request->option2;
        $exam->option3 = $request->option3;
        $exam->option4 = $request->option4;
        $exam->exactly = $request->exactly;
        $exam->id_user = $request->id_user;
        $exam->id_type = $request->id_type;
        return ["result"=>$exam->save()];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function destroy(exams $exams)
    {
       Exam::find($id)->delete();
    }
}
