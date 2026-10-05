@extends('layouts.app')

@section('content')


<div class="settings-page">



@if(session('success'))

<div class="alert-success">

    {{ session('success') }}

</div>

@endif



@if(session('error'))

<div class="alert-error">

    {{ session('error') }}

</div>

@endif







{{-- HEADER --}}


<div class="page-header">


    <div>

        <h1>
            Pengaturan
        </h1>


        <p>
            Kelola konfigurasi dan preferensi SIHIB
        </p>


    </div>





    <div class="settings-header-action">

    <a 
    href="{{ route('settings') }}"
    class="btn-cancel">

        Batal

    </a>


    <button 
    type="submit"
    form="profileForm"
    class="btn-primary">

        Simpan Perubahan

    </button>

</div>

</div>









<div class="settings-container">







{{-- =========================
    PROFIL
========================= --}}



<form 
id="profileForm"
class="confirm-form"
data-confirm-title="Simpan Perubahan"
data-confirm-message="Apakah Anda yakin ingin menyimpan perubahan profil?"
data-confirm-text="Ya, Simpan"
method="POST"
enctype="multipart/form-data"
action="{{ route('profile.update') }}">


@csrf

@method('PUT')


<div class="settings-section">





<div class="settings-description">


<h3>
Profil Pengguna
</h3>


<p>
Informasi akun pengguna aktif
</p>


</div>









<div class="settings-content">







{{-- FOTO PROFILE --}}


<div class="profile-upload">





<div class="profile-avatar">



@if(auth()->user()->photo)


<img 
src="{{ asset('storage/profile/'.auth()->user()->photo) }}"
class="profile-image"
>



@else



{{ strtoupper(
substr(
auth()->user()->name ?? 'A',
0,
1
)
) }}



@endif



</div>







<input 
type="file"
name="photo"
id="photo"
accept="image/*"
hidden
>





<label 
for="photo"
class="btn-outline">

Ganti Foto

</label>





</div>










<div class="settings-form-group">


<label>
Nama Lengkap
</label>



<input 
type="text"
name="name"
value="{{ auth()->user()->name ?? '' }}"
>


</div>









<div class="settings-form-group">


<label>
Email
</label>



<input 
type="email"
name="email"
value="{{ auth()->user()->email ?? '' }}"
>


</div>









<div class="settings-form-group">


<label>
Role
</label>



<select name="role">



<option value="Administrator">

Administrator

</option>




<option value="Operator">

Operator

</option>



</select>



</div>





</div>





</div>






</form>















{{-- =========================
    PASSWORD
========================= --}}



<form 
method="POST"
action="{{ route('profile.password') }}">



@csrf

@method('PUT')






<div class="settings-section">





<div class="settings-description">


<h3>
Password
</h3>


<p>
Perbarui keamanan akun Anda
</p>


</div>








<div class="settings-content">







<div class="settings-form-group">


<label>
Password Lama
</label>



<input 
type="password"
name="old_password"
placeholder="Masukkan password lama"
>



</div>










<div class="settings-form-group">


<label>
Password Baru
</label>



<input 
type="password"
name="password"
placeholder="Masukkan password baru"
>



</div>









<div class="settings-form-group">


<label>
Konfirmasi Password Baru
</label>



<input 
type="password"
name="password_confirmation"
placeholder="Ulangi password baru"
>



</div>







<button 
type="submit"
class="btn-outline">


Update Password


</button>







</div>




</div>





</form>














{{-- =========================
    PREFERENSI
========================= --}}





<div class="settings-section">





<div class="settings-description">


<h3>
Preferensi Sistem
</h3>



<p>
Atur tampilan dan notifikasi aplikasi
</p>



</div>








<div class="settings-content">







<div class="settings-option">



<div>


<h4>
Mode Gelap
</h4>


<p>
Gunakan tampilan dark mode
</p>



</div>







<label class="switch">



<input 
type="checkbox"
id="themeToggle"
>



<span></span>



</label>




</div>









<div class="settings-option">



<div>


<h4>
Notifikasi Hibah
</h4>


<p>
Pemberitahuan data hibah terbaru
</p>



</div>







<label class="switch">



<input 
type="checkbox"
checked
>



<span></span>



</label>




</div>









</div>







</div>









</div>



</div>


<div class="settings-footer">

    <small>
        Web Developer - Yayan
    </small>

    <small>
        System Analyst - Epri
    </small>

</div>


@endsection

<script>

document
.getElementById('photo')
.addEventListener('change', function(e){


    let reader = new FileReader();


    reader.onload = function(event){


        document.querySelector('.profile-avatar')
        .innerHTML =
        `<img 
        src="${event.target.result}"
        class="profile-image">`;


    }


    reader.readAsDataURL(e.target.files[0]);


});

</script>