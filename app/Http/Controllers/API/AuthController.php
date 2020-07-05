<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        
        if($validator->fails()) 
            return $this->sendError('Validation Error.', $validator->errors());

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $success['token'] = $user->createToken('product-kit')->accessToken;
        $success['user'] = $user;

        $success_code = 201;

        return $this->sendResponse($success, 'User register successfully', $success_code);
    }

    public function login(Request $request) {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('product-kit')->accessToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'User login successfully');
        }

        return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
    }
}
