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
            'full_name' => ['required', 'min:3' ,'max:30'],
            'user_name' => 'required',
            'email' => 'required|email|min:10|max:50',
            'password' => ['required', 
                            'min:8', 'max:20'],
            'comfirmPass' => 'required|same:password',
            'phone' => 'required|min:11|max:15',
            'user_type' => 'required' 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Required data missing.'
            ]);
        }else{
            $email=$request->input('email');
            $username=$request->input('user_name');

            $alreadyExist=DB::table('customers')
            ->where('user_name',$username)
            ->where('email',$email)
            ->first();
            
            if($alreadyExist){
                return redirect()->back()->with([
                    'error' => true,
                    'message' => 'Username or Email Already register'
                ]);

            }else{

                $full_name=$request->input('full_name');
                $password=$request->input('password');
                $phone=$request->input('phone');
                $city=$request->input('city');
                $country=$request->input('country');
                $company_name=$request->input('company_name');
                $user_type=$request->input('user_type');


                $data=array();
                $data['full_name']=$full_name;
                $data['user_name']=$username;
                $data['email']=$email;
                $data['password']=$password;
                $data['city']=$city;
                $data['country']=$country;
                $data['phone']=$phone;
                $data['company_name']=$company_name;
                $data['user_type']=$user_type;
                $data['status']='active';

                $insert_user = DB::table('customers')->insert($data);

                if($insert_user){
                    return redirect()->back()->with([
                        'error' => false,
                        'message' => 'User Create Success Fully'
                    ]);
                }else{
                    return redirect()->back()->with([
                        'error' => true,
                        'message' => 'Something going wrong'
                    ]);
                }

                
            }
        }
    }
}
