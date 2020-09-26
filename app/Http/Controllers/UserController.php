<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){

        $body= [
                'grant_type'=> 'password',
                'client_id'=> 2,
                'client_secret'=> 'DeAa1TytPiqPipVAzUEvyQryJqx78v5gsWOgEhcG',
                'username'=>$request->username,
                'password'=>$request->password
                ];
        
        $http= new \GuzzleHttp\Client;
        try {
           $response= $http->request('POST','http://localhost/todos/public/oauth/token',[
               'json'=>[
                    'grant_type' => 'password',
                    'client_id'=> 2,
                    'client_secret'=> 'BVZx8Gz6LS6TSf6nFK8V5Ig0hKUeXKBGJv9EkGtx',
                    'username'=>$request->username,
                    'password'=>$request->password
               ]
           ]);

            return $response;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode()===400) {
                return response()->json('Request is not valid, Please enter a username and password'. $e->getResponse()->getBody(true), $e->getCode());
            }
            else if ($e->getCode()===401) {
                return response()->json('your credentials are not correct, Please enter a  valid username and password', $e->getCode());
            }
            else {
                return response()->json('server problem', $e->getCode());
            }
        }

        


    }
    public function register(Request $request){
        $request->validate([
            'email'=>'required|unique:users',
            'name'=>'required',
            'password'=>'required'
        ]);

        return User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=> Hash::make($request->password)
        ]);
        
        
    }
    public function logout(){
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json('loggred out', 200);
        
        
    }
}
