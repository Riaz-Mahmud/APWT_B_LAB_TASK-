<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Validator;

class SigninController extends Controller
{
    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => [
                'required',
                'string',
                'min:8', 
                'max:20',
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
                'regex:/[@$!%*#?&]/', 
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Required data missing.'
            ]);
        }else{
            $email=$request->input('email');
            $password=$request->input('password');

            $user=DB::table('customers')
            ->where('email',$email)
            ->where('status',"active")
            ->first();
            
            if($user){

                if($user->password == $password){


                    $request->session()->put('username', $user->user_name);
                    $request->session()->put('fullname', $user->full_name);
                    $request->session()->put('userType', $user->user_type);

                    return redirect('/customer/home');
                }else{
                    return redirect()->back()->with([
                        'error' => true,
                        'message' => 'user email or password not matched'
                    ]);
                }

            }else{
                return redirect()->back()->with([
                    'error' => true,
                    'message' => 'user Not found!'
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/login');
    }
}
