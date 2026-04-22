const dataKodePos = [
    { prov: "Jawa Timur", kota: "Surabaya", kec: "Sukolilo", pos: "60111" },
    { prov: "Jawa Timur", kota: "Malang", kec: "Lowokwaru", pos: "65141" },
    { prov: "DKI Jakarta", kota: "Jakarta Selatan", kec: "Tebet", pos: "12810" }
];

function cariKodePos() {
    let inputProv = document.getElementById("prov").value.toLowerCase();
    let inputKota = document.getElementById("kota").value.toLowerCase();
    let display = document.getElementById("hasilPencarian");

    let hasil = dataKodePos.find(item => {
        return item.prov.toLowerCase() === inputProv && 
               item.kota.toLowerCase() === inputKota;
    });

    if (hasil) {
        display.innerHTML = `Hasil: Kode Pos ${hasil.pos} (Kecamatan: ${hasil.kec})`;
        display.style.color = "green";
    } else {
        display.innerHTML = "Data tidak ditemukan. (Coba ketik: surabaya atau SURABAYA)";
        display.style.color = "red";
    }
}