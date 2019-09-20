$(document).ready(function () {
	$('#btn-search').click(function () { // ketika tombol cari diklik
		// ubah text tombol cari menjadi Searching...
		// dan tambahkan atribut disable pada tombolnya agar tidak bisa diklik lagi
		$(this).html("Searching...").attr("disabled", "disabled");

		$.ajax({
			url: baseurl + 'person/search', // file tujuan
			type: 'POST',
			data: {
				keyword: $('#search').val()
			},
			dataType: "json",
			beforeSend: function (e) {
				if (e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},

			success: function (response) { // ketika proses pengiriman berhasil
				// ubah kembali text button cari menjadi icon atau Search
				// dan hapus atribut disabled untuk meng-enable kembali button carinya
				$('#btn-search').html("Search").removeAttr("disabled");

				// ganti isi div view dengan view yang diambil dari controller person function search yang nantinya akan berisi table hasil hasil dari pencarian
				$("#view").html(response.hasil);
			},

			error: function (xhr, ajaxOptions, thrownError) { // ketika ada error
				alert(xhr.responseText); // munculkan alert
			}
		})
	})
})
