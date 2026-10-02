<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{


    public function show()
    {
        return view('auth.forgot-password');
    }



    // cek email
    public function send(Request $request)
    {

        $request->validate([

            'email'=>'required|email'

        ]);



        $user = User::where(
            'email',
            $request->email
        )->first();



        if(!$user){

            return back()->with(
                'error',
                'Email tidak ditemukan'
            );

        }



        session([
            'email'=>$user->email
        ]);


        return redirect()
            ->route('password.reset.form');

    }





    // tampil form reset
    public function resetForm(Request $request)
    {

        return view(
            'auth.reset-password',
            [
                'email'=>$request->email
            ]
        );

    }






    // update password
    public function update(Request $request)
    {


        $request->validate([

            'email'=>'required|email',

            'password'=>'required|min:6|confirmed'

        ]);



        $user = User::where(
            'email',
            $request->email
        )->first();



        if(!$user){

            return back()->with(
                'error',
                'Email tidak ditemukan'
            );

        }



        $user->update([

            'password'=>Hash::make(
                $request->password
            )

        ]);



        return redirect('/login')
            ->with(
                'success',
                'Password berhasil diperbarui, silakan login'
            );

    }


}