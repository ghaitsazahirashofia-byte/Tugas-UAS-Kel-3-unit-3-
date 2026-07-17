const formAbsensi = document.querySelector("form[action='absensi.php']");

if (formAbsensi) {

    formAbsensi.addEventListener("submit", function (e) {

        const rows = document.querySelectorAll("tbody tr");

        if (rows.length === 0) {

            alert("Pilih unit terlebih dahulu.");

            e.preventDefault();

        }

    });

}