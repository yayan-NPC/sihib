<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('auth.register');
    }




    /*
    |--------------------------------------------------------------------------
    | PROCESS REGISTER
    |--------------------------------------------------------------------------
    */

    public function storeRegister(Request $request)
    {

        Log::info('========== REGISTER START ==========');



        Log::info('Data register diterima', [

            'name' => $request->name,

            'email' => $request->email

        ]);




        $data = $request->validate([

            'name'
                => 'required|string|max:255',

            'email'
                => 'required|email|unique:users',

            'password'
                => 'required|min:6|confirmed'

        ]);



        Log::info('Validasi register berhasil');





        try {


            $user = User::create([


                'name'
                    => $data['name'],


                'email'
                    => $data['email'],


                'password'
                    => Hash::make(
                        $data['password']
                    )


            ]);



            Log::info('User berhasil dibuat', [

                'id'
                    => $user->id,

                'email'
                    => $user->email

            ]);



        } catch (\Exception $e) {


            Log::error('Register gagal membuat user', [

                'error'
                    => $e->getMessage()

            ]);



            return back()

                ->withInput()

                ->with(
                    'error',
                    'Gagal membuat akun'
                );


        }



        Log::info('========== REGISTER SUCCESS ==========');



        return redirect('/login')

            ->with(

                'success',

                'Akun berhasil dibuat, silakan login'

            );


    }






    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('auth.login');
    }





    /*
    |--------------------------------------------------------------------------
    | PROCESS LOGIN
    |--------------------------------------------------------------------------
    */

    public function storeLogin(Request $request)
    {


        Log::info('========== LOGIN START ==========');



        $credentials = $request->validate([


            'email'
                => 'required|email',


            'password'
                => 'required'


        ]);



        Log::info('Percobaan login', [

            'email'
                => $credentials['email']

        ]);





        if(Auth::attempt($credentials)){



            $request->session()->regenerate();



            Log::info('Login berhasil', [

                'user_id'
                    => auth()->id()

            ]);



            return redirect('/hibah');


        }





        Log::warning('Login gagal', [

            'email'
                => $credentials['email']

        ]);




        return back()

            ->with(

                'error',

                'Email atau password salah'

            );


    }







    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {


        Log::info('User logout', [

            'user_id'
                => auth()->id()

        ]);



        Auth::logout();



        $request->session()->invalidate();



        $request->session()->regenerateToken();




        return redirect('/login');


    }


}