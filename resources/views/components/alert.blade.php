@if(session('success') || session('error'))

<div class="toast-wrapper" id="toastWrapper">


    @if(session('success'))

    <div class="toast toast-success">

        <div class="toast-icon">
            ✓
        </div>


        <div>

            <strong>
                Berhasil
            </strong>

            <p>
                {{ session('success') }}
            </p>

        </div>

    </div>

    @endif





    @if(session('error'))

    <div class="toast toast-error">

        <div class="toast-icon">
            !
        </div>


        <div>

            <strong>
                Gagal
            </strong>

            <p>
                {{ session('error') }}
            </p>

        </div>

    </div>

    @endif


</div>

@endif