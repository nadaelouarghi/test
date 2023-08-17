<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request){
        $incomingFields=$request->validate([
            'loginname'=>'required',
            'loginpassword'=>'required'
        ]);
        if(auth()->attempt(['name'=>$incomingFields['loginname'],'password'=>$incomingFields['loginpassword']])){
            $request->session()->regenerate(); //generating a session
        }
        return redirect('/');
    }


    public function logout(){
        auth()->logout();
        return redirect('/');
    }


    public function register(Request $request){ //register is the name of the function
        $incomingFields=$request->validate([
            'name'=>['required','min:3',Rule::unique('users','name')],
            'email'=>['required','email',Rule::unique('users','email')], //in the users table the email field must be unique
            'password'=>'required'
        ]);

        $incomingFields['password']=bcrypt($incomingFields['password']);

        $user=User::create($incomingFields);
        auth()->login($user);
        return redirect('/');
    }
}
