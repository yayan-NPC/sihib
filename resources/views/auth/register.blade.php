<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register SIHIB</title>


@vite('resources/css/auth/register.css')


</head>


<body class="register-page">


<div class="register-container">



    <!-- LEFT -->

    <div class="register-left">


        <div class="register-left-content">


            <div class="register-logo-box">

                S

            </div>



            <h1>
                SIHIB
            </h1>



            <p>
                Sistem Informasi Hibah Barang
                <br>
                Dana APBD & APBN Bidang Sarana dan Prasarana
            </p>



            <p>
                Buat akun untuk mengelola data hibah
                <br>
                secara mudah dan terstruktur
            </p>


        </div>


    </div>





    <!-- RIGHT -->

    <div class="register-right">



        <div class="register-box">



            <div class="register-title">



                <div class="register-icon">


                    <img 
                    src="{{ asset('images/S.png') }}"
                    alt="SIHIB"
                    >


                </div>




                <h2>
                    Buat Akun Baru
                </h2>



                <p>
                    Daftar untuk mengakses SIHIB
                </p>


            </div>






            <form method="POST" action="/register">

            @csrf




                <div class="register-form-group">


                    <label class="register-label">

                        Nama

                    </label>



                    <input
                    class="register-input"
                    type="text"
                    name="name"
                    placeholder="Masukkan nama"
                    required>


                </div>






                <div class="register-form-group">


                    <label class="register-label">

                        Email

                    </label>



                    <input
                    class="register-input"
                    type="email"
                    name="email"
                    placeholder="Masukkan email"
                    required>


                </div>






                <div class="register-form-group">


                    <label class="register-label">

                        Password

                    </label>



                    <input
                    class="register-input"
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required>


                </div>







                <div class="register-form-group">


                    <label class="register-label">

                        Konfirmasi Password

                    </label>



                    <input
                    class="register-input"
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required>


                </div>






                <button 
                class="register-btn"
                type="submit">

                    Daftar

                </button>




            </form>







            <div class="register-bottom">


                Sudah punya akun?


                <a href="/login">

                    Login

                </a>


            </div>




        </div>


    </div>



</div>



</body>

</html> 