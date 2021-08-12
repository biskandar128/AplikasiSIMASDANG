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
        href="<?= base_url('asset/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>"
        rel="stylesheet"
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
            <section class="section-form-transaksi mb-4" style="margin-top: 4rem">
                <div class="container">
                <div class="card">
                    <div class="card-body">
                    <div class="card-title text-center">
                        <h2>Riwayat Pembelian</h2>
                        <div class="table-responsive mt-4">
                        <table class="table table-borderless" id="dataTable-user">
                            <thead>
                            <tr>
                                <th scope="col">No Transaksi</th>
                                <th scope="col">Tanggal Pesanan</th>
                                <th scope="col">Tanggal Dikirim</th>
                                <th scope="col">Estimasi Diterima</th>
                                <th scope="col">No Resi</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataRiwayat)) : foreach ($DataRiwayat as $R) : ?>
                                    <tr>
                                        <th scope="row"><?= $R->transaction_id; ?></th>
                                        <td><?= $R->transaction_date; ?></td>
                                        <td><?= ($R->delivered_date != '0000-00-00') ? "<span class='bg-info text-white rounded p-1'>{$R->delivered_date}</span>" : 'Belum tersedia'; ?></td>
                                        <td><?= ($R->estimated_date != '0000-00-00') ? "<span class='bg-dark text-white rounded p-1'>{$R->estimated_date}</span>" : 'Belum tersedia'; ?></td>
                                        <td><?= ($R->tracking) ? "<span class='bg-success text-white rounded p-1'>{$R->tracking}</span>" : 'Belum tersedia'; ?></td>
                                        <td>
                                            <?php if ($R->transaction_status == 'Menunggu') : ?>
                                                <button class="btn btn-warning text-white" data-transactionId="<?= $R->transaction_id; ?>" data-toggle="modal" data-target="#dataHistory"><?= $R->transaction_status; ?></button>
                                            <?php elseif ($R->transaction_status == 'Proses') : ?>
                                                <button class="btn btn-danger" data-transactionId="<?= $R->transaction_id; ?>" data-toggle="modal" data-target="#dataHistory"><?= $R->transaction_status; ?></button>
                                            <?php else : ?>
                                                <button class="btn btn-success" data-transactionId="<?= $R->transaction_id; ?>" data-toggle="modal" data-target="#dataHistory"><?= $R->transaction_status; ?></button>
                                            <?php endif; ?>
                                            <?php if ($R->transaction_status === 'Dikirim') : ?>
                                                <a href="<?= base_url('user/ulasan/'.$R->transaction_id); ?>" class="btn btn-info">Beri Ulasan</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </section>
            <!-- akhir content -->
        </main>

        <!-- Modal -->
        <div class="modal fade" id="dataHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><b>INVOICE</b> #<span class="pull-right" id="transaction_id"></span></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                  
                    
                    <div class="row justify-content-center">
                        <div class="col-10 panel-konten mt-2">
                            <h4 class="text-center font-weight-bold">ALAMAT PENERIMA</h4>
                            <hr class="new2" />
                            <div class="table-responsive mt-4">
                            <table class="table table-struk">
                                <tbody>
                                <tr>
                                    <th scope="row">Nama Penerima</th>
                                    <td class="float-right" id="account_name"></td>
                                </tr>
                                <tr>
                                    <th scope="row">No. Telepon</th>
                                    <td class="float-right" id="nomor_telp"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td class="float-right" id="alamat"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pengiriman</th>
                                    <td class="float-right" id="pengiriman"></td>
                                </tr>
                                    <th scope="row">Tanggal Pengiriman</th>
                                    <td class="float-right" id="pengiriman_date"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Estimasi Sampai</th>
                                    <td class="float-right" id="estimated_day"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ongkir</th>
                                    <td class="float-right" id="ongkir"></td>
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
                                    <td class="float-right" id="nama"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal</th>
                                    <td class="float-right" id="tanggal"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga</th>
                                    <td class="float-right" id="harga"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah</th>
                                    <td class="float-right" id="qty"></td>
                                </tr>
                                <tr>
                                    <th scope="row">Total</th>
                                    <td class="float-right" id="total_beli"></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>                
                            <hr class="new2" />
                            <table class="table table-struk">
                            <tr>
                                <td><h5 class="font-weight-bold">Total Bayar</h5></td>
                                <td><h4 class="float-right font-weight-bold" id="total_bayar"></h4></td>
                            </tr>
                            </table>                        
                        </div>
                    </div>                                

                </div>
                <div class="modal-footer">
                    <a
                    target="_blank"
                    href="https://wa.me/<?= $whatsapp; ?>?text=Hai%20admin...%20Saya%20ingin%20bertanya..."
                    class="btn btn-info"
                    >Chat Admin</a>
                </div>
                </div>
            </div>
        </div>

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
        <script src="<?= base_url('asset/Backend/assets/extra-libs/DataTables/datatables.min.js'); ?>"></script>
        <script src="<?= base_url('asset/sweetalert2/sweetalert2.min.js'); ?>"></script>
        <script src="<?= base_url('asset/Frontend/script.js'); ?>"></script>
    </body>
</html>
