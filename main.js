// ============================
// KONFIRMASI LOGOUT
// ============================

const tombolLogout = document.querySelector('a[href="logout.php"]');

if (tombolLogout) {

    tombolLogout.addEventListener("click", function (e) {

        let konfirmasi = confirm("Apakah Anda yakin ingin keluar?");

        if (!konfirmasi) {

            e.preventDefault();

        }

    });

}



// ============================
// SCROLL KE ATAS HALAMAN
// ============================

window.addEventListener("load", function () {

    window.scrollTo(0,0);

});




// ============================
// PESAN SELAMAT DATANG
// ============================

window.addEventListener("DOMContentLoaded", function(){

    console.log("Sistem Informasi Absensi Berhasil Dimuat.");

});