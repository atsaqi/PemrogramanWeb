function simpanData() {
    let nama = document.getElementById("nama").value;
    let nim = document.getElementById("nim").value;
    let matkul = document.getElementById("matkul").value;
    let dosen = document.getElementById("dosen").value;

    if (nama == "" || nim == "") {
        alert("Nama dan NIM tidak boleh kosong!");
    } else {
        alert("Registrasi Berhasil untuk: " + nama);
        console.log("Data:", {nama, nim, matkul, dosen});
    }
}