"use strict";

class App {
	constructor() {
		this.countTotalOrder();
		this.userDashboard();
		this.userHistory();
		this.searchCity();
		this.productDetail();
		this.processPayment();
		this.unSession();
		this.searchCityUpdate();

		// Validate
		this.validateLogout();
		this.validateUserAccount();
		this.validateRating();
		this.validateFormTransaction();
	}

	_url = "http://localhost:8080/simasdang/user";
	_urlUnSession = "http://localhost:8080/simasdang/";
	_urlPage = window.location.href;

	searchCityUpdate() {
		const selectCity = document.getElementById("city_id");

		if (!selectCity) return;

		$("#city_id").select2({
			placeholder: "--Pilih Kota Asal--",
			allowClear: true,
			width: "100%",
		});

		const urlSearchCity = `${this._urlUnSession}landingcontroller/cekKota`;

		document.addEventListener("DOMContentLoaded", function (e) {
			const cityList = async function () {
				try {
					const city = await fetch(urlSearchCity);
					const listCity = await city.json();

					listCity.rajaongkir.results.forEach((e) => {
						selectCity.insertAdjacentHTML(
							"beforeend",
							`<option value="${e.city_id},${e.province},${e.type} ${e.city_name}">${e.province}, ${e.type} ${e.city_name}</option>`
						);
					});
				} catch (error) {
					console.error(error);
				}
			};

			cityList();
		});
	}

	searchCity() {
		const btnAddressEl = document.querySelector(".btn-address");

		if (!btnAddressEl) return;

		const selectCity = document.getElementById("userAddress");
		const listUserAddress = document.getElementById("listUserAddress");

		$("#userAddress").select2({
			placeholder: "--Pilih Kota Asal--",
			allowClear: true,
			width: "100%",
		});

		const urlSearchCity = `${this._urlUnSession}landingcontroller/cekKota`;
		const urlUserAddress = `${this._urlUnSession}landingcontroller/UserAddress`;
		const urlDeleteUserAddress = `${this._urlUnSession}user/account/address/delete`;
		const urlUpdateUserAddress = `${this._urlUnSession}user/account/address/update`;

		btnAddressEl.addEventListener("click", function (e) {
			document.getElementById("formUbahAlamat").classList.add("d-none");
		});

		// Load Data
		document.addEventListener("DOMContentLoaded", function (e) {
			const cityList = async function () {
				try {
					const city = await fetch(urlSearchCity);
					const userAddress = await fetch(urlUserAddress);

					const listAddress = await userAddress.json();
					const listCity = await city.json();

					listAddress.forEach(async (e) => {
						if (e.deleted == 0) {
							listUserAddress.insertAdjacentHTML(
								"beforeend",
								`<div class="card mb-3"> 
									<div class="container py-2">
										${e.alamat}, <br>
										Kec. ${e.kecamatan} <br>
										${e.kota}, <br>
										${e.provinsi}, Kode POS ${e.kode_pos} <br>
										<a href="${urlUpdateUserAddress}/${e.address_id}" id="ubahAlamat" data-address-id="${e.address_id}">Ubah</a>&nbsp;
										<a href="${urlDeleteUserAddress}/${e.address_id}">Hapus</a>
									</div>
								</div>
								`
							);
						}
					});

					listCity.rajaongkir.results.forEach((e) => {
						selectCity.insertAdjacentHTML(
							"beforeend",
							`<option value="${e.city_id},${e.province},${e.type} ${e.city_name}">${e.province}, ${e.type} ${e.city_name}</option>`
						);
					});

					document.getElementById("loadingAddress").classList.add("d-none");
				} catch (error) {
					console.error(error);
				}
			};

			cityList();
		});
	}

	countTotalOrder() {
		const qty = document.getElementById("jumlah_beli");

		if (!qty) return;

		let productUrl = this._urlPage.split("/");
		let totalHarga;
		let ongkir;
		const harga = document.getElementById("harga");
		const total = document.getElementById("total");
		const ongkirEl = document.getElementById("ongkir");

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

		if (
			this._urlPage ==
			`${this._url}/pemesanan/${productUrl.slice(-2).join("/")}`
		) {
			qty.readOnly = harga.readOnly = total.readOnly = true;
			qty.value = productUrl.slice(-1).join();
			total.value = +harga.getAttribute("data-harga");

			totalHarga =
				Number.parseInt(qty.value) *
				Number.parseInt(+harga.getAttribute("data-harga"));
			total.value = `Rp${convertRupiah(totalHarga)}` || 0;
		} else if (
			this._urlPage == `${this._url}/preorder/${productUrl.slice(-1).join()}`
		) {
			harga.readOnly = total.readOnly = true;
			qty.value = 1;
			totalHarga =
				Number.parseInt(qty.value) *
				Number.parseInt(+harga.getAttribute("data-harga"));
			total.value = `Rp${convertRupiah(totalHarga)}` || 0;

			qty.addEventListener("keyup", function (e) {
				totalHarga =
					Number.parseInt(qty.value) *
					Number.parseInt(+harga.getAttribute("data-harga"));
				total.value = `Rp${convertRupiah(totalHarga)}` || 0;
			});
		}

		ongkirEl.addEventListener("change", function (e) {
			ongkir = +e.target.value.split(",")[1];
			total.value = `Rp${convertRupiah(totalHarga + ongkir)}`;
		});
	}

	userDashboard() {
		const myButton = document.getElementById("myBtn");

		if (!myButton) return;

		const scrollFunction = () =>
			document.body.scrollTop > 100 || document.documentElement.scrollTop > 100
				? (myButton.style.display = "block")
				: (myButton.style.display = "none");

		myButton.addEventListener("click", function () {
			document.documentElement.scrollTop = 0;
		});

		window.onscroll = function () {
			scrollFunction();
		};
		// owlCarousel
		$(".owl-carousel").owlCarousel({
			stagePadding: 50,
			center: true,
			loop: true,
			margin: 10,
			nav: true,
			responsiveClass: true,
			responsive: {
				0: {
					items: 1,
				},
				768: {
					items: 2,
				},
				1366: {
					items: 3,
				},
			},
		});
	}

	productDetail() {
		if (
			!(
				this._urlPage ==
				`${this._url}/produk/${this._urlPage.split("/").slice(-1).join()}`
			)
		)
			return;

		let stokProduk = JSON.parse(
			$.ajax({
				url: `${this._url}/stokproduk/${this._urlPage.split("/").slice(-1)[0]}`,
				type: "GET",
				dataType: "json",
				async: false,
				success(data) {
					return data;
				},
			}).responseText
		).stok;

		if (stokProduk == 0) {
			document.querySelector(".shopping-cart").classList.add("d-none");
			document.querySelector(".btn-beli").classList.add("d-none");
			return;
		}

		document.querySelector(".btn-preorder").classList.add("d-none");

		const btnOrderEl = document.getElementById("btnOrder");
		const stokProdukDetailEl = document.getElementById("stokProduk");
		let orderUrl = btnOrderEl.href;

		stokProdukDetailEl.readOnly = true;
		stokProdukDetailEl.value = 1;
		btnOrderEl.href = `${btnOrderEl.href}/1`;

		$(".minus-btn").on("click", function (e) {
			e.preventDefault();
			btnOrderEl.href = "";

			const $this = $(this);
			const $input = $this.closest("div").find("input");
			let value = Number.parseInt($input.val());

			if (value > 1) {
				value = value - 1;
			} else {
				value = 1;
			}

			$input.val(value);
			btnOrderEl.href = `${orderUrl}/${value}`;
		});

		$(".plus-btn").on("click", function (e) {
			e.preventDefault();
			btnOrderEl.href = "";

			const $this = $(this);
			const $input = $this.closest("div").find("input");
			let value = Number.parseInt($input.val());

			if (value < stokProduk) {
				value = value + 1;
			} else {
				value = stokProduk;
			}

			$input.val(value);
			btnOrderEl.href = `${orderUrl}/${value}`;
		});
	}

	processPayment() {
		const formPaymentAction = document.getElementById("formProcessPayment");

		if (!formPaymentAction) return;

		formPaymentAction.action = `${formPaymentAction.action}/${this._urlPage
			.split("/")
			.slice(-1)}`;
	}

	unSession() {
		if (
			!(
				this._urlPage ==
				`${this._urlUnSession}produk_detail/${this._urlPage
					.split("/")
					.slice(-1)
					.join()}`
			)
		)
			return;

		let stokProduk = JSON.parse(
			$.ajax({
				url: `${this._urlUnSession}/stokproduk/${
					this._urlPage.split("/").slice(-1)[0]
				}`,
				type: "GET",
				dataType: "json",
				async: false,
				success(data) {
					return data;
				},
			}).responseText
		).stok;

		if (stokProduk == 0) {
			document.querySelector(".shopping-cart").classList.add("d-none");
			document.querySelector(".btn-beli").classList.add("d-none");
			return;
		}

		document.querySelector(".btn-preorder").classList.add("d-none");

		const btnOrderEl = document.getElementById("btnOrder");
		const stokProdukDetailEl = document.getElementById("stokProduk");
		let orderUrl = btnOrderEl.href;

		stokProdukDetailEl.readOnly = true;
		stokProdukDetailEl.value = 1;
		btnOrderEl.href = `${btnOrderEl.href}/1`;

		$(".minus-btn").on("click", function (e) {
			e.preventDefault();
			btnOrderEl.href = "";

			const $this = $(this);
			const $input = $this.closest("div").find("input");
			let value = Number.parseInt($input.val());

			if (value > 1) {
				value = value - 1;
			} else {
				value = 1;
			}

			$input.val(value);
			btnOrderEl.href = `${orderUrl}/${value}`;
		});

		$(".plus-btn").on("click", function (e) {
			e.preventDefault();
			btnOrderEl.href = "";

			const $this = $(this);
			const $input = $this.closest("div").find("input");
			let value = Number.parseInt($input.val());

			if (value < stokProduk) {
				value = value + 1;
			} else {
				value = stokProduk;
			}

			$input.val(value);
			btnOrderEl.href = `${orderUrl}/${value}`;
		});
	}

	userHistory() {
		const dataTableHistory = document.getElementById("dataTable-user");

		if (!dataTableHistory) return;

		$("#dataTable-user").DataTable();
		const url = `${this._url}/history/detail/`;

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

		$("#dataHistory").on("show.bs.modal", function (e) {
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
					).innerHTML = `<span class="float-right">${data.alamat}</span><br><span class="float-right">Kec. ${data.kecamatan}, ${data.kota}</span><br><span class="float-right">${data.provinsi}, Kode Pos ${data.kode_pos}</span>`;
					document.querySelector("#pengiriman").textContent = data.shipping;
					document.querySelector("#ongkir").textContent = `Rp${convertRupiah(
						data.shipping_cost
					)}`;
					document.querySelector(
						"#nama"
					).textContent = `${data.nama} ${data.varian}`;
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
					document.querySelector("#tanggal").textContent =
						data.transaction_date;
					document.querySelector("#pengiriman_date").textContent =
						data.delivered_date != "0000-00-00"
							? data.delivered_date
							: "Belum tersedia";
					document.querySelector("#estimated_day").textContent =
						data.estimated_date != "0000-00-00"
							? data.estimated_date
							: "Belum tersedia";
				} catch (error) {
					console.log(`Error nih ${error}`);
				}
			};

			dataTransaction(btnId.getAttribute("data-transactionId"));
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

	validateUserAccount() {
		const btnUpdateProfile = document.getElementById("btnUbahProfile");

		if (!btnUpdateProfile) return;

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

		const colId = document.getElementById("account_id");
		const colName = document.getElementById("nama_ubah");
		const colUsername = document.getElementById("username");
		const colEmail = document.getElementById("email");
		const colBirth = document.getElementById("tgl_lahir");
		const colPhone = document.getElementById("nomor_telp");

		btnUpdateProfile.addEventListener("click", function (e) {
			if (colId.value == "") {
				e.preventDefault();
				sweetAlert("ID Akun");
			} else if (colName.value == "") {
				e.preventDefault();
				sweetAlert("Nama Kamu");
			} else if (colUsername.value == "") {
				e.preventDefault();
				sweetAlert("Username Kamu");
			} else if (colEmail.value == "") {
				e.preventDefault();
				sweetAlert("Email Kamu");
			} else if (colBirth.value == "") {
				e.preventDefault();
				sweetAlert("Tanggal Lahir Kamu");
			} else if (colPhone.value == "") {
				e.preventDefault();
				sweetAlert("Nomor Telepon Kamu");
			}
		});

		const btnUpdatePassword = document.getElementById("btnUbahPassword");
		const colPassword = document.getElementById("password");
		const colConfirm = document.getElementById("konfirmasi_password");

		btnUpdatePassword.addEventListener("click", function (e) {
			if (colPassword.value == "") {
				e.preventDefault();
				sweetAlert("Password");
			} else if (colConfirm.value == "") {
				e.preventDefault();
				sweetAlert("Konfirmasi Password,");
			} else if (colPassword.value !== colConfirm.value) {
				e.preventDefault();
				Swal.fire({
					icon: "error",
					title: "Ooops...",
					text: `Harap konfirmasi password dengan baik!`,
				});
			}
		});

		const btnUpdateAddress = document.getElementById("btnUbahAlamat");
		const btnAddAddress = document.getElementById("btnTambahAlamat");
		const colUserAddress = document.getElementById("userAddress");
		const colKecamatan = document.getElementById("kecamatan");
		const colPos = document.getElementById("pos");
		const colAlamat = document.getElementById("alamat");

		btnUpdateAddress.addEventListener("click", function (e) {
			if (colUserAddress.value == "") {
				e.preventDefault();
				sweetAlert("Kota asal");
			} else if (colKecamatan.value == "") {
				e.preventDefault();
				sweetAlert("Kecamatan");
			} else if (colPos.value == "") {
				e.preventDefault();
				sweetAlert("Kode Pos");
			} else if (colAlamat.value == "") {
				e.preventDefault();
				sweetAlert("Alamat");
			}
		});

		btnAddAddress.addEventListener("click", function (e) {
			if (colUserAddress.value == "") {
				e.preventDefault();
				sweetAlert("Kota asal");
			} else if (colKecamatan.value == "") {
				e.preventDefault();
				sweetAlert("Kecamatan");
			} else if (colPos.value == "") {
				e.preventDefault();
				sweetAlert("Kode Pos");
			} else if (colAlamat.value == "") {
				e.preventDefault();
				sweetAlert("Alamat");
			}
		});
	}

	validateRating() {
		const btnRating = document.getElementById("btnRating");

		if (!btnRating) return;

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} tidak boleh kosong!`,
			});
		};

		btnRating.addEventListener("click", function (e) {
			let star;

			if (document.getElementById("star1").checked) {
				star = document.getElementById("star1").value;
			} else if (document.getElementById("star2").checked) {
				star = document.getElementById("star2").value;
			} else if (document.getElementById("star3").checked) {
				star = document.getElementById("star3").value;
			} else if (document.getElementById("star4").checked) {
				star = document.getElementById("star4").value;
			} else if (document.getElementById("star5").checked) {
				star = document.getElementById("star5").value;
			}

			if (!star) {
				e.preventDefault();
				sweetAlert("Rating Bintang");
			} else if (document.getElementById("ulasan").value == "") {
				e.preventDefault();
				sweetAlert("Ulasan");
			}
		});
	}

	validateFormTransaction() {
		const btnPesan = document.getElementById("btnPesanProduk");

		if (!btnPesan) return;

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} tidak boleh kosong!`,
			});
		};

		const urlUserAddress = `${this._urlUnSession}landingcontroller/UserAddress`;
		const urlUserOngkir = `${this._urlUnSession}landingcontroller/cekOngkir`;

		const colAlamat = document.getElementById("addressId");

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

		document.addEventListener("DOMContentLoaded", function (e) {
			const cityList = async function () {
				try {
					const userAddress = await fetch(urlUserAddress);

					const listAddress = await userAddress.json();

					listAddress.forEach(async (e) => {
						if (e.deleted == 0) {
							colAlamat.insertAdjacentHTML(
								"beforeend",
								`<option value="${e.address_id},${e.city_id}">${e.alamat}, Kec. ${e.kecamatan}, ${e.kota}, ${e.provinsi}, Kode POS ${e.kode_pos}</option>`
							);
						}
					});
				} catch (error) {
					console.error(error);
				}
			};

			cityList();
		});

		$("#addressId").on("change", function (e) {
			const id = e.target.value.split(",")[1];
			$.get(`${urlUserOngkir}/${id}`, function (data) {
				$("#ongkir").empty();
				$("#ongkir").append(
					'<option value="" disabled selected>-- Pilih Durasi Pengiriman--</option>'
				);
				$.each(JSON.parse(data).rajaongkir.results[0].costs, function (i, e) {
					$("#ongkir").append(
						`<option value="JNE ${e.service},${e.cost[0].value},${
							e.cost[0].etd
						}">JNE ${e.service} (Rp${convertRupiah(
							e.cost[0].value
						)}) : Estimasi ${e.cost[0].etd} Hari</option>`
					);
				});
			});
		});

		const colEmail = document.getElementById("email");
		const colTelp = document.getElementById("nomor_telp");
		const colQty = document.getElementById("jumlah_beli");
		const colHarga = document.getElementById("harga");
		const colBarang = document.getElementById("goods_id");
		const colTotal = document.getElementById("total");
		const colOngkir = document.getElementById("ongkir");

		btnPesan.addEventListener("click", function (e) {
			if (colAlamat.value == "") {
				e.preventDefault();
				sweetAlert("Alamat");
			} else if (colEmail.value == "") {
				e.preventDefault();
				sweetAlert("Email");
			} else if (colTelp.value == "") {
				e.preventDefault();
				sweetAlert("Nomor Telepon");
			} else if (colQty.value == "") {
				e.preventDefault();
				sweetAlert("Jumlah Beli");
			} else if (colHarga.value == "") {
				e.preventDefault();
				sweetAlert("Harga");
			} else if (colBarang.value == "") {
				e.preventDefault();
				sweetAlert("ID Barang");
			} else if (colTotal.value == "") {
				e.preventDefault();
				sweetAlert("Total Beli");
			} else if (colOngkir.value == "") {
				e.preventDefault();
				sweetAlert("Durasi Pengiriman");
			}
		});
	}
}

const simasdang = new App();
