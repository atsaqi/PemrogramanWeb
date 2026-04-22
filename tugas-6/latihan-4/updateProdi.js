const dataProdi = {
    "FT": ["Informatika", "Sipil", "Industri"],
    "FE": ["Akuntansi", "Manajemen"]
};

function updateProdi() {
    const fakultasPilihan = document.getElementById("fakultas").value;
    const prodiSelect = document.getElementById("prodi");

    prodiSelect.innerHTML = '<option value="">-- Pilih Prodi --</option>';

    if (fakultasPilihan !== "") {
        const listProdi = dataProdi[fakultasPilihan];

        listProdi.forEach(function(item) {
            let pilihanBaru = document.createElement("option");
            pilihanBaru.value = item;
            pilihanBaru.innerHTML = item;
            prodiSelect.appendChild(pilihanBaru);
        });
    }
}