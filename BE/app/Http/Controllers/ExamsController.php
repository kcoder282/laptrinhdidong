<?php

namespace App\Http\Controllers;

use App\Models\answers;
use App\Models\exams;
use App\Models\lessons;
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
            $exam = new exams();
            $exam->question = $request->question;
            $exam->option1 = $request->option1;
            $exam->option2 = $request->option2;
            $exam->option3 = $request->option3;
            $exam->option4 = $request->option4;
            $exam->exactly = $request->exactly;
            $exam->id_lesson = $request->id_lesson;
            return $exam->save();
        } else return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\exams  $exams
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return exams::where("id_lesson", $id)->get();
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
            $exam = exams::find($id);
            $exam->question = $request->question;
            $exam->option1 = $request->option1;
            $exam->option2 = $request->option2;
            $exam->option3 = $request->option3;
            $exam->option4 = $request->option4;
            $exam->exactly = $request->exactly;
            $exam->id_lesson = $request->id_lesson;
            return $exam->save();
        } else return 0;
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
            return exams::find($id)->delete();
        } else return 0;
    }
    public function answer(Request $request)
    {
        $user = UsersController::auth();
        if($user){
            $answer = answers::where("id_exam", $request->id_exam)->where("id_user", $user->id)->first();
            $exam = exams::find($request->id_exam);
            if ($answer) {
                if (!$answer->check) {
                    $answer->option = $request->option;
                    $answer->check = ($request->option == $exam->exactly);
                    $answer->save();
                    return $answer->check;
                }else return $answer->check;
            } else {
                $answer = new answers();
                $answer->id_user = $user->id;
                $answer->id_exam = $request->id_exam;
                $answer->option = $request->option;
                $answer->check = ($request->option == $exam->exactly);
                $answer->save();
                return $answer->check;
            }
        }return false;
    }
}
