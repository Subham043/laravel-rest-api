<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create(Request $req){
        $rules = array(
            "name" => "required|min:3|max:10",
            "email" => "required",
            "password" => "required|min:5",
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $result = $user->save();
            if($result){
                return [
                    "success" => "Operation Succesful"
                ];
            }else{
                return [
                    "error" => "Operation Failed"
                ];
            }
        }
    }

    function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
            $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }
}
