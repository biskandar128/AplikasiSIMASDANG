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
        
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
    <body class="user-account">
        <main>
            <section class="header-user">
                <div class="container text-center">
                    <a href="<?= base_url('user'); ?>">
                        <img src="<?= base_url('asset/Frontend/img/logo.png'); ?>" alt="" />
                    </a>
                </div>
            </section>

            <section class="section-user">
                <div class="container">
                    <div class="float-left">
                        <img src="<?= base_url('upload/account_customers/'.$DataAccount->account_img); ?>"/>
                        <h4><?= $this->session->userdata('user_logged')->account_name; ?></h4>
                    </div>
                    <div class="float-right btn-user">
                        <button type="button" class="btn btn-user"><a class="text-white no-border" id="btn-logout" href="<?= base_url('user/logout'); ?>">Logout</a></button>
                    </div>
                </div>
            </section>
            <!-- content -->
            <section class="section-form-transaksi mb-5" style="margin-top: 6vh;">
                <div class="container">
                    <div class="card">
                        <?php if ($this->session->flashdata('success_update_password') != '') :

                                        echo '<div class="alert alert-success" role="alert">';
                                        echo $this->session->flashdata('success_update_password');
                                        echo '</div>';

                                    endif; ?>
                        <?php if ($this->session->flashdata('failed_update_password') != '') :

                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $this->session->flashdata('failed_update_password');
                                        echo '</div>';

                                    endif; ?>
                        <?php if ($this->session->flashdata('error') != '')  : ?>
                         <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Alamat tidak ditemukan!</strong> <?=$this->session->flashdata('error'); ?>
                        </div> 
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="card-title text-center"><h2>Data Akun</h2></div>
                            <div class="form-group">
                                <label for="nama" class="font-weight-bold">Nama:</label>
                                <p><?= $DataAccount->account_name; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="username" class="font-weight-bold">Username:</label>
                                <p><?= $DataAccount->username; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="username" class="font-weight-bold">Email:</label>
                                <p><?= $DataAccount->email; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="username" class="font-weight-bold">Jenis Kelamin:</label>
                                <p><?=  $DataAccount->jk; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="username" class="font-weight-bold">Tanggal Lahir:</label>
                                <p><?= $DataAccount->tgl_lahir; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="username" class="font-weight-bold">Nomor Telepon:</label>
                                <p><?= $DataAccount->nomor_telp; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="username" class="font-weight-bold">Alamat:</label>
                                <p><button type="button" class="btn btn-danger btn-address" data-toggle="modal" data-target="#modalUbahAlamat">Lihat Alamat</button></p>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUbahAkun">Ubah Profile</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUbahPassword">Ubah Keamanan Sandi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- akhir content -->
        </main>


        <!-- Ubah Update Profile -->
        <div class="modal fade" id="modalUbahAkun" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Profile</h5>
                </div>
                <div class="modal-body">
                    <!-- Update urlnya -->
                    <form method="post" action="<?= base_url('user/account/process'); ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Sebelumnya:</label><br>
                                    <img src="<?= base_url('upload/account_customers/'.$DataAccount->account_img); ?>" width="150" />
                                    <input type="hidden" name="old_image" value="<?= $DataAccount->account_img; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Gambar Sekarang:</label>                    
                                    <input type="file" class="form-control" id="file" name="account_img" value="<?= $DataAccount->account_img; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_ubah" class="form-label">Nama:</label>
                                    <input type="text" class="form-control" id="nama_ubah" name="account_name" value="<?= $DataAccount->account_name; ?>" required>
                                    <input type="hidden" id="account_id" name="account_id" value="<?= $DataAccount->account_id; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $DataAccount->username; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">                        
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required name="email" value="<?= $DataAccount->email; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label><br>
                                    <input type="radio" id="pria_jk" name="jk" <?= $DataAccount->jk === 'Pria' ? 'checked' : ''; ?> value="Pria"> <label for="pria_jk">Pria</label> 
                                    <input type="radio" id="wanita_jk" name="jk" <?= $DataAccount->jk === 'Wanita' ? 'checked' : ''; ?> value="Wanita"> <label for="wanita_jk">Wanita</label> 
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $DataAccount->tgl_lahir; ?>" required>
                                </div>                        
                                <div class="mb-3">
                                    <label for="nomor_telp" class="form-label">Nomor Telepon:</label>
                                    <input type="number" class="form-control" id="nomor_telp" name="nomor_telp" value="<?= $DataAccount->nomor_telp; ?>" required>
                                </div>                            
                            </div>
                        </div>                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnUbahProfile">Ubah Profile</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <!-- End of Ubah Update Profile -->

        <!-- Ubah Update Kata Sandi -->
        <div class="modal fade" id="modalUbahPassword" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keamanan Sandi</h5>
                </div>
                <div class="modal-body">
                    <!-- Update Urlnya -->
                    <form method="post" action="<?= base_url('user/account/update_password'); ?>">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="hidden" id="account_id" name="account_id" value="<?= $this->session->userdata('user_logged')->account_id; ?>">
                            <input type="password" class="form-control" id="password"  name="password">
                        </div>                        
                        <div class="mb-3">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnUbahPassword">Ubah Password</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <!-- Ubah Update Kata Sandi -->

        <!-- Ubah Update Alamat -->
        <div class="modal fade" id="modalUbahAlamat" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alamat Kamu</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-7 col-sm-12 col-12 mb-3">
                            <label for="alamat-mu">Daftar Alamat</label>
                            <div class="scrollable">                                
                                <h4 id="loadingAddress">Sedang memuat...</h4>
                                <div class="mb-3" id="listUserAddress">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-12 col-12">
                            <h4>Tambah Alamat</h4>                            
                            <form method="post" action="<?= base_url('user/account/add_address'); ?>" id="formTambahAlamat">
                                <input type="hidden" id="account_id" name="account_id" value="<?= $this->session->userdata('user_logged')->account_id; ?>">
                                <div class="mb-3">
                                    <label for="userAddress" class="form-label">Pilih Kota Asal</label>
                                    <select name="city_id" id="userAddress">
                                        <option value="" disabled selected>-- Pilih Kota Asal--</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control">
                                </div>                       
                                <div class="mb-3">
                                    <label for="pos" class="form-label">Kode POS</label>
                                    <input type="text" pattern="\d*" maxlength="5" name="kode_pos" id="pos" class="form-control">
                                </div>                        
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="4" style="resize: none;"></textarea>
                                </div>
                                <div class="mb-3">                            
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="btnTambahAlamat">Tambah</button>
                                </div>
                            </form>

                            <form method="post" action="<?= base_url('user/account/add_address'); ?>" id="formUbahAlamat" class="d-none">
                                <input type="hidden" id="account_id" name="account_id" value="<?= $this->session->userdata('user_logged')->account_id; ?>">
                                <div class="mb-3">
                                    <label for="userAddress" class="form-label">Pilih Kota Asal</label>
                                    <select name="city_id" id="userAddress">
                                        <option value="" disabled selected>-- Pilih Kota Asal--</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="kecamatan" class="form-control">
                                </div>                       
                                <div class="mb-3">
                                    <label for="pos" class="form-label">Kode POS</label>
                                    <input type="text" pattern="\d*" maxlength="5" name="kode_pos" id="pos" class="form-control">
                                </div>                        
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="4" style="resize: none;"></textarea>
                                </div>
                                <div class="mb-3">                            
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="btnUbahAlamat">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Ubah Update Alamat -->

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
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
        ></script>        
        <script src="<?= base_url('asset/sweetalert2/sweetalert2.min.js'); ?>"></script>
        <script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
    </body>
</html>
