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
    <!-- Navbar SIMASDANG -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"
          ><img src="<?= base_url('asset/Frontend/img/logo.png'); ?>" class="logo-simasdang" alt=""
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tentang_kami">Tentang Kami</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#produk">Produk</a>
            </li>
          </ul>

          <div class="d-none d-sm-none d-md-none d-lg-block">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="<?= base_url('user/history'); ?>" class="btn btn-cart mr-2" type="button">

                    <i class="fas fa-user"></i>
                    
                </a>
              </li>
            </ul>
          </div>

          <div class="row d-block d-sm-block d-md-block d-lg-none">
            <div class="container-fluid">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a href="<?= base_url('user/history'); ?>" class="btn btn-cart" type="button">

                      <i class="fas fa-user"></i>
                      
                  </a>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </nav>
    <!-- End of Navbar SIMASDANG -->

    <!-- Header -->
    <header class="text-center">
      <img src="<?= base_url('asset/Frontend/img/img2.2 fix.png'); ?>" alt="" />
      <h1>#SambalGendang #PedasMeronta</h1>
    </header>
    <!-- End of Header -->

    <!-- Main Content -->
    <main>
      <!-- Statistic -->
      <div class="container container-statistic">
        <section class="section-stats row justify-content-center" id="stats">
          <div class="col-4 col-sm-3 col-md-3 stats-detail">
            <img
              src="<?= base_url('asset/Frontend/img/document-business.png'); ?>"
              class="float-left mr-2"
              alt=""
            />
            <h2 class="pl-lg-4 pl-2 pl-md-4"><?= number_format($rate, 1, '.', ''); ?></h2>
            <p class="pl-lg-4 pl-2 pl-md-4">Rate</p>
          </div>
          <div class="col-4 col-sm-3 col-md-3 stats-detail">
            <img src="<?= base_url('asset/Frontend/img/shop.png'); ?>" class="float-left mr-2" alt="" />
            <h2 class="pl-lg-4 pl-2 pl-md-4"><?= ($sell) ? $sell : 0; ?></h2>
            <p class="pl-lg-4 pl-2 pl-md-4">Terjual</p>
          </div>
          <div class="col-4 col-sm-3 col-md-3 stats-detail">
            <img
              src="<?= base_url('asset/Frontend/img/tags.png'); ?>"
              class="float-left mr-2"
              alt=""
            />
            <h2 class="pl-lg-4 pl-2 pl-md-4">100%</h2>
            <p class="pl-lg-4 pl-2 pl-md-4">Halal</p>
          </div>
        </section>
      </div>
      <!-- End of Statistic -->


      <!-- About Us -->
      <?php if (!empty($about_us)) : $i = 0; foreach ($about_us as $about) : if ((int) $about->about_status === 1) : ?>
      <div class="container">
        <section class="section-about" id="tentang_kami">
          <h2 class="text-center">Tentang Kami</h2>
          <hr />
          <div class="row">
            <div class="col-md-5 col-6">
              <img src="<?= base_url('upload/konten_about/'.$about->about_img); ?>" alt="" />
            </div>
            <div class="col-md-7 col-6">
              <p>
                <?= $about->about_desc; ?>
              </p>
            </div>
          </div>
        </section>
      </div>
      <?php endif; endforeach; endif; ?>
      <!-- End of About Us -->

      <section class="section-produk" id="produk">
        <h2 class="text-center">Produk</h2>
        <hr />
        <section class="section-item">
          <div class="container">
            <div class="row">
              

              <?php if (!empty($products)) : $i = 0; foreach ($products as $product) : if ((int) $product->goods_status === 1) : ?>
              <div class="col-md-6 col-6 d-flex justify-content-center">
                <div class="card">
                  <img
                    src="<?= base_url('upload/konten_produk/'.$product->goods_img); ?>"
                    class="card-img-top"
                    alt="Sambal Cumi"
                  />
                  <div class="card-body">
                    <h5 class="card-title" style="font-size: calc(1rem + 0.3vw);"><?= $product->nama; ?> <?= $product->varian; ?></h5>
                    <p class="card-text" style="font-size: 20px; font-weight: 700;">Rp<?= number_format($product->harga, 0, '', '.'); ?></p>
                    <a href="<?= base_url('user/produk/'.$product->goods_id); ?>" class="btn w-100 btn-beli"
                      >Beli</a
                    >
                  </div>
                </div>
              </div>
              <?php endif; endforeach; endif; ?>
            </div>
          </div>
        </section>
      </section>


      <section class="section-testimonial" id="testimonial">
        <div class="text-center">
          <h2>Testimonial</h2>
          <p>Apa yang mereka katakan tentang kita</p>
        </div>
        <hr />
        <div class="container-fluid">
          <div class="owl-carousel owl-theme">
            <?php if (!empty($ulasans)) : $i = 0; foreach ($ulasans as $ulasan) : ?>
            <div class="items">
             <div class="card mb-3"  style="max-width: 600px">
                <div class="testimonial-content">
                  <div class="row no-gutters">
                    <div class="col-lg-4">
                      <img
                        src="<?= base_url('upload/account_customers/'.$ulasan->account_img); ?>"
                        class="mt-3 ml-4"
                        alt=""
                      />
                    </div>
                    <div class="col-lg-8">
                      <h5 class="card-title mt-4"><?= $ulasan->account_name; ?></h5>
                      <div class="stars ">
                        
                        <?php

                          $html = '<i class="bi bi-star-fill"></i>';
                          $rate = (int) $ulasan->rate;

                          for ($i = 1; $i < $rate; ++$i) {
                              $html .= '<i class="bi bi-star-fill"></i>';
                          }

                          echo $html;

                        ?>

                      </div>

                      <p class="card-text mr-3">
                        <?= $ulasan->ulasan; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>              
            <?php endforeach; endif; ?>
          </div>
        </div>
      </section>
    </main>
    <!-- End of Main Content -->

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
                <a class="nav-link" href="#tentang_kami">Tentang Kami</a>
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
                  ><a class="link" href=""> 078767508</a></i
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
    <button id="myBtn" title="Go to top">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="1.5em"
        height="1.5em"
        fill="currentColor"
        class="bi bi-chevron-up"
        viewBox="0 0 16 16"
      >
        <path
          fill-rule="evenodd"
          d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"
        />
      </svg>
    </button>
    <a target="blank" href="https://wa.me/6285959593311?text=Saya%20ingin%20membeli%20sambal" id="waMe" title="WhatsApp Me">
      <svg 
        xmlns="http://www.w3.org/2000/svg" 
        width="1.5em"
        height="1.5em"
        fill="currentColor" 
        class="bi bi-whatsapp" 
        viewBox="0 0 16 16">
      <path 
        fill-rule="evenodd"
        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 
        .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 
        0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 
        0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
      </svg>
    </a>
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
    <script src="<?= base_url('asset/Frontend/assets/vendor/OwlCarousel/src/js/owl.carousel.js'); ?>"></script>
    <script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
  </body>
</html>
