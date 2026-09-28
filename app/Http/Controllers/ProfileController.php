<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class ProfileController extends Controller
{


    public function index()
    {

        return view('profile.index');

    }





   public function update(Request $request)
{

    $user = auth()->user();



    $request->validate([

        'name' => 'required',

        'email' => 'required|email',

        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

    ]);





    if($request->hasFile('photo')){


        $file = $request->file('photo');


        $filename = time()
            .'.'
            .$file->getClientOriginalExtension();



        $file->storeAs(
            'profile',
            $filename,
            'public'
        );



        $user->photo = $filename;


    }






    $user->name = $request->name;

    $user->email = $request->email;


    $user->save();






    return back()->with(

        'success',

        'Profil berhasil diperbarui'

    );


}



    public function updatePassword(Request $request)
    {


        $request->validate([

            'old_password'=>'required',

            'password'=>'required|min:8|confirmed'

        ]);



        $user = auth()->user();




        if(!Hash::check(
            $request->old_password,
            $user->password
        )){


            return back()->with(
                'error',
                'Password lama tidak sesuai'
            );

        }





        $user->update([

            'password'=>Hash::make(
                $request->password
            )

        ]);




        return back()->with(
            'success',
            'Password berhasil diperbarui'
        );


    }


}