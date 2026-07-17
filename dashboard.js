// ============================
// UCAPAN BERDASARKAN WAKTU
// ============================

const sapaan = document.getElementById("sapaan");

if(sapaan){

    let jam = new Date().getHours();

    if(jam < 12){

        sapaan.innerHTML = "Selamat Pagi";

    }

    else if(jam < 15){

        sapaan.innerHTML = "Selamat Siang";

    }

    else if(jam < 18){

        sapaan.innerHTML = "Selamat Sore";

    }

    else{

        sapaan.innerHTML = "Selamat Malam";

    }

}




// ============================
// ANIMASI PROGRESS BAR
// ============================

const progressBar = document.querySelectorAll(".progress-bar");


progressBar.forEach(function(item){

    let persen = item.style.width;

    item.style.width = "0%";


    setTimeout(function(){

        item.style.width = persen;

    },300);


});