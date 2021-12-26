<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_REQUEST["key"])) {
            $user = User::where("remember_token", $_REQUEST["key"])->first();
            if($user) return $user;
            else return ["id" => -1];
        } else ["id" => -1];
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
        return $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        if($request->key)
        {
            $user = User::find($id);
            if($user->remember_token === $request->key)
            {
                $user->name = $request->username;
                $user->fullname = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->bird = $request->bird;
                $user->sex = $request->sex;
                return $user->save();
            }else return 0;
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(self::auth())
            User::find($id)->delete();
        else return 0;
    }

    public function Login(Request $request)
    {
        if(Auth::attempt(["name"=>$request->username, "password" => $request->password]))
        {
            $user = User::find(Auth::id());
            $user->remember_token = Str::random(30);
            $user->save();
            return $user;
        }
        else return 0;
    }
    public function Logout($id)
    {

    }
    public static function auth()
    {
        if(isset($_REQUEST["key"]))
        {
            return User::where("remember_token", $_REQUEST["key"])->first();
        }else false;
    }
}
