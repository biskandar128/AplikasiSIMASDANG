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
        <link rel="stylesheet" href="<?= base_url('asset/sweetalert2/sweetalert2.min.css'); ?>">
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
								><i class="fas fa-arrow-left mr-2"></i> Detail Produk</a
							>
						</h2>
					</div>
				</div>
			</div>

            <section class="section-form-transaksi mt-3 mb-5">
                <div class="container">
                <div class="card">
                    <div class="card-body">
                    <div class="card-title text-center">
                        <h2>Isi Formulir Pemesanan</h2>
                    </div>
                    <form action="<?= base_url('user/pemesanan'); ?>" method="post">
                        <div class="row">
                            <div class="col-12">                            
                                <div class="form-group">
                                    <label for="username">Atas Nama</label>
                                    <input
                                        class="form-control"
                                        name="username"
                                        id="username"
                                        data-account-id="<?= $this->session->userdata('user_logged')->account_id; ?>"
                                        required
                                        value="<?= $DataAccount->username; ?>"
                                        readonly          
                                        />
                                </div>
                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        aria-describedby="emailHelp"
                                        name="email"
                                        id="email"
                                        required      
                                        value="<?= $DataAccount->email; ?>"
                                        readonly
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telp"
                                        >No Hp / Whatss App</label
                                    >
                                    <input
                                        type="number"
                                        class="form-control"
                                        name="nomor_telp"
                                        id="nomor_telp"
                                        required
                                        value="<?= $DataAccount->nomor_telp; ?>"
                                        readonly
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_beli">Varian</label>
                                    <input
                                        type="text"
                                        required
                                        class="form-control"
                                        name="varian"
                                        value="<?= "{$product_detail->nama} {$product_detail->varian}"; ?> "
                                        readonly
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_beli">Jumlah beli (Qty)</label>
                                    <input
                                        type="number"
                                        name="qty"
                                        id="jumlah_beli"
                                        required
                                        class="form-control"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input
                                        class="form-control"
                                        id="harga"
                                        type="text"                                    
                                        required
                                        data-harga="<?= $product_detail->harga; ?>"
                                        value="Rp<?= number_format($product_detail->harga, 0, '', '.'); ?>"
                                    />
                                    <input type="hidden" name="goods_id" id="goods_id" value="<?= $product_detail->goods_id; ?>">
                                </div>                               
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <select name="address_id" id="addressId" class="form-control">
                                        <option value="" disabled selected>-- Pilih Alamat--</option>


                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="ongkir">Pengiriman</label>
                                    <select name="ongkir" id="ongkir" class="form-control">
                                        <option value="" disabled selected>-- Pilih Durasi Pengiriman--</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input
                                        class="form-control"
                                        id="total"
                                        type="text"
                                        required
                                        name="total"
                                    />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnPesanProduk">Pesan</button
                        >
                    </form>
                    </div>
                </div>
                </div>
            </section>
        </main>

    <section class="coppy-right">
      <p class="text-center">&copy; 2021 All Rights Reserved</p>
    </section>

    <svg
      style="margin-bottom: -20px"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1440 320"
    >
      <path
        fill="#FF5944"
        fill-opacity="1"
        d="M0,288L20,272C40,256,80,224,120,197.3C160,171,200,149,240,144C280,139,320,149,360,149.3C400,149,440,139,480,122.7C520,107,560,85,600,69.3C640,53,680,43,720,48C760,53,800,75,840,106.7C880,139,920,181,960,213.3C1000,245,1040,267,1080,250.7C1120,235,1160,181,1200,170.7C1240,160,1280,192,1320,208C1360,224,1400,224,1420,224L1440,224L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"
      ></path>
    </svg>

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
    <script src="<?= base_url('asset/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
    </body>
</html>