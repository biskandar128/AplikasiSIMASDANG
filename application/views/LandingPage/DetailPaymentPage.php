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
            <h2 class="breadcrumb-simasdang">Selesaikan Pembayaran</h2>
          </div>
        </div>
      </div>
      <div class="container mt-3 container-struk">
        <div class="card">
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10 panel-konten mt-2">
                <?php if ($DataPayment->payment_name !== 'Cash On Delivery') : ?>     
                <h4 class="text-center font-weight-bold">TRANSFER PEMBAYARAN</h4>
                <div class="table-responsive mt-4">
                  <table class="table table-struk">
                    <tbody>
                      <tr>
                        <th scope="row">Nama Pembayaran</th>
                        <td class="float-right"><?= $DataPayment->payment_name; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Penerima</th>
                        <td class="float-right"><?= $DataPayment->payment_receiver; ?></td>
                      </tr>                 
                      <tr>
                        <td>Nomor Transfer</td>
                        <th scope="row" class="float-right"><?= $DataPayment->payment_transfer; ?></th>
                      </tr>
                    </tbody>
                  </table>
                </div>                
                <?php endif; ?>
                
                <p style="color: #ccc; font-size:16px;">Silahkan konfirmasi pesanan atau Pembayaran melalui link di bawah ini</p>
                <a
                  target="_blank"
                  href="https://wa.me/<?= $whatsapp; ?>?text=bukti%20pembayaran%20saya%20A.N%20..."
                  class="btn btn-info"
                  >Konfirmasi Pembayaran</a>
                  <a href="<?= base_url('user'); ?>" class="btn btn-danger">Beranda</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- footer -->

    <footer class="footer-methodPay mt-5">
      <p class="text-center">&copy; 2021 All Rights Reserved</p>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#FF5944"
          fill-opacity="1"
          d="M0,288L20,272C40,256,80,224,120,197.3C160,171,200,149,240,144C280,139,320,149,360,149.3C400,149,440,139,480,122.7C520,107,560,85,600,69.3C640,53,680,43,720,48C760,53,800,75,840,106.7C880,139,920,181,960,213.3C1000,245,1040,267,1080,250.7C1120,235,1160,181,1200,170.7C1240,160,1280,192,1320,208C1360,224,1400,224,1420,224L1440,224L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"
        ></path>
      </svg>
    </footer>
    <!-- akhir footer -->

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
