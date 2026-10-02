<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reset Password SIHIB</title>

@vite('resources/css/auth/forgot-password.css')

</head>


<body class="forgot-page">


<div class="forgot-container">


    <div class="forgot-logo-box">

        <img 
        src="{{ asset('images/S.png') }}"
        alt="SIHIB">

    </div>



    <div class="forgot-title">

        <h2>
            Buat Password Baru
        </h2>


        <p>
            Masukkan password baru akun SIHIB
        </p>

    </div>




    <form method="POST" action="{{ route('password.update') }}">

    @csrf


        <input 
        type="hidden"
        name="email"
        value="{{ session('email') ?? request('email') }}">



        <div class="forgot-form-group">


            <label class="forgot-label">
                Password Baru
            </label>


            <input

            class="forgot-input"

            type="password"

            name="password"

            placeholder="Masukkan password baru"

            required>


        </div>





        <div class="forgot-form-group">


            <label class="forgot-label">
                Konfirmasi Password
            </label>


            <input

            class="forgot-input"

            type="password"

            name="password_confirmation"

            placeholder="Ulangi password baru"

            required>


        </div>





        <button 
        class="forgot-submit-btn"
        type="submit">


            Simpan Password


        </button>



    </form>





    <div class="forgot-back-login">

        <a href="/login">
            Kembali ke Login
        </a>

    </div>



</div>



</body>

</html>