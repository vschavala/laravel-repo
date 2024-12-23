<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    
    public function store(Request $request){

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            // successfull authentication
            $user = User::find(Auth::user()->id);

            $user_token['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
                'success' => true,
                'token' => $user_token,
                'user' => $user,
            ], 200);
        } else {
            // failure to authenticate
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate.',
            ], 401);
        }
    }

    public function destroy(Request $request){
        // dd(Auth::user());
        if(Auth::user()){
            $request->user()->token()->revoke();
            return response()->json([
                'success' => true,
                'message' => 'Loggedout successfully'
            ],200);
        }
    }
}
