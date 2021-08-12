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
    <link rel="stylesheet" href="<?= base_url('asset/sweetalert2/sweetalert2.min.css'); ?>">
    <link rel="icon" href="<?= base_url('asset/Frontend/img/logo_icon.ico'); ?>" />

    <link rel="stylesheet" href="<?= base_url('asset/Frontend/css/style.css'); ?>" />


    <title>SIMASDANG</title>
  </head>
  <body>
    <main>
      <section class="header-detail-produk">
        <div class="container text-center">
          <img src="<?= base_url('asset/frontend/img/logo.png'); ?>" alt="" />
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
                    Riwayat
                </li>
                <li class="breadcrumb-item active">
                    Ulasan
                </li>
            </ol>
          </div>
        </div>
      </div>

      <section class="section-rating mt-3">
        <div class="container">
          <div class="card">
            <div class="card-body">
              <div class="card-title">
                <h2 class="text-center">Nilai Produk</h2>
              </div>
              <div class="card-text">
                <form action="<?= base_url('user/ulasan/proses/'.$transaction_id); ?>" method="post">
                 <input type="hidden" name="transaction_id" value="<?= $transaction_id; ?>"> 
                 <div class="form-group mt-4">
                    <div class="rating">
                      <input
                        type="radio"
                        name="star"
                        id="star1"
                        value="5"
                      /><label for="star1"></label>
                      <input
                        type="radio"
                        name="star"
                        id="star2"
                        value="4"
                      /><label for="star2"></label>
                      <input
                        type="radio"
                        name="star"
                        id="star3"
                        value="3"
                      /><label for="star3"></label>
                      <input
                        type="radio"
                        name="star"
                        id="star4"
                        value="2"
                      /><label for="star4"></label>
                      <input
                        type="radio"
                        name="star"
                        id="star5"
                        value="1"
                      /><label for="star5"></label>
                    </div>
                  </div>
                  <br />
                  <div class="form-group mt-5">
                    <label for="ulasan">Ulasan</label>
                    <textarea
                      class="form-control"
                      rows="4"
                      cols="50"
                      style="resize: none"
                      name="ulasan"
                      id="ulasan"
                    ></textarea>
                  </div>
                  <a href="<?= base_url('user/history'); ?>" class="btn btn-link text-decoration-none">Batal</a>
                  <button type="submit" class="btn btn-primary" id="btnRating">Kirim</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

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
    <script src="<?= base_url('asset/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
  </body>
</html>
