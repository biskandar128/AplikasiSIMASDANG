<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS -->
        <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
        />

        <link
        rel="stylesheet"
        href="<?= base_url('asset/Frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>"
        />
        <link rel="stylesheet" href="<?= base_url('asset/Frontend/assets/vendor/fontawesome/css/all.min.css'); ?>" />
        <link 
        rel="stylesheet"
        href="<?= base_url('asset/Frontend/assets/vendor/OwlCarousel/src/scss/owl.carousel.css'); ?>"
        />
        <link
        rel="stylesheet"
        href="<?= base_url('asset/Frontend/assets/vendor/OwlCarousel/src/scss/owl.theme.default.css'); ?>"
        />
        <link rel="icon" href="<?= base_url('asset/Frontend/img/logo_icon.ico'); ?>" />
        <link rel="stylesheet" href="<?= base_url('asset/Frontend/css/style.css'); ?>" />

        <title>SIMASDANG</title>
    </head>
    <body>        
		<main>
			<section class="header-detail-produk">
				<div class="container text-center">
					<img src="<?= base_url('asset/Frontend/img/logo.png'); ?>" alt="" />
				</div>
			</section>

			<div class="container">
				<div class="card card-detail">
					<div class="card-body">
						<h2>
							<a href="<?= base_url('user'); ?>" class="btn text-detail"
								><i class="fas fa-arrow-left mr-2"></i> Beranda</a
							>
						</h2>
					</div>
				</div>
			</div>

			<section class="section-produk-detail">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-12">
							<img
								src="<?= base_url('upload/konten_produk/'.$product_detail->goods_img); ?>"
								class="img-fluid img-thumbnail"
								alt=""
							/>
						</div>
						<div class="col-lg-8 col-12">
							<h2>Rp<?= number_format($product_detail->harga, 0, '', '.'); ?></h2>
							<h4>Sambal Gendang - <?= $product_detail->nama; ?> <?= $product_detail->varian; ?></h4>
							<p>
								<strong>Expire: </strong>1 Minggu (Suhu Normal) || 1 Bulan (Suhu
								Dingin)
							</p>
							<p><strong>Berat: </strong><?= $product_detail->berat; ?> gram</p>
							<p><strong>Status: </strong><?= ($product_detail->status) ? 'Pre-order' : 'Ready'; ?></p>
							<p> 
								<strong>Deskripsi:</strong><br>
								<?= $product_detail->deskripsi; ?>
							</p>
							<br />
							<p>
								<span><i class="fas fa-map-marker-alt"></i> Dari </span
								>Kota Bogor
							</p>							
							<p>
								<span><i class="fas fa-map-marker-alt"></i> Dikirim ke </span
								><?= "{$account->alamat}, Kec. {$account->kecamatan}"; ?>
							</p>
							<p>
								<span
									><i class="fas fa-truck-moving"></i> Ongkir <?= $ongkir->description; ?>:
								</span>
								Rp<?= number_format($ongkir->cost[0]->value, 0, '', '.'); ?> (Estimasi <?= $ongkir->cost[0]->etd; ?> Hari)
							</p>
							<div class="shopping-cart">
								<!-- Title -->
								<div class="title">Stok Tersedia Hanya: <span class="bg-danger text-white px-2 py-2 rounded"><?= $product_detail->stok; ?> buah</span></div>
								<!-- Product #3 -->
								<div class="title">Jumlah Pembelian</div>
								<div class="item">
								<div class="quantity">
									<button class="minus-btn" type="button" name="button">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="1.5em"
											height="1.5em"
											fill="currentColor"
											class="bi bi-dash"
											viewBox="2 0 16 14"
										>
											<path
											d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"
											/>
										</svg>
									</button>
									<input type="text" name="name" id="stokProduk" />
									<button class="plus-btn" type="button" name="button">
										<svg
											xmlns="http://www.w3.org/2000/svg"
											width="1.5em"
											height="1.5em"
											fill="currentColor"
											class="bi bi-plus"
											viewBox="2 0 16 14"
										>
											<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
											/>
										</svg>
									</button>
								</div>
								</div>
							</div>
							<div class="btn-check-out">
								<a href="<?= base_url('user/pemesanan/'.$product_detail->goods_id); ?>" id="btnOrder" class="btn btn-info w-25 mt-3 btn-beli">Beli</a>
								<a href="<?= base_url('user/preorder/'.$product_detail->goods_id); ?>" class="btn btn-outline-info btn-pre mt-3 btn-preorder w-25"
									>Pre-order</a
								>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>

		<!-- footer -->
		<footer class="footer mt-5 custom-footer" id="footer">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-sm mt-4 partner">
						<h2>Partner</h2>
						<img src="<?= base_url('asset/Frontend/img/img6.jpg'); ?>" alt="Partner image" />
					</div>
					<div class="col-sm mt-4 tautan-langsung">
						<h2>Tautan Langsung</h2>
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="#">Beranda</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#tentang-kami">Tentang Kami</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#produk">Produk</a>
							</li>
						</ul>
					</div>
					<div class="col-sm mt-4 kontak">
						<h2>Kontak</h2>
						<ul class="navbar-nav">
							<li class="nav-item">
								<i class="bi-telephone-fill"
									><a class="link" href="">0878767508</a></i
								>
							</li>
							<li class="nav-item">
								<i class="bi-whatsapp inline">
									<a class="link" href="">0898767565</a>
								</i>
							</li>
							<li class="nav-item">
								<i class="bi-instagram">
									<a class="" href="link"> @sambalgendangid_</a>
								</i>
							</li>
						</ul>
						<img src="<?= base_url('asset/Frontend/img/tokopedia.png'); ?>" width="50" alt="tokopedia" />
						<a class="" href="https://tokopedia.link/IVHOlaVvxgb"
							>Sambalgendangid</a
						>
					</div>
				</div>
			</div>
		</footer>
		<!-- akhir footer -->
		<section class="coppy-right mt-4">
			<p class="text-center">&copy; 2021 All Rights Reserved</p>
		</section>
		<!-- back to top -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
        ></script>
        <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
        ></script>
    	<script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
    </body>
</html>