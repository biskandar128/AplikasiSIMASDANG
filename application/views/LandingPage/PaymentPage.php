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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                Beranda
                            </li>
                            <li class="breadcrumb-item">
                                Details
                            </li>
                            <li class="breadcrumb-item">
                                Form
                            </li>
                            <li class="breadcrumb-item">
                                Checkout
                            </li>
                            <li class="breadcrumb-item active">
                                Pembayaran
                            </li>
                        </ol>
					</div>
				</div>
			</div>

			<section class="section-payments mt-3 mb-5">
				<div class="container">
					<div class="card">
						<div class="card-body">
							<div class="card-title mb-5">
								<h2 class="text-center">Pilih Metode Pembayaran</h2>
							</div>

                            <form action="<?= base_url('user/proses_payment'); ?>" method="post" id="formProcessPayment">
                                <?php if (!empty($payments)) : $i = 0; foreach ($payments as $payment) : ?>
                                <!-- Payments 1 -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                    <label class="btn-payment" for="<?= 'btn-payment-'.$payment->payment_id; ?>">
                                        <div class="row">
                                        <div class="col-lg-2 col-4 text-center">
                                            <img src="<?= base_url('upload/konten_payment/'.$payment->payment_img); ?>" class="img-fluid" width="450" alt="" />
                                        </div>
                                        <div class="col-lg-10 col-8">
                                            <p style="margin-right: 50px;">
                                            <span class="method-payment" style="font-weight: 700;"><?= $payment->payment_name; ?></span><br />
                                            <span>Hanya menerima pembayaran dari <?= $payment->payment_name; ?></span>
                                            </p>
                                        </div>
                                        </div>
                                    </label>

                                    <input
                                        type="checkbox"
                                        class="form-check-input check-payment"
                                        id="<?= 'btn-payment-'.$payment->payment_id; ?>"
                                        value="<?= $payment->payment_id; ?>"
                                        name="payment_id"
                                    />
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                                <!-- Button -->
                                <button type="submit" class="btn btn-info">Pesan</button>
                            </form>

							
						</div>
					</div>
				</div>
			</section>
		</main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>		
    <script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
    <script>
        $(document).ready(function () {
            $('[type="checkbox"]').change(function () {
                if (this.checked) {
                    $('[type="checkbox"]').not(this).prop("checked", false);
                }
            });
        });
	</script>
  </body>
</html>