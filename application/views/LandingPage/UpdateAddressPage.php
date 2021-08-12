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

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

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
    <body class="user-account">
        <main>
            <section class="header-detail-produk">
                <div class="container text-center">
                    <img src="<?= base_url('asset/Frontend/img/logo.png'); ?>" alt="" />
                </div>
            </section>

            <div class="container">
                <div class="card card-detail">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h2>Form Ubah Alamat</h2>
                        </div>
                    </div>
                </div>
            </div>

            <section class="section-form-transaksi mt-3 mb-5">
                <div class="container">
                <div class="card">
                    <div class="card-body">
                    
                    <form action="<?= base_url('user/account/update_address'); ?>" method="post">
                        <div class="row">
                            <div class="col-12">                            
                                 <div class="form-group">
                                <label for="city_id">Pilih Kota</label>
                                <input type="hidden" name="address_id" value="<?= $DataAlamat->address_id; ?>">
                                <select class="form-control" name="city_id" id="city_id">
                                <option value="<?= $DataAlamat->city_id; ?>" disabled selected>-- Pilih Kota Asal--</option>
                                </select>   
                                </div>                         
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input
                                    class="form-control"
                                    name="kecamatan"
                                    id="kecamatan"
                                    required      
                                    value="<?= $DataAlamat->kecamatan; ?>"
                                />
                            </div>
                            <div class="form-group">
                                <label for="nomor_telp"
                                    >Kode Pos</label
                                >
                                <input
                                    
                                    class="form-control"
                                    name="kode_pos"
                                    id="kode_pos"
                                    required
                                    value="<?= $DataAlamat->kode_pos; ?>"
                                />
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea
                                    class="form-control"
                                    name="alamat"
                                    rows="4"
                                    cols="50"
                                    style="resize: none"
                                    id="alamat"
                                    required
                                    ><?= $DataAlamat->alamat; ?></textarea>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="btnUbahAlamat">Ubah</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </section>
        </main>
        
        <!-- nav fixed bottom -->
        <nav class="navbar navbar-dark bg-info navbar-expand footer-account">        
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                <a href="<?= base_url('user'); ?>" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    <span class="small d-block">Beranda</span>
                </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/history'); ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                        </svg>
                        <span class="small d-block">Riwayat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/account'); ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <span class="small d-block">Akun</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- akhir nav fixed bottom -->

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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="<?= base_url('asset/sweetalert2/sweetalert2.min.js'); ?>"></script>
        <script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
    </body>
</html>
