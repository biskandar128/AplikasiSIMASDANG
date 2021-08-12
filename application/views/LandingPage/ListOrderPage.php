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
                <li class="breadcrumb-item active">
                    Checkout
                </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="container mt-3 container-struk">
        <div class="card">
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-10 panel-konten mt-2">
                <h4 class="text-center font-weight-bold">ALAMAT PENGIRIMAN</h4>
                <hr class="new2" />
                <div class="table-responsive mt-4">
                  <table class="table table-struk">
                    <tbody>
                      <tr>
                        <th scope="row">Nama Penerima</th>
                        <td class="float-right"><?= $DataTransaction->account_name; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">No. Telepon</th>
                        <td class="float-right"><?= $DataTransaction->nomor_telp; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Alamat</th>
                        <td class="float-right">
                          <span class="float-right"><?= $DataTransaction->alamat; ?></span><br>
                          <span class="float-right">Kec. <?= $DataTransaction->kecamatan; ?>, <?= $DataTransaction->kota; ?></span><br>
                          <span class="float-right"><?= $DataTransaction->provinsi; ?>, Kode Pos <?= $DataTransaction->kode_pos; ?></span>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">Pengiriman</th>
                        <td class="float-right"><?= $DataTransaction->shipping; ?></td>
                      </tr>
                      <tr>
                          <th scope="row">Durasi</th>
                          <td class="float-right" id="estimasi_day"><?= $DataTransaction->estimated_day; ?> hari</td>
                      </tr>
                      <tr>
                        <th scope="row">Ongkir</th>
                        <td class="float-right">Rp<?= number_format($DataTransaction->shipping_cost, 0, '', '.'); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <hr class="new2" />
                <h4 class="text-center font-weight-bold">RINCIAN PEMBELIAN</h4>
                <div class="table-responsive mt-4">
                  <table class="table table-struk">
                    <tbody>
                      <tr>
                        <th scope="row">Nama Barang</th>
                        <td class="float-right"><?= $DataTransaction->nama; ?> <?= $DataTransaction->varian; ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Harga</th>
                        <td class="float-right">Rp<?= number_format($DataTransaction->harga, 0, '', '.'); ?></td>
                      </tr>
                      <tr>
                        <th scope="row">Jumlah</th>
                        <td class="float-right"><?= $DataTransaction->qty; ?> Buah</td>
                      </tr>
                      <tr>
                        <th scope="row">Total</th>
                        <td class="float-right">Rp<?= number_format($DataTransaction->transaction_total, 0, '', '.'); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>                
                <hr class="new2" />
                <table class="table table-struk">
                  <tr>
                    <td><h5 class="font-weight-bold">Total Bayar</h5></td>
                    <td><h4 class="float-right font-weight-bold">Rp<?= number_format($DataTransaction->transaction_total + $DataTransaction->shipping_cost, 0, '', '.'); ?></h4></td>
                  </tr>
                </table>
                
                <a class="btn btn-primary mb-3" href="<?= base_url('user/payment/'.$DataTransaction->transaction_id); ?>">Bayar Pesanan</a>

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
