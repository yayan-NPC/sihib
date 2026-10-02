<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    DashboardController,
    HibahController,
    HibahAPBDController,
    HibahAPBNController,
    ProfileController,
    SettingController,
    LaporanController,
    AuthController
};


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {

    return view('auth.login');

})->name('login');



Route::post('/login', function () {

    $credentials = request()->only(
        'email',
        'password'
    );


    if (auth()->attempt($credentials)) {

        request()
            ->session()
            ->regenerate();


        return redirect('/')
            ->with(
                'success',
                'Login berhasil. Selamat datang di SIHIB'
            );

    }


    return back()
        ->withInput(
            request()->only('email')
        )
        ->with(
            'error',
            'Email atau password salah'
        );


})->name('login.process');



/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get(
    '/register',
    [AuthController::class,'register']
)->name('register');


Route::post(
    '/register',
    [AuthController::class,'storeRegister']
);


use App\Http\Controllers\Auth\ForgotPasswordController;


/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/


Route::get(
    '/forgot-password',
    [ForgotPasswordController::class,'show']
)->name('password.request');



Route::post(
    '/forgot-password',
    [ForgotPasswordController::class,'send']
)->name('password.email');



Route::get(
    '/reset-password-form',
    [ForgotPasswordController::class,'resetForm']
)->name('password.reset.form');



Route::post(
    '/reset-password',
    [ForgotPasswordController::class,'update']
)->name('password.update');

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {


    auth()->logout();


    request()
        ->session()
        ->invalidate();


    request()
        ->session()
        ->regenerateToken();


    return redirect('/login');


})->name('logout');





/*
|--------------------------------------------------------------------------
| SIHIB SYSTEM
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {



    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/',
        [DashboardController::class,'index']
    )->name('dashboard');





    /*
    |--------------------------------------------------------------------------
    | HALAMAN DATA HIBAH
    |--------------------------------------------------------------------------
    */


    Route::get('/hibah', function () {

        return view('hibah.index');

    })->name('hibah.index');






    /*
    |--------------------------------------------------------------------------
    | HIBAH APBD & APBN
    |--------------------------------------------------------------------------
    */


    Route::prefix('hibah')
        ->name('hibah.')
        ->group(function () {



            /*
            | AJAX APBD
            */

            Route::get(
                '/apbd/data',
                [HibahAPBDController::class,'ajaxData']
            )->name('apbd.data');




            /*
            | AJAX APBN
            */

            Route::get(
                '/apbn/data',
                [HibahAPBNController::class,'ajaxData']
            )->name('apbn.data');






            /*
            | CRUD APBD
            */

            Route::resource(
                'apbd',
                HibahAPBDController::class
            )->parameters([

                'apbd'=>'hibahAPBD'

            ]);







            /*
            | CRUD APBN
            */

            Route::resource(
                'apbn',
                HibahAPBNController::class
            )->parameters([

                'apbn'=>'hibahAPBN'

            ]);



        });








    /*
    |--------------------------------------------------------------------------
    | HIBAH LAMA
    |--------------------------------------------------------------------------
    */


    Route::resource(
        'hibah-lama',
        HibahController::class
    );







    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */


    Route::prefix('laporan')
        ->name('laporan.')
        ->group(function () {



            Route::get(
                '/tahunan',
                [LaporanController::class,'tahunan']
            )->name('tahunan');



            Route::get(
                '/tahunan/{tahun}',
                [LaporanController::class,'detailTahunan']
            )->name('tahunan.detail');



            Route::get(
                '/excel',
                [LaporanController::class,'excelPage']
            )->name('excel');



            Route::get(
                '/excel/download/{sumber}',
                [LaporanController::class,'excel']
            )->name('excel.download');



            Route::get(
                '/word',
                [LaporanController::class,'wordPage']
            )->name('word');



            Route::get(
                '/word/download/{sumber}',
                [LaporanController::class,'word']
            )->name('word.download');


        });







    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/profile',
        [ProfileController::class,'index']
    )->name('profile');



    Route::put(
        '/profile/update',
        [ProfileController::class,'update']
    )->name('profile.update');



    Route::put(
        '/profile/password',
        [ProfileController::class,'updatePassword']
    )->name('profile.password');








    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/settings',
        [SettingController::class,'index']
    )->name('settings');



});