function toggleDropdown(){

    const menu = document.querySelector(".submenu");
    const button = document.querySelector(".dropdown-toggle");


    if(menu && button){

        menu.classList.toggle("show");

        button.classList.toggle("active");

    }

}



document.addEventListener("DOMContentLoaded",function(){


    const darkButton=document.getElementById("darkMode");

    const lightButton=document.getElementById("lightMode");



    if(localStorage.getItem("theme")==="dark"){

        document.body.classList.add("dark");

    }



    if(darkButton){

        darkButton.onclick=function(){

            document.body.classList.add("dark");

            localStorage.setItem(
                "theme",
                "dark"
            );

        };

    }



    if(lightButton){

        lightButton.onclick=function(){

            document.body.classList.remove("dark");

            localStorage.setItem(
                "theme",
                "light"
            );

        };

    }

    

});



// AJAX TAB HIBAH APBD APBN
document.addEventListener("DOMContentLoaded", function(){

    const tabs = document.querySelectorAll(".hibah-tab");
    const tbody = document.getElementById("hibahTableBody");
    const btnTambah = document.getElementById("btnTambah");
    const judulDana = document.getElementById("judulDana");


    if(tabs.length && tbody){


        function loadHibah(sumber){


            tbody.style.opacity="0.3";


            fetch(`/hibah/${sumber.toLowerCase()}/data`)

            .then(res => res.json())

            .then(result => {


                let html="";


                result.forEach((h,i)=>{


                    html += `

                    <tr>

                        <td>${i+1}</td>

                        <td>
                            <div class="hibah-name">
                                <strong>${h.kegiatan}</strong>
                            </div>
                        </td>

                        <td>${h.unit}</td>

                        <td>${h.tahun}</td>

                        <td>${h.nama_kelompok}</td>

                        <td>${h.desa}</td>

                        <td>${h.kecamatan}</td>

                        <td>${h.kabupaten_kota}</td>

                        <td>
                            Rp ${Number(h.nilai_hibah)
                            .toLocaleString('id-ID')}
                        </td>

                        <td>
                            <a href="/hibah/${sumber.toLowerCase()}/${h.id}"
                               class="hibah-menu">
                               ⋮
                            </a>
                        </td>

                    </tr>

                    `;


                });


                tbody.innerHTML = html;


                tbody.style.opacity="1";


            });


        }




        tabs.forEach(tab=>{


            tab.addEventListener("click",function(){


                const sumber = this.dataset.sumber;



                tabs.forEach(t =>
                    t.classList.remove("active")
                );


                this.classList.add("active");



                if(judulDana){
                    judulDana.innerHTML = sumber;
                }



                if(btnTambah){

                    btnTambah.href =
                    `/hibah/${sumber.toLowerCase()}/create`;

                }



                loadHibah(sumber);


            });


        });



        // LOAD PERTAMA KALI APBD
        loadHibah("APBD");


    }


});
