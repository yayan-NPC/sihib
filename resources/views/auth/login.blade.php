<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login SIHIB</title>


<style>

:root{
    --primary:#2E8B57;
    --hover:#236B43;
    --light:#EAF6EF;
    --background:#F4F7F5;
}


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Inter", Arial, sans-serif;
}


body{

    min-height:100vh;

    background:var(--background);

    display:flex;

    justify-content:center;

    align-items:center;

}



/* =====================
   MAIN CARD
===================== */


.container{

    width:1100px;

    height:650px;

    display:flex;

    background:#ffffff;

    border-radius:32px;

    overflow:hidden;

    box-shadow:
    0 25px 70px rgba(0,0,0,.18);

}



/* =====================
   LEFT PANEL
===================== */


.left{

    width:60%;

    background:var(--primary);

    color:white;

    display:flex;

    justify-content:center;

    align-items:center;

    position:relative;

    overflow:hidden;

}



/* =====================
   BUBBLE ANIMATION
===================== */


@keyframes waterFloat{

    0%,
    100%{

        transform:
        translate(0,0)
        scale(1);

    }


    50%{

        transform:
        translate(25px,-35px)
        scale(1.1);

    }

}



@keyframes waterMove{

    0%,
    100%{

        transform:
        translateY(0);

    }


    50%{

        transform:
        translateY(40px);

    }

}




.bubble{

    position:absolute;

    border-radius:50%;

    background:
    rgba(255,255,255,.08);

    backdrop-filter:blur(3px);

}



.bubble1{

    width:220px;

    height:220px;

    top:-60px;

    left:80px;

    animation:
    waterFloat 12s infinite ease-in-out;

}



.bubble2{

    width:130px;

    height:130px;

    bottom:100px;

    left:120px;

    animation:
    waterMove 8s infinite ease-in-out;

}



.bubble3{

    width:340px;

    height:340px;

    right:-120px;

    bottom:-150px;

    animation:
    waterFloat 15s infinite ease-in-out;

}



.bubble4{

    width:90px;

    height:90px;

    top:100px;

    right:120px;

    animation:
    waterMove 7s infinite ease-in-out;

}



/* LEFT CONTENT */


.left-content{

    width:70%;

    text-align:center;

    position:relative;

    z-index:5;

}



.logo-box{

    width:100px;

    height:100px;

    background:#ffffff;

    border-radius:50%;

    margin:auto;

    display:flex;

    justify-content:center;

    align-items:center;

    color:var(--primary);

    font-size:45px;

    font-weight:bold;

}



.left h1{

    margin-top:35px;

    font-size:42px;

}



.left p{

    margin-top:18px;

    line-height:1.7;

    font-size:16px;

}



/* =====================
   RIGHT LOGIN
===================== */


.right{

    width:40%;

    display:flex;

    justify-content:center;

    align-items:center;

    background:#ffffff;

}



.login-box{

    width:330px;

}



/* TITLE */


.title{

    text-align:center;

    margin-bottom:35px;

}



.icon{

    width:75px;

    height:75px;

    background:var(--light);

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    margin:auto;

    overflow:hidden;

}



.icon img{

    width:55px;

    height:55px;

    object-fit:contain;

}



.title h2{

    margin-top:20px;

    color:#222;

}



.title p{

    margin-top:8px;

    color:#888;

    font-size:14px;

}



/* FORM */


.form-group{

    margin-bottom:12px;

}



label{

    font-size:14px;

    color:#444;

}



input{

    width:100%;

    padding:14px;

    margin-top:8px;

    border:1px solid #ddd;

    border-radius:14px;

    outline:none;

}



input:focus{

    border-color:var(--primary);

    box-shadow:

    0 0 0 3px rgba(46,139,87,.15);

}

/* PASSWORD TOGGLE */

.password-wrapper{

    position:relative;

}


.password-wrapper input{

    padding-right:50px;

}


.toggle-password{

    position:absolute;

    right:15px;

    top:50%;

    transform:translateY(-50%);

    background:none;

    border:none;

    padding:0;

    cursor:pointer;

    color:#999;

    display:flex;

    align-items:center;

    justify-content:center;

}


.toggle-password svg{

    width:22px;

    height:22px;

}


.toggle-password:hover{

    color:var(--primary);

}





/* REMEMBER */


.remember{

    display:flex;

    justify-content:space-between;

    align-items:center;

    width:100%;

    margin-top:8px;

    margin-bottom:20px;

    font-size:14px;

}


.remember label{

    display:flex;

    align-items:center;

    gap:6px;

    margin:0;

}


.remember input{

    width:16px;

    height:16px;

    margin:0;

}


.remember a{

    color:var(--primary);

    text-decoration:none;

    line-height:16px;

}


/* BUTTON */


.login-btn{

    width:100%;

    padding:15px;

    border:none;

    border-radius:14px;

    background:var(--primary);

    color:white;

    font-size:16px;

    cursor:pointer;

}



.login-btn:hover{

    background:var(--hover);

}



/* FOOTER */


.bottom{

    text-align:center;

    margin-top:25px;

    color:#777;

    font-size:13px;

}

/* =====================
   POPUP NOTIFICATION
===================== */


.alert-popup{

    position:fixed;

    top:30px;

    left:50%;

    transform:translateX(-50%);

    min-width:350px;

    padding:18px 25px;

    border-radius:16px;

    color:white;

    display:flex;

    justify-content:center;

    align-items:center;

    gap:12px;

    text-align:center;

    font-size:15px;

    font-weight:500;

    box-shadow:
    0 15px 40px rgba(0,0,0,.18);

    animation:
    popupShow .4s ease;

    z-index:9999;

}



.alert-success{

    background:#2E8B57;

}



.alert-error{

    background:#DC3545;

}



.alert-icon{

    font-size:22px;

}




@keyframes popupShow{

    from{

        opacity:0;

        transform:
        translate(-50%,-30px);

    }


    to{

        opacity:1;

        transform:
        translate(-50%,0);

    }

}


.fade-out{

    animation:
    fadeUp .5s ease forwards;

}



@keyframes fadeUp{


    from{

        opacity:1;

        top:30px;

    }


    to{

        opacity:0;

        top:-40px;

    }


}

/* RESPONSIVE */


@media(max-width:900px){

    .container{

        width:100%;

        height:auto;

    }


    .left{

        display:none;

    }


    .right{

        width:100%;

    }

}

.register-link{

    text-align:center;

    margin-top:18px;

    font-size:14px;

    color:#777;

}


.register-link a{

    color:var(--primary);

    text-decoration:none;

    font-weight:600;

}


.register-link a:hover{

    text-decoration:underline;

}
</style>

</head>



<body>

@if(session('success'))
<div class="alert-popup alert-success" id="popup">
    <div class="alert-icon">✓</div>
    <div>{{ session('success') }}</div>
</div>
@endif

@if(session('error'))
<div class="alert-popup alert-error" id="popup">
    <div class="alert-icon">!</div>
    <div>{{ session('error') }}</div>
</div>
@endif



<div class="container">


    <!-- LEFT SIDE -->

    <div class="left">


        <div class="bubble bubble1"></div>

        <div class="bubble bubble2"></div>

        <div class="bubble bubble3"></div>

        <div class="bubble bubble4"></div>



        <div class="left-content">


            <div class="logo-box">

                S

            </div>


            <h1>

                SIHIB

            </h1>


            <p>

                Sistem Informasi Hibah Barang

                <br>

                Dana APBD Bidang Sarana dan Prasarana

            </p>


            <p>

                Kelola data hibah lebih mudah,

                <br>

                cepat, dan terstruktur.

            </p>


        </div>


    </div>



    <!-- RIGHT SIDE -->


    <div class="right">


        <div class="login-box">


            <div class="title">


                <div class="icon">

                <img src="{{ asset('images/S.png') }}" alt="Logo SIHIB">

                </div>


                <h2>

                    Selamat Datang Kembali!

                </h2>
                
                @if(request()->get('register') == 'success')

<div class="alert-success">
    Akun telah berhasil dibuat, silakan login.
</div>

@endif
                <p>

                    Silakan login untuk mengakses SIHIB

                </p>


            </div>
            
            <form method="POST" action="{{ route('login.process') }}">

                @csrf



                <div class="form-group">

                    <label>

                        Email

                    </label>


                    <input

                    type="email"

                    name="email"

                    placeholder="Masukkan email"

                    required>


                </div>



                <div class="form-group">


<label>

    Password

</label>


<div class="password-wrapper">


<input

id="password"

type="password"

name="password"

placeholder="Masukkan password"

required>


<button 
type="button"
class="toggle-password"
onclick="togglePassword()">


<x-heroicon-o-eye 
    id="eyeIcon"
    class="w-6 h-6"/>


</button>


</div>


</div>


                <div class="remember">


                    <label>

                        <input type="checkbox">

                        Ingat saya

                    </label>



                    <a href="/forgot-password">
                    Lupa Password?
                    </a>


                </div>




             <button class="login-btn">
                Login
            </button>


            </form>


            <div class="register-link">

                Belum punya akun?
                
                <a href="/register">
                    Register
                </a>

            </div>



            <div class="bottom">
                gmail - admin@sihib.com
                <br>
                sandi - admin123
            </div>



        </div>


    </div>



</div>



<script>

function togglePassword(){

    const password = document.getElementById("password");


    const icon = document.getElementById("eyeIcon");



    if(password.type === "password"){


        password.type = "text";


        icon.outerHTML = `

        <x-heroicon-o-eye-slash
        id="eyeIcon"
        class="w-6 h-6"/>

        `;


    } else {


        password.type = "password";


        icon.outerHTML = `

        <x-heroicon-o-eye
        id="eyeIcon"
        class="w-6 h-6"/>

        `;


    }

}



setTimeout(()=>{


    const popup=document.getElementById("popup");


    if(popup){

        popup.classList.add("fade-out");

    }


},3000);


</script>

</body>

</html>