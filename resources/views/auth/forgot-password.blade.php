<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Lupa Password SIHIB</title>


@vite('resources/css/auth/forgot-password.css')

@vite('resources/js/app.js')


</head>



<body class="forgot-page">


@include('components.alert')



<div class="forgot-container">



    <div class="forgot-logo-box">


        <img 
        src="{{ asset('images/S.png') }}"
        alt="SIHIB">


    </div>






    <div class="forgot-title">


        <h2>
            Lupa Password?
        </h2>



        <p>
            Masukkan email akun SIHIB kamu
        </p>


    </div>







    <form method="POST" action="{{ route('password.email') }}">

    @csrf



        <div class="forgot-form-group">


            <label class="forgot-label">

                Email

            </label>



            <input
            class="forgot-input"
            type="email"
            name="email"
            placeholder="Masukkan email"
            value="{{ old('email') }}"
            required>



        </div>







        <button 
        class="forgot-submit-btn"
        type="submit">


            Reset Password


        </button>



    </form>








    <div class="forgot-back-login">


        <a href="{{ route('login') }}">

            Kembali ke Login

        </a>


    </div>





</div>




</body>


</html>