var angka = document.getElementById("salary");
angka.addEventListener("keyup", function (e) {
	angka.value = formatUang(this.value, "Rp. ");
});
function formatUang(nilai, format) {
	var string_angka = nilai.replace(/[^,\d]/g, "").toString(),
		split = string_angka.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return format == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
