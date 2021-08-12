"use strict";
$("#zero_config").DataTable();

$("#table_account").DataTable();

$(".produk_id").select2({
	placeholder: "--Pilih Produk--",
	allowClear: true,
	width: "100%",
});

class App {
	constructor() {
		this.productItem();
		this.productContent();
		this.aboutContent();
		this.paymentContent();
		this.transactionDetail();
		this.updateTransactionStatus();
		this.updateShippingStatus();
		this.updateStatusRating();

		// Validate
		this.validateFormTransactionStatus();
		this.validateLogout();
		this.validateProduct();
		this.validateProductContent();
		this.validateAboutUs();
		this.validateTestimonial();
		this.validatePayment();
	}

	_url = "http://localhost:8080/simasdang/";

	productItem() {
		// const dataUpdateProduct = document.querySelector(".btn-update-produk");
		const dataUpdateProduct = document.getElementById("modalUbahProduk");

		// Guard clause
		if (!dataUpdateProduct) return;

		dataUpdateProduct.addEventListener("show.bs.modal", function (e) {
			let btnUpdate = e.relatedTarget;

			const colProdukId = document.getElementById("produkId_ubah");
			const colNama = document.getElementById("nama_ubah");
			const colVarian = document.getElementById("varian_ubah");
			const colBerat = document.getElementById("berat_ubah");
			const colHarga = document.getElementById("harga_ubah");
			const colStok = document.getElementById("stok_ubah");

			colProdukId.value = btnUpdate.getAttribute("data-goods-id");
			colNama.value = btnUpdate.getAttribute("data-nama-barang");
			colVarian.value = btnUpdate.getAttribute("data-varian");
			colBerat.value = btnUpdate.getAttribute("data-berat");
			colHarga.value = btnUpdate.getAttribute("data-harga");
			colStok.value = btnUpdate.getAttribute("data-stok");
		});
	}

	productContent() {
		const dataUpdateContentProduct = document.getElementById(
			"modalUbahKontenProduk"
		);

		// Guard clause
		if (!dataUpdateContentProduct) return;

		dataUpdateContentProduct.addEventListener("show.bs.modal", function (e) {
			const btnUpdate = e.relatedTarget;

			const colContentId = document.getElementById("kontenId_ubah");
			const colDeskripsi = document.getElementById("deskripsiKonten_ubah");
			const colProdukImg = document.getElementById("kontenProduk_img_ubah");
			const colStatus = document.getElementById("status_ubah");
			const colProdukStatus = document.getElementById("goods_status_ubah");
			const colProdukNama = document.getElementById("goods_nama_ubah");
			const colOldImg = document.getElementById("old_img");
			// const colProdukId = document.getElementById("produkId_ubah");

			colContentId.value = btnUpdate.getAttribute("data-content-id");
			colDeskripsi.value = btnUpdate.getAttribute("data-deskripsi");
			colProdukImg.src = `../upload/konten_produk/${btnUpdate.getAttribute(
				"data-goods-img"
			)}`;
			colStatus.value = btnUpdate.getAttribute("data-status");
			colOldImg.value = btnUpdate.getAttribute("data-goods-img");
			colProdukStatus.value = btnUpdate.getAttribute("data-goods-status");
			colProdukNama.value = btnUpdate.getAttribute("data-goods-name");
		});
	}

	accountProfile() {
		const dataAccountProfile = document.getElementById("modalAccountProfile");
	}

	aboutContent() {
		const dataUpdateAboutContent = document.getElementById("modalUbahAbout");

		if (!dataUpdateAboutContent) return;

		dataUpdateAboutContent.addEventListener("show.bs.modal", function (e) {
			const btnUpdate = e.relatedTarget;

			const colAboutId = document.getElementById("about_id");
			const colAboutDesc = document.getElementById("about_desc");
			const colShowImg = document.getElementById("about_img_ubah");
			const colAboutStatus = document.getElementById("about_status_ubah");
			const colOldImg = document.getElementById("old_img");

			colAboutId.value = btnUpdate.getAttribute("data-about-id");
			colAboutDesc.value = btnUpdate.getAttribute("data-about-desc");
			colAboutStatus.value = btnUpdate.getAttribute("data-about-status");
			colShowImg.src = `../upload/konten_about/${btnUpdate.getAttribute(
				"data-about-img"
			)}`;
			colOldImg.value = btnUpdate.getAttribute("data-about-img");
		});
	}

	paymentContent() {
		const dataUpdatePaymentContent =
			document.getElementById("modalUbahPayment");

		if (!dataUpdatePaymentContent) return;

		dataUpdatePaymentContent.addEventListener("show.bs.modal", function (e) {
			const btnUpdate = e.relatedTarget;
			// console.log(btnUpdate);
			const colPaymentId = document.getElementById("payment_id_ubah");
			const colShowImg = document.getElementById("payment_img_tampil");
			const colOldImg = document.getElementById("old_img");
			const colPaymentName = document.getElementById("payment_name_ubah");
			const colPaymentRec = document.getElementById("payment_receiver_ubah");
			const colPaymentTf = document.getElementById("payment_transfer_ubah");
			const colPaymentStatus = document.getElementById("payment_status_ubah");

			colShowImg.src = `../upload/konten_payment/${btnUpdate.getAttribute(
				"data-payment-img"
			)}`;
			colOldImg.value = btnUpdate.getAttribute("data-payment-img");
			colPaymentId.value = btnUpdate.getAttribute("data-payment-id");
			colPaymentName.value = btnUpdate.getAttribute("data-payment-name");
			colPaymentRec.value = btnUpdate.getAttribute("data-payment-receiver");
			colPaymentTf.value = btnUpdate.getAttribute("data-payment-transfer");
			colPaymentStatus.value = btnUpdate.getAttribute("data-payment-status");
		});
	}

	updateTransactionStatus() {
		const dataUpdateTransactionStatus = document.getElementById(
			"modalTransactionStatus"
		);

		if (!dataUpdateTransactionStatus) return;

		dataUpdateTransactionStatus.addEventListener("show.bs.modal", function (e) {
			const btnUpdate = e.relatedTarget;

			const colTransactionID = document.getElementById("transaction_id_ubah");

			const colTransactionDate = document.getElementById(
				"transaction_date_ubah"
			);

			const colTransactionStatus = document.getElementById(
				"transaction_status_ubah"
			);

			const colTransactionTrack = document.getElementById("resi_ubah");

			colTransactionID.value = btnUpdate.getAttribute("data-transaction-id");

			colTransactionDate.value = btnUpdate.getAttribute(
				"data-transaction-date"
			);

			colTransactionStatus.value = btnUpdate.getAttribute(
				"data-transaction-status"
			);

			colTransactionTrack.value = btnUpdate.getAttribute("data-tracking");

			if (btnUpdate.getAttribute("data-transaction-status") == "Menunggu") {
				document.getElementById("batal").classList.remove("d-none");
				document.getElementById("menunggu").classList.add("d-none");
				document.getElementById("proses").classList.remove("d-none");
				document.getElementById("dikirim").classList.add("d-none");
				document.getElementById("form-resi").classList.add("d-none");
			}

			if (btnUpdate.getAttribute("data-transaction-status") == "Proses") {
				document.getElementById("batal").classList.add("d-none");
				document.getElementById("menunggu").classList.add("d-none");
				document.getElementById("proses").classList.add("d-none");
				document.getElementById("dikirim").classList.remove("d-none");
				document.getElementById("form-resi").classList.add("d-none");
			}

			if (btnUpdate.getAttribute("data-transaction-status") == "Dikirim") {
				document.getElementById("batal").classList.add("d-none");
				document.getElementById("menunggu").classList.add("d-none");
				document.getElementById("proses").classList.add("d-none");
				document.getElementById("dikirim").classList.add("d-none");
				document.getElementById("form-resi").classList.remove("d-none");
			}

			if (
				btnUpdate.getAttribute("data-transaction-status") == "Selesai" ||
				btnUpdate.getAttribute("data-transaction-status") == "Batal"
			) {
				document.getElementById("batal").classList.add("d-none");
				document.getElementById("menunggu").classList.add("d-none");
				document.getElementById("proses").classList.add("d-none");
				document.getElementById("dikirim").classList.add("d-none");
				document.getElementById("form-resi").classList.add("d-none");
			}

			colTransactionStatus.addEventListener("click", function (e) {
				if (e.target.value === "Dikirim")
					document.getElementById("form-resi").classList.remove("d-none");
			});
		});
	}

	updateShippingStatus() {
		const dataUpdateShippingStatus = document.getElementById(
			"modalShippingStatus"
		);

		if (!dataUpdateShippingStatus) return;

		dataUpdateShippingStatus.addEventListener("show.bs.modal", function (e) {
			const btnUpdate = e.relatedTarget;

			const colTransactionID = document.getElementById("transaction_id_ubah");
			const colShippingID = document.getElementById("shipping_id_ubah");
			const colTransactionDate = document.getElementById(
				"transaction_date_ubah"
			);
			const colTransactionStatus = document.getElementById(
				"transaction_status_ubah"
			);

			colTransactionID.value = btnUpdate.getAttribute("data-transaction-id");
			colShippingID.value = btnUpdate.getAttribute("data-shipping-id");
			colTransactionDate.value = btnUpdate.getAttribute(
				"data-transaction-date"
			);
			colTransactionStatus.value = btnUpdate.getAttribute(
				"data-transaction-status"
			);
		});
	}

	updateStatusRating() {
		const dataUpdateStatusRating = document.getElementById("modalTesti");

		if (!dataUpdateStatusRating) return;

		dataUpdateStatusRating.addEventListener("show.bs.modal", function (e) {
			const btnUpdate = e.relatedTarget;

			const colTestiID = document.getElementById("testimonial_id");
			const colTestiStatus = document.getElementById("testi_status");

			colTestiID.value = btnUpdate.getAttribute("data-testimonial-id");
			colTestiStatus.value = btnUpdate.getAttribute("data-testi-status");
		});
	}

	validateFormTransactionStatus() {
		const btnTransaksiStatus = document.getElementById("btn_transaksi_status");

		if (!btnTransaksiStatus) return;

		const colResiEl = document.getElementById("form-resi");
		const resiEl = document.getElementById("resi_ubah");

		btnTransaksiStatus.addEventListener("click", function (e) {
			if (!colResiEl.classList.contains("d-none")) {
				if (resiEl.value == "") {
					e.preventDefault();
					Swal.fire({
						icon: "error",
						title: "Ooops...",
						text: "Resi tidak boleh kosong!",
					});
				} else {
					document.getElementById("formTransaction").submit();
				}
			}
		});
	}

	validateLogout() {
		const btnLogout = document.getElementById("btn-logout");

		if (!btnLogout) return;

		btnLogout.addEventListener("click", function (e) {
			e.preventDefault();
			Swal.fire({
				title: "Yakin mau keluar?",
				text: "Anda akan segera meninggalkan halaman",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}).then((result) => {
				if (result.value) {
					Swal.fire(
						"Bye bye...",
						"Anda berhasil keluar halaman",
						"success"
					).then(() => (window.location.href = e.target.getAttribute("href")));
				}
			});
		});
	}

	validateProduct() {
		const btnAddProdukEl = document.getElementById("btnTambahProduk");

		if (!btnAddProdukEl) return;

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} Barang tidak boleh kosong!`,
			});
		};

		// Element Tambah Produk
		const colNama = document.getElementById("nama");
		const colVarian = document.getElementById("varian");
		const colBerat = document.getElementById("berat");
		const colHarga = document.getElementById("harga");
		const colStok = document.getElementById("stok");
		const colImg = document.getElementById("konten_produk_img");
		const colDesk = document.getElementById("desc_content");
		const colStatus = document.getElementById("status_barang");

		btnAddProdukEl.addEventListener("click", function (e) {
			if (colNama.value == "") {
				e.preventDefault();
				sweetAlert("Nama");
			} else if (colVarian.value == "") {
				e.preventDefault();
				sweetAlert("Varian");
			} else if (colBerat.value == "") {
				e.preventDefault();
				sweetAlert("Berat");
			} else if (colHarga.value == "") {
				e.preventDefault();
				sweetAlert("Harga");
			} else if (colStok.value == "") {
				e.preventDefault();
				sweetAlert("Stok");
			} else if (colImg.value == "") {
				e.preventDefault();
				sweetAlert("Gambar");
			} else if (colDesk.value == "") {
				e.preventDefault();
				sweetAlert("Deskripsi");
			} else if (colStatus.value == "") {
				e.preventDefault();
				sweetAlert("Status");
			}
		});

		// Element Ubah Produk
		const btnUpdateProdukEl = document.getElementById("btnUbahProduk");
		const colId = document.getElementById("produkId_ubah");
		const colNamaUbah = document.getElementById("nama_ubah");
		const colVarianUbah = document.getElementById("varian_ubah");
		const colBeratUbah = document.getElementById("berat_ubah");
		const colHargaUbah = document.getElementById("harga_ubah");
		const colStokUbah = document.getElementById("stok_ubah");

		btnUpdateProdukEl.addEventListener("click", function (e) {
			if (colNamaUbah.value == "") {
				e.preventDefault();
				sweetAlert("Nama");
			} else if (colVarianUbah.value == "") {
				e.preventDefault();
				sweetAlert("Varian");
			} else if (colBeratUbah.value == "") {
				e.preventDefault();
				sweetAlert("Berat");
			} else if (colHargaUbah.value == "") {
				e.preventDefault();
				sweetAlert("Harga");
			} else if (colStokUbah.value == "") {
				e.preventDefault();
				sweetAlert("Stok");
			} else if (colId.value == "") {
				e.preventDefault();
				sweetAlert("ID Produk");
			}
		});

		$(".modal").on("hidden.bs.modal", function () {
			$(this).find("form").trigger("reset");
		});
	}

	validateProductContent() {
		const btnUpdateProductContent = document.getElementById(
			"btnUbahProdukKonten"
		);

		if (!btnUpdateProductContent) return;

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} tidak boleh kosong!`,
			});
		};

		const colId = document.getElementById("kontenId_ubah");
		const colDesk = document.getElementById("deskripsiKonten_ubah");
		const colStatus = document.getElementById("status_ubah");
		const colStatusContent = document.getElementById("goods_status_ubah");
		const colNama = document.getElementById("goods_nama_ubah");

		btnUpdateProductContent.addEventListener("click", function (e) {
			if (colId.value == "") {
				e.preventDefault();
				sweetAlert("ID Produk");
			} else if (colDesk.value == "") {
				e.preventDefault();
				sweetAlert("Deskripsi");
			} else if (colStatus.value == "") {
				e.preventDefault();
				sweetAlert("Status Barang");
			} else if (colStatusContent.value == "") {
				e.preventDefault();
				sweetAlert("Status Konten");
			} else if (colNama.value == "") {
				e.preventDefault();
				sweetAlert("Nama Barang");
			}
		});
	}

	validateAboutUs() {
		const btnAddAbout = document.getElementById("btnTambahAbout");

		if (!btnAddAbout) return;

		const colDesk = document.getElementById("deskripsi");
		const colImg = document.getElementById("about_img");
		const colStatus = document.getElementById("about_status");

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} tidak boleh kosong!`,
			});
		};

		btnAddAbout.addEventListener("click", function (e) {
			if (colDesk.value == "") {
				e.preventDefault();
				sweetAlert("Deskripsi");
			} else if (colImg.value == "") {
				e.preventDefault();
				sweetAlert("Gambar");
			} else if (colStatus.value == "") {
				e.preventDefault();
				sweetAlert("Status Konten");
			}
		});

		const btnUpdateAbout = document.getElementById("btnUbahAbout");

		const colId = document.getElementById("about_id");
		const colDeskUbah = document.getElementById("about_desc");
		const colStatusUbah = document.getElementById("about_status_ubah");

		btnUpdateAbout.addEventListener("click", function (e) {
			if (colId.value == "") {
				e.preventDefault();
				sweetAlert("ID Konten");
			} else if (colDeskUbah.value == "") {
				e.preventDefault();
				sweetAlert("Deskripsi");
			} else if (colStatusUbah.value == "") {
				e.preventDefault();
				sweetAlert("Status Konten");
			}
		});
	}

	validatePayment() {
		const btnAddPayment = document.getElementById("btnAddPayment");

		if (!btnAddPayment) return;

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} tidak boleh kosong!`,
			});
		};

		$(".modal").on("hidden.bs.modal", function () {
			$(this).find("form").trigger("reset");
		});

		const colImg = document.getElementById("payment_img");
		const colNama = document.getElementById("payment_name");
		const colRec = document.getElementById("payment_receiver");
		const colTra = document.getElementById("payment_transfer");
		const colStatus = document.getElementById("payment_status");

		btnAddPayment.addEventListener("click", function (e) {
			if (colImg.value == "") {
				e.preventDefault();
				sweetAlert("Gambar");
			} else if (colNama.value == "") {
				e.preventDefault();
				sweetAlert("Nama Pembayaran");
			} else if (colRec.value == "") {
				e.preventDefault();
				sweetAlert("Nama Penerima");
			} else if (colTra.value == "") {
				e.preventDefault();
				sweetAlert("Nomor Transfer");
			} else if (colStatus.value == "") {
				e.preventDefault();
				sweetAlert("Status");
			}
		});

		const btnUpdatePayment = document.getElementById("btnUbahPayment");

		const colId = document.getElementById("payment_id_ubah");
		const colNamaUbah = document.getElementById("payment_name_ubah");
		const colRecUbah = document.getElementById("payment_receiver_ubah");
		const colTraUbah = document.getElementById("payment_transfer_ubah");
		const colStatusUbah = document.getElementById("payment_status_ubah");

		btnUpdatePayment.addEventListener("click", function (e) {
			if (colId.value == "") {
				e.preventDefault();
				sweetAlert("ID Pembayaran");
			} else if (colNamaUbah.value == "") {
				e.preventDefault();
				sweetAlert("Nama Pembayaran");
			} else if (colRecUbah.value == "") {
				e.preventDefault();
				sweetAlert("Nama Penerima");
			} else if (colTraUbah.value == "") {
				e.preventDefault();
				sweetAlert("Nomor Transfer");
			} else if (colStatusUbah.value == "") {
				e.preventDefault();
				sweetAlert("Status Konten");
			}
		});
	}

	validateTestimonial() {
		const btnUbahTesti = document.getElementById("btnUbahTesti");

		if (!btnUbahTesti) return;

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} tidak boleh kosong!`,
			});
		};

		const colId = document.getElementById("testimonial_id");
		const colStatus = document.getElementById("testi_status");

		btnUbahTesti.addEventListener("click", function (e) {
			if (colId.value == "") {
				e.preventDefault();
				sweetAlert("ID Pembayaran");
			} else if (colStatus.value == "") {
				e.preventDefault();
				sweetAlert("Status Konten");
			}
		});
	}

	transactionDetail() {
		const modalTransactionDetail = document.getElementById(
			"modalTransactionDetail"
		);

		if (!modalTransactionDetail) return;

		const url = `${this._url}admin/transaksi_detail/`;

		const convertRupiah = function (number) {
			const number_string = number.toString();

			let sisa = number_string.length % 3;
			let rupiah = number_string.substr(0, sisa);
			let ribuan = number_string.substr(sisa).match(/\d{3}/g);

			if (ribuan) {
				let separator = sisa ? "." : "";
				rupiah += separator + ribuan.join(".");
				return rupiah;
			}
		};

		$("#modalTransactionDetail").on("show.bs.modal", function (e) {
			const btnId = e.relatedTarget;

			const dataTransaction = async function (transaction_id) {
				try {
					const dataId = await fetch(`${url}${transaction_id}`);

					const [data] = await dataId.json();

					document.querySelector("#transaction_id").textContent =
						data.transaction_id;
					document.querySelector("#account_name").textContent =
						data.account_name;
					document.querySelector("#nomor_telp").textContent = data.nomor_telp;
					document.querySelector(
						"#alamat"
					).innerHTML = `<span class="float-end">${data.alamat}</span><br><span class="float-end">Kec. ${data.kecamatan}, ${data.kota}</span><br><span class="float-end">${data.provinsi}, Kode Pos ${data.kode_pos}</span>`;
					document.querySelector("#pengiriman").textContent = data.shipping;
					document.querySelector("#ongkir").textContent = `Rp${convertRupiah(
						data.shipping_cost
					)}`;
					document.querySelector(
						"#nama"
					).textContent = `${data.nama} ${data.varian}`;
					document.querySelector(
						"#estimasi_day"
					).textContent = `${data.estimated_day} Hari`;
					document.querySelector("#harga").textContent = `Rp${convertRupiah(
						data.harga
					)}`;
					document.querySelector("#qty").textContent = `${data.qty} buah`;
					document.querySelector(
						"#total_beli"
					).textContent = `Rp${convertRupiah(data.trs_detail_total)}`;
					document.querySelector(
						"#total_bayar"
					).textContent = `Rp${convertRupiah(
						+data.transaction_total + +data.shipping_cost
					)}`;
				} catch (error) {
					console.log(`Error nih ${error}`);
				}
			};

			dataTransaction(btnId.getAttribute("data-transaction-id"));
		});
	}
}

const simasdang = new App();
