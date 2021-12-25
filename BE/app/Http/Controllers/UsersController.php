<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->username;
        $user->fullname = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->bird = $request->bird;
        $user->sex = $request->sex;
        return ["result"=>$user->save()];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->username;
        $user->fullname = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->bird = $request->bird;
        $user->sex = $request->sex;
        return ["result" => $user->save()];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }

    public function Login(Request $request)
    {
        if(Auth::attempt(["name"=>$request->username, "password" => $request->password]))
        {
            return Auth::user();
        }
        else return ["result"=>false];
    }
    public function Logout($id)
    {

    }
    public static function auth()
    {
        return true;
    }
}
