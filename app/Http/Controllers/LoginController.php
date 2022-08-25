<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => null,
                'message' => 'validation error',
                'error' => $validator->errors(),
                'code' => 422
            ], 422);
        }

        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $response = response()->json([
                'data' => Auth::user(),
                'message' => 'success',
                'code' => 200
            ], 200);
        } else {
            $response = response()->json([
                'data' => null,
                'message' => 'failed',
                'code' => 422
            ], 422);
        }

        return $response;
    }


}
