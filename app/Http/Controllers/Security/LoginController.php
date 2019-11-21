<?php

namespace App\Http\Controllers\Security;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Sentinel;
use Validator;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class LoginController extends Controller
{
    public function login() {
        return view('security.login');
    }

    public function postLogin(Request $request) {
        Sentinel::disableCheckpoints();

        $errorMsgs = [
            'email.required' => 'Please provide an email',
            'email.email' => 'Please provide a valid email address',
            'password.required' => 'Password is required'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], $errorMsgs);

        if ($validator->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Please review fields',
                'errors' => $validator->errors()->all()
            );

            return response()->json($returnData, 500);
        }

        try {
            $user = Sentinel::authenticate($request->all());
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $returnData = array(
                'status' => 'error',
                'message' => 'Please review',
                'errors' => ["You are banned for $delay seconds"]
            );

            return response()->json($returnData, 500);

        } catch (NotActivatedException $e) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Please review',
                'errors' => ["Go and activate your account"]
            );

            return response()->json($returnData, 500);
        }

        if (Sentinel::check()) {

            if (Sentinel::getUser()->roles->first()->name == 'Employee') {
                return redirect(url('/employee'));
            } else if (Sentinel::getUser()->roles->first()->name == 'Line Manager') {
                return redirect(url('/line-manager'));
            }

        } else {
            $returnData = array(
                'status' => 'error',
                'message' => 'Please review',
                'errors' => ["Email and password is mismatched"]
            );

            return response()->json($returnData, 500);
        }
    }

    public function logout() {
        Sentinel::logout();
        return redirect(url('/'));
    }
}
