// Ambil elemen
const cari = document.getElementById("cari");
const filterKelas = document.getElementById("filterKelas");
const rows = document.querySelectorAll("#tablePeserta tr");

// Fungsi filter
function filterData() {

    const keyword = cari.value.toLowerCase();
    const kelasDipilih = filterKelas.value.toLowerCase();

    rows.forEach(function (row) {

        const nim = row.children[1].textContent.toLowerCase();
        const nama = row.children[2].textContent.toLowerCase();
        const kelas = row.children[4].textContent.toLowerCase();

        const cocokCari =
            nim.includes(keyword) ||
            nama.includes(keyword);

        const cocokKelas =
            kelasDipilih === "" ||
            kelas === kelasDipilih;

        if (cocokCari && cocokKelas) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });
}

// Event
cari.addEventListener("keyup", filterData);
filterKelas.addEventListener("change", filterData);

console.log("peserta.js berhasil dimuat");