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

            'email' => 'required|email'

        ]);



        $user = User::where(
            'email',
            $request->email
        )->first();



        // jika email tidak ditemukan
        if(!$user){

            return back()->with(
                'error',
                'Email tidak ditemukan'
            );

        }



        // simpan email untuk reset password
        session([
            'email' => $user->email
        ]);



        // email ditemukan
        return redirect()
            ->route('password.reset.form')
            ->with(
                'success',
                'Akun ditemukan. Silakan buat password baru.'
            );

    }







    // tampil form reset password
    public function resetForm()
    {

        return view(
            'auth.reset-password',
            [
                'email' => session('email')
            ]
        );

    }








    // update password
    public function update(Request $request)
    {


        $request->validate([

            'email' => 'required|email',

            'password' => 'required|min:6|confirmed'

        ]);



        $user = User::where(
            'email',
            $request->email
        )->first();



        // jika email tidak ditemukan
        if(!$user){

            return back()->with(
                'error',
                'Email tidak ditemukan'
            );

        }





        $user->update([

            'password' => Hash::make(
                $request->password
            )

        ]);





        // hapus session email
        session()->forget('email');





        return redirect('/login')
            ->with(
                'success',
                'Password berhasil diperbarui, silakan login'
            );

    }


}