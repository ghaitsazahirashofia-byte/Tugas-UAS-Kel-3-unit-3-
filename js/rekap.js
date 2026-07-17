// ============================
// PENCARIAN + FILTER KELAS
// ============================

const cari = document.getElementById("cari");
const filterKelas = document.getElementById("filterKelas");

function filterData() {

    let keyword = cari.value.toLowerCase();
    let kelasDipilih = filterKelas.value.toLowerCase();

    let baris = document.querySelectorAll("#tablePeserta tr");

    baris.forEach(function (row) {

        let nim = row.children[1].textContent.toLowerCase();
        let nama = row.children[2].textContent.toLowerCase();
        let kelas = row.children[4].textContent.toLowerCase();

        let cocokCari =
            nim.includes(keyword) ||
            nama.includes(keyword);

        let cocokKelas =
            kelasDipilih === "" ||
            kelas === kelasDipilih;

        if (cocokCari && cocokKelas) {

            row.style.display = "";

        } else {

            row.style.display = "none";

        }

    });

}

if (cari) {
    cari.addEventListener("keyup", filterData);
}

if (filterKelas) {
    filterKelas.addEventListener("change", filterData);
}