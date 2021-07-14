<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use \Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * index function return all users data
     */
    public function index ()
    {
        $users = User::all();

        $users->toArray();
        return $users;
    }

    public function email($email) {
        $email = User::where('email',$email)->get();

        if($email->count() == 0){
            $email = ["response" => "Result not found"];
        }

        return $email;
    }

    public function add (Request $request)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($valid->fails()){
            return response($valid->errors(),401);
        }

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $user;

    }

    public function register(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:12',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return response($validator->errors(),401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        if($user) {
            $arr = [];
            $arr['token'] = $user->createToken('Api-token')->accessToken;
            $arr['name'] = $user->name;

            return response($arr,200);
        }
    }

    public function login (Request $request) {

       $valid = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:7'
        ]);

        if($valid->fails()){
            return response($valid->errors(),401);
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/');

        }else{
            return response(['error' => 'unAuthorized access']);
        }
    }

    public function delete ($id) {
        try{

            $user = User::findOrFail($id)->delete();

            if($user) {
                $mesage = ["status" => "success"];
            }

            return $mesage;

        }catch (\Exception $e) {
            return  ['status' => 'Error'];
        }
    }
}
