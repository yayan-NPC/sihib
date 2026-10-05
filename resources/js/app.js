import './bootstrap';


// =====================================================
// HELPER
// =====================================================

function escapeHtml(value){

    return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

}


// =====================================================
// SIDEBAR DROPDOWN
// =====================================================

window.toggleDropdown = function(id, button){

    const menu = document.getElementById(id);

    if(menu){
        menu.classList.toggle('show');
    }

    if(button){
        button.classList.toggle('open');
    }

};


// =====================================================
// ACTION DROPDOWN
// =====================================================

window.toggleActionMenu = function(id){

    const target =
        document.getElementById(`action-${id}`);


    if(!target){
        return;
    }


    const isOpen =
        target.classList.contains('show');


    document
        .querySelectorAll('.action-dropdown.show')
        .forEach(menu => {

            menu.classList.remove('show');
            menu.classList.remove('drop-up');

        });



    if(!isOpen){

        const button =
            target.previousElementSibling;


        const rect =
            button.getBoundingClientRect();


        target.classList.add('show');

        target.classList.add('show');


        target.style.top = (rect.bottom + 8) + "px";

        target.style.left = (rect.right - target.offsetWidth) + "px";

        const dropdownHeight =
            target.offsetHeight;


        const spaceBottom =
            window.innerHeight - rect.bottom;



        if(spaceBottom < dropdownHeight + 20){

            target.classList.add(
                'drop-up'
            );

        }else{

            target.classList.remove(
                'drop-up'
            );

        }

    }

};


// Tutup menu action jika klik di luar
document.addEventListener('click', function(event){

    if(!event.target.closest('.action-menu')){

        document
            .querySelectorAll('.action-dropdown.show')
            .forEach(menu => {

                menu.classList.remove('show');
                    menu.classList.remove('drop-up');

            });

    }

});


// =====================================================
// TOAST
// =====================================================

window.showToast = function(type, title, message){

    const wrapper =
        document.createElement('div');

    wrapper.className =
        'toast-wrapper';


    wrapper.innerHTML = `

        <div class="toast toast-${type}">

            <div class="toast-icon">

                ${type === 'success' ? '✓' : '!'}

            </div>


            <div>

                <strong>
                    ${escapeHtml(title)}
                </strong>

                <p>
                    ${escapeHtml(message)}
                </p>

            </div>

        </div>

    `;


    document.body.appendChild(wrapper);


    setTimeout(() => {

        wrapper.classList.add('hide');


        setTimeout(() => {

            wrapper.remove();

        }, 350);

    }, 3500);

};


// =====================================================
// GLOBAL CONFIRMATION MODAL
// =====================================================

let pendingConfirmForm = null;


function openConfirmModal(form){

    const overlay =
        document.getElementById('confirmOverlay');

    const title =
        document.getElementById('confirmTitle');

    const message =
        document.getElementById('confirmMessage');

    const submitButton =
        document.getElementById('confirmSubmit');


    if(
        !overlay ||
        !title ||
        !message ||
        !submitButton
    ){

        console.error(
            'Komponen confirmation modal tidak ditemukan.'
        );

        return;
    }


    pendingConfirmForm =
        form;


    const type =
        form.dataset.confirmType ||
        'save';

    const confirmTitle =
        form.dataset.confirmTitle ||
        'Konfirmasi';

    const confirmMessage =
        form.dataset.confirmMessage ||
        'Apakah Anda yakin ingin melanjutkan?';

    const confirmText =
        form.dataset.confirmText ||
        'Ya, Lanjutkan';


    title.textContent =
        confirmTitle;

    message.textContent =
        confirmMessage;

    submitButton.textContent =
        confirmText;


    overlay.classList.remove(
        'show',
        'confirm-delete',
        'confirm-logout'
    );


    if(type === 'delete'){

        overlay.classList.add(
            'confirm-delete'
        );

    }

        if(type === 'logout'){

        overlay.classList.add(
            'confirm-logout'
        );

    }

    overlay.classList.add('show');

    overlay.setAttribute(
        'aria-hidden',
        'false'
    );

}


function closeConfirmModal(){

    const overlay =
        document.getElementById(
            'confirmOverlay'
        );


    if(!overlay){
        return;
    }


    overlay.classList.remove(
        'show',
        'confirm-delete',
        'confirm-logout'
    );


    overlay.setAttribute(
        'aria-hidden',
        'true'
    );

}


// Tangkap semua form dengan class confirm-form.
// Berlaku juga untuk form hasil AJAX.
document.addEventListener(
    'submit',
    function(event){

        const form =
            event.target.closest(
                'form.confirm-form'
            );


        if(!form){
            return;
        }


        /*
         * Kalau sudah dikonfirmasi,
         * submit langsung.
         */
        if(
            form.dataset.confirmed ===
            'true'
        ){
            return;
        }


        event.preventDefault();


        openConfirmModal(form);

    }
);


// =====================================================
// DOM READY
// =====================================================

document.addEventListener(
    'DOMContentLoaded',
    function(){


        // =================================================
        // DARK MODE
        // =================================================

        const themeToggle =
            document.getElementById(
                'themeToggle'
            );


        if(
            localStorage.getItem('theme')
            === 'dark'
        ){

            document.body.classList.add(
                'dark'
            );

        }


        if(themeToggle){

            themeToggle.addEventListener(
                'click',
                function(){

                    document.body
                        .classList
                        .toggle('dark');


                    localStorage.setItem(

                        'theme',

                        document.body
                            .classList
                            .contains('dark')
                            ? 'dark'
                            : 'light'

                    );

                }
            );

        }


        // =================================================
        // SESSION TOAST
        // =================================================

        document
            .querySelectorAll(
                '.toast-wrapper'
            )
            .forEach(toast => {

                setTimeout(() => {

                    toast.classList.add(
                        'hide'
                    );


                    setTimeout(() => {

                        toast.remove();

                    }, 350);

                }, 3500);

            });


        // =================================================
        // CONFIRM MODAL
        // =================================================

        const confirmOverlay =
            document.getElementById(
                'confirmOverlay'
            );

        const confirmCancel =
            document.getElementById(
                'confirmCancel'
            );

        const confirmSubmit =
            document.getElementById(
                'confirmSubmit'
            );


        // BATAL
        if(confirmCancel){

            confirmCancel.addEventListener(
                'click',
                function(){

                    closeConfirmModal();

                    pendingConfirmForm =
                        null;

                }
            );

        }


        // YA SIMPAN / UBAH / HAPUS
        if(confirmSubmit){

            confirmSubmit.addEventListener(
                'click',
                function(){

                    if(!pendingConfirmForm){
                        return;
                    }


                    const form =
                        pendingConfirmForm;


                    form.dataset.confirmed =
                        'true';


                    closeConfirmModal();


                    pendingConfirmForm =
                        null;


                    form.requestSubmit();

                }
            );

        }


        // Klik area gelap
        if(confirmOverlay){

            confirmOverlay.addEventListener(
                'click',
                function(event){

                    if(
                        event.target ===
                        confirmOverlay
                    ){

                        closeConfirmModal();

                        pendingConfirmForm =
                            null;

                    }

                }
            );

        }


        // =================================================
        // HIBAH ELEMENT
        // =================================================

        const tabs =
            document.querySelectorAll(
                '.hibah-tab'
            );

        const tbody =
            document.getElementById(
                'hibahTableBody'
            );


        const globalSearch =
            document.getElementById(
                'globalSearch'
            );


        const btnTambah =
            document.getElementById(
                'btnTambahHibah'
            );

        const judulDana =
            document.getElementById(
                'judulDana'
            );


        // =================================================
        // REKAP TAHUN ELEMENT
        // =================================================

        const btnYearSummary =
            document.getElementById(
                'btnYearSummary'
            );

        const rekapTahunOverlay =
            document.getElementById(
                'rekapTahunOverlay'
            );

        const rekapTahunClose =
            document.getElementById(
                'rekapTahunClose'
            );

        const rekapTahunContent =
            document.getElementById(
                'rekapTahunContent'
            );

        const rekapTahunSubtitle =
            document.getElementById(
                'rekapTahunSubtitle'
            );


       let currentHibahData = [];

        let currentSumber =
            'APBD';

        let urutanTahun = 
        'desc';

        let currentSearch =
            '';
        

        if(globalSearch){

    globalSearch.addEventListener(
        'input',
        function(){

            currentSearch =
                this.value;


            renderTable(
                currentHibahData
            );

        }
    );

}

        // =================================================
// GLOBAL SEARCH
// =================================================

if(globalSearch){

    globalSearch.addEventListener(
        'input',
        function(){

            currentSearch =
                this.value;


            renderTable(
                currentHibahData
            );

        }
    );

}

        // =================================================
        // CLOSE REKAP
        // =================================================

        function closeRekapTahun(){

            if(!rekapTahunOverlay){
                return;
            }


            rekapTahunOverlay
                .classList
                .remove('show');


            rekapTahunOverlay
                .setAttribute(
                    'aria-hidden',
                    'true'
                );

        }


        // =================================================
        // RENDER REKAP TAHUN
        // =================================================

        function renderRekapTahun(){


    if(
        !rekapTahunContent ||
        !rekapTahunSubtitle
    ){
        return;
    }



    rekapTahunSubtitle.textContent =
        `Data Hibah ${currentSumber}`;



    if(
        !Array.isArray(currentHibahData) ||
        currentHibahData.length === 0
    ){

        rekapTahunContent.innerHTML = `

            <div class="rekap-tahun-empty">

                Belum ada data hibah
                ${escapeHtml(currentSumber)}

            </div>

        `;

        return;

    }



    // ==========================
    // HITUNG JUMLAH DATA PER TAHUN
    // ==========================

    const recap = {};



    currentHibahData.forEach(item=>{


        const tahun =
            item.tahun;


        if(tahun){


            if(!recap[tahun]){

                recap[tahun] = 0;

            }


            recap[tahun]++;

        }


    });




    const years =
        Object
        .keys(recap)
        .sort(
            (a,b)=>
            Number(b)-Number(a)
        );




    if(years.length === 0){


        rekapTahunContent.innerHTML = `

            <div class="rekap-tahun-empty">

                Data tahun belum tersedia

            </div>

        `;

        return;

    }





    rekapTahunContent.innerHTML =

        years.map(tahun=>{


            return `

            <div class="rekap-tahun-item">


                <span class="rekap-tahun-year">

                    Tahun ${escapeHtml(tahun)}

                </span>



                <span class="rekap-tahun-total">

                    ${recap[tahun]}

                </span>


            </div>

            `;


        }).join('');

}


        // =================================================
        // BUKA REKAP TAHUN
        // =================================================

        if(
            btnYearSummary &&
            rekapTahunOverlay
        ){

            btnYearSummary.addEventListener(
                'click',
                function(event){

                    event.preventDefault();

                    event.stopPropagation();


                    renderRekapTahun();


                    rekapTahunOverlay
                        .classList
                        .add('show');


                    rekapTahunOverlay
                        .setAttribute(
                            'aria-hidden',
                            'false'
                        );

                }
            );

        }


        // =================================================
        // CLOSE BUTTON REKAP
        // =================================================

        if(
            rekapTahunClose &&
            rekapTahunOverlay
        ){

            rekapTahunClose.addEventListener(
                'click',
                function(){

                    closeRekapTahun();

                }
            );

        }


        // Klik background rekap
        if(rekapTahunOverlay){

            rekapTahunOverlay.addEventListener(
                'click',
                function(event){

                    if(
                        event.target ===
                        rekapTahunOverlay
                    ){

                        closeRekapTahun();

                    }

                }
            );

        }

        

// =================================================
// RENDER TABLE + LOAD DATA HIBAH
// =================================================

function renderTable(data){


    document.querySelectorAll('.tahun-menu button')
.forEach(button=>{


    button.addEventListener('click', function(){


        urutanTahun =
        this.dataset.value;


        if(typeof currentHibahData !== 'undefined'){

            renderTable(
                currentHibahData
            );

        }


    });


});

    let html = '';

    const keyword =
        currentSearch
        .toLowerCase()
        .trim();


    const filtered = data.filter(h=>{

        if(!keyword){
            return true;
        }

        return (
            String(h.kegiatan ?? '').toLowerCase().includes(keyword) ||
            String(h.unit ?? '').toLowerCase().includes(keyword) ||
            String(h.tahun ?? '').toLowerCase().includes(keyword) ||
            String(h.nama_kelompok ?? '').toLowerCase().includes(keyword) ||
            String(h.desa ?? '').toLowerCase().includes(keyword) ||
            String(h.kecamatan ?? '').toLowerCase().includes(keyword) ||
            String(h.kabupaten_kota ?? '').toLowerCase().includes(keyword)
        );

    });

    if(urutanTahun){

    filtered.sort((a,b)=>{

        let tahunA =
            Number(a.tahun) || 0;

        let tahunB =
            Number(b.tahun) || 0;


        if(urutanTahun === 'desc'){

            return tahunB - tahunA;

        }


        return tahunA - tahunB;

    });

}


    if(filtered.length === 0){

        tbody.innerHTML = `
            <tr>
                <td colspan="12" style="text-align:center">
                    Data tidak ditemukan
                </td>
            </tr>
        `;

        return;
    }


    filtered.forEach((h,index)=>{

        html += `

            <tr>

            <td>${index + 1}</td>

            <td>
                <strong>${escapeHtml(h.kegiatan)}</strong>
            </td>

            <td>
                ${escapeHtml(h.unit)}
            </td>

            <td>
                ${escapeHtml(h.tahun)}
            </td>

            <td>
                ${escapeHtml(h.nama_kelompok)}
            </td>

            <td>
                ${escapeHtml(h.desa)}
            </td>

            <td>
                ${escapeHtml(h.kecamatan)}
            </td>

            <td>
                ${escapeHtml(h.kabupaten_kota)}
            </td>

            <td>
                ${escapeHtml(h.kondisi ?? '-')}
            </td>

            <td>
                Rp ${Number(h.nilai_hibah || 0)
                .toLocaleString('id-ID')}
            </td>

            <td class="action-column">

                <div class="action-menu">

                    <button
                    type="button"
                    class="btn-action"
                    onclick="toggleActionMenu(${h.id})">
                        ⋮
                    </button>


                    <div
                    class="action-dropdown"
                    id="action-${h.id}">

                               <a href="javascript:void(0)"
                                onclick="lihatDetail(${h.id}, '${currentSumber}')">
                                    Detail
                                </a>

                                <a
                                href="/hibah/${currentSumber.toLowerCase()}/${h.id}/edit">

                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                    </svg>

                                    Edit

                                </a>

                             <form
method="POST"
action="/hibah/${currentSumber.toLowerCase()}/${h.id}"

class="confirm-form"

data-confirm-type="delete"

data-confirm-title="Hapus Data"

data-confirm-message="Apakah Anda yakin ingin menghapus data hibah ini?"

data-confirm-text="Ya, Hapus"
>

<input type="hidden"
name="_token"
value="${document.querySelector('meta[name=csrf-token]')?.content || ''}">


<input type="hidden"
name="_method"
value="DELETE">


<button type="submit">

    <svg viewBox="0 0 24 24">

        <polyline points="3 6 5 6 21 6"/>

        <path d="M19 6l-1 14H6L5 6"/>

        <path d="M10 11v6"/>

        <path d="M14 11v6"/>

        <path d="M9 6V4h6v2"/>

    </svg>

    Hapus

</button>


</form>

                    </div>

                </div>

            </td>

        </tr>

        `;

    });


    tbody.innerHTML = html;

}



function loadHibah(sumber){

    if(!tbody){
        return;
    }


    currentSumber = sumber;


    tbody.innerHTML = `

        <tr>
            <td colspan="12" style="text-align:center">
                Memuat data...
            </td>
        </tr>

    `;


    fetch(`/hibah/${sumber.toLowerCase()}/data`)

    .then(response=>{

        if(!response.ok){
            throw new Error('Data gagal dimuat');
        }

        return response.json();

    })

    .then(data => {


    currentHibahData =
        Array.isArray(data)
        ? data
        : [];


    currentSumber =
        sumber;



    // tampilkan tabel
    renderTable(
        currentHibahData
    );


    // update rekap tahun
    renderRekapTahun(
        currentHibahData
    );


})
    .catch(error=>{

        tbody.innerHTML = `

            <tr>
                <td colspan="12" style="text-align:center">
                    Gagal memuat data
                </td>
            </tr>

        `;


        showToast(
            "error",
            "Gagal",
            error.message
        );

    });

}

        

        // TAB APBD / APBN
        // =================================================

        if(
            tabs.length &&
            tbody
        ){

            tabs.forEach(tab => {

                tab.addEventListener(
                    'click',
                    function(event){

                        event.preventDefault();


                        const sumber =
                            this.dataset
                                .sumber;


                        if(!sumber){
                            return;
                        }


                        // Reset tab
                        tabs.forEach(
                            item => {

                                item.classList
                                    .remove(
                                        'active'
                                    );

                            }
                        );


                        // Tab aktif
                        this.classList
                            .add('active');


                        currentSumber =
                            sumber;


                        // Update judul
                        if(judulDana){

                            judulDana
                                .textContent =
                                sumber;

                        }


                        // Update link tambah
                        if(btnTambah){

                            btnTambah.href =
                                `/hibah/${sumber.toLowerCase()}/create`;

                        }


                        // Tutup rekap
                        closeRekapTahun();


                        // Load tabel
                        loadHibah(
                            sumber
                        );

                    }
                );

            });


            /*
             * LOAD APBD SEKALI SAJA
             */
            loadHibah('APBD');

        }


        // =================================================
        // TABLE DRAG SCROLL
        // =================================================

        const tableContainers =
            document.querySelectorAll(
                '.table-container'
            );


        tableContainers.forEach(
            container => {

                let isDragging =
                    false;

                let startX =
                    0;

                let scrollLeft =
                    0;


                container.addEventListener(
                    'mousedown',
                    function(event){

                        /*
                         * Jangan drag ketika
                         * klik tombol / link.
                         */
                        if(
                            event.target.closest(
                                'button, a, input, select, textarea, .action-menu'
                            )
                        ){
                            return;
                        }


                        isDragging =
                            true;


                        container.classList
                            .add(
                                'dragging'
                            );


                        startX =
                            event.pageX -
                            container.offsetLeft;


                        scrollLeft =
                            container
                                .scrollLeft;

                    }
                );


                container.addEventListener(
                    'mousemove',
                    function(event){

                        if(!isDragging){
                            return;
                        }


                        event.preventDefault();


                        const x =
                            event.pageX -
                            container.offsetLeft;


                        const distance =
                            x - startX;


                        container.scrollLeft =
                            scrollLeft -
                            (distance * 1.2);

                    }
                );


                function stopDragging(){

                    isDragging =
                        false;


                    container
                        .classList
                        .remove(
                            'dragging'
                        );

                }


                container.addEventListener(
                    'mouseup',
                    stopDragging
                );


                container.addEventListener(
                    'mouseleave',
                    stopDragging
                );

            }
        );


        // =================================================
        // ESC
        // =================================================

        document.addEventListener(
            'keydown',
            function(event){

                if(
                    event.key !==
                    'Escape'
                ){
                    return;
                }


                // Tutup action dropdown
                document
                    .querySelectorAll(
                        '.action-dropdown.show'
                    )
                    .forEach(
                        menu => {

                            menu.classList
                                .remove(
                                    'show'
                                );

                        }
                    );


                // Tutup confirm
                if(
                    confirmOverlay
                        ?.classList
                        .contains('show')
                ){

                    closeConfirmModal();

                    pendingConfirmForm =
                        null;

                }


                // Tutup rekap tahun
                if(
                    rekapTahunOverlay
                        ?.classList
                        .contains('show')
                ){

                    closeRekapTahun();

                }

            }
        );

    }
);



document.getElementById('confirmCancel')
.addEventListener('click', function(){

    document.getElementById('confirmOverlay')
    .classList.remove(
        'show',
        'confirm-delete',
        'confirm-logout'
    );

});

// =====================================================
// DETAIL HIBAH POPUP
// =====================================================

window.lihatDetail = function(id, sumber)
{

    // tutup dropdown aksi saat buka detail
    document
        .querySelectorAll('.action-dropdown.show')
        .forEach(menu => {

            menu.classList.remove('show');
            menu.classList.remove('drop-up');

        });


    fetch(`/hibah/${sumber.toLowerCase()}/data`)

    .then(res => res.json())

    .then(result => {


        const data = result.find(
            item => item.id == id
        );


        if(!data){
            return;
        }



        let html = `


        ${
        data.foto

        ?

        `
        <div class="detail-photo">

        <img src="/storage/${data.foto}">

        </div>
        `

        :

        ''

        }



        <div class="detail-grid">

            <div class="detail-item">
                <span>Kegiatan</span>
                <strong>${escapeHtml(data.kegiatan)}</strong>
            </div>


            <div class="detail-item">
                <span>Unit</span>
                <strong>${escapeHtml(data.unit)}</strong>
            </div>


            <div class="detail-item">
                <span>Kelompok</span>
                <strong>${escapeHtml(data.nama_kelompok)}</strong>
            </div>


            <div class="detail-item">
                <span>Kondisi</span>
                <strong class="status">
                    ${escapeHtml(data.kondisi)}
                </strong>
            </div>


            <div class="detail-item">
                <span>Tahun</span>
                <strong>${data.tahun}</strong>
            </div>


            <div class="detail-item nilai">
                <span>Nilai Hibah</span>
                <strong>
                Rp ${Number(data.nilai_hibah)
                .toLocaleString('id-ID')}
                </strong>
            </div>


               </div>


        ${
            data.link_maps
            ?
            `
            <div class="detail-map">

                <a 
                    href="${escapeHtml(data.link_maps)}"
                    target="_blank"
                    class="btn-map"
                >
                    📍 Lihat Lokasi Google Maps
                </a>

            </div>
            `
            :
            ''
        }


        <div class="detail-history">


            <h4>
                Riwayat Data
            </h4>


            <div>

                <span>Tanggal Input</span>

                <strong>
                ${new Date(data.created_at)
                .toLocaleString('id-ID',{
                    day:'2-digit',
                    month:'2-digit',
                    year:'numeric',
                    hour:'2-digit',
                    minute:'2-digit'
                })}
                </strong>

            </div>



            <div>

                <span>Update Terakhir</span>

                <strong>
                ${new Date(data.updated_at)
                .toLocaleString('id-ID',{
                    day:'2-digit',
                    month:'2-digit',
                    year:'numeric',
                    hour:'2-digit',
                    minute:'2-digit'
                })}
                </strong>

            </div>


        </div>


        `;



        document.getElementById(
            'detailContent'
        ).innerHTML = html;



        document.getElementById(
            'detailOverlay'
        ).classList.add('show');


    });

};



// tutup popup

document
.getElementById('detailClose')
?.addEventListener('click', function(){


    document.getElementById(
        'detailOverlay'
    )
    .classList.remove('show');


});

// =====================================================
// UPLOAD FOTO HIBAH
// =====================================================

document.getElementById('foto')?.addEventListener('change', function(){

    const text = document.getElementById('uploadText');


    if(!text){
        return;
    }


    if(this.files.length){

        text.textContent = this.files[0].name;

    }else{

        text.textContent = "Pilih Foto Barang";

    }

});