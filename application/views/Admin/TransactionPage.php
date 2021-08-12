<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->flashdata('success_update_transaction') != '') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Sukses!</strong> <?= $this->session->flashdata('success_update_transaction'); ?>
                </div>                                     
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-center mb-3">Data Transaksi</h3>
                    </div>
                    <div class="dropdown-divider mb-3"></div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered" style="width:150%">
                            <thead>
                                <tr>
                                    <th>Transaksi ID</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Tanggal Dikirim</th>
                                    <th>Estimasi Pengiriman</th>
                                    <th>Tanggal Sampai</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Akun ID</th>
                                    <th>Pembayaran</th>
                                    <th>No Resi</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataTransaction)) : $i = 0; foreach ($DataTransaction as $transaction) : ?>

                                    <tr>
                                        <td><?= $transaction->transaction_id; ?></td>
                                        <td><?= $transaction->transaction_date; ?></td>
                                        <td><?= ($transaction->delivered_date != '0000-00-00') ? $transaction->delivered_date : 'Belum tersedia'; ?></td>
                                        <td><?= ($transaction->estimated_day) ? "{$transaction->estimated_day} hari + 3 hari" : 'Belum tersedia'; ?></td>
                                        <td><?= ($transaction->estimated_date != '0000-00-00') ? $transaction->estimated_date : 'Belum tersedia'; ?></td>
                                        <td>Rp<?= number_format($transaction->transaction_total, 0, '', '.'); ?></td>
                                        <td><?= $transaction->transaction_status; ?></td>
                                        <td><?= $transaction->account_id; ?></td>
                                        <td><?= $transaction->payment_name; ?></td>
                                        <td><?= ($transaction->tracking) ? $transaction->tracking : 'Belum tersedia'; ?></td>
                                        <td>
                                            <button type="button" id="btnId" class="btn btn-info" data-transaction-id="<?= $transaction->transaction_id; ?>" data-bs-toggle="modal" data-bs-target="#modalTransactionDetail">Detail</button>
                                                <button type="button" class="btn btn-github" data-tracking="<?= $transaction->tracking; ?>" data-account-id="<?= $transaction->account_id; ?>" data-transaction-date="<?= $transaction->transaction_date; ?>" data-transaction-status="<?= $transaction->transaction_status; ?>" data-transaction-id="<?= $transaction->transaction_id; ?>" data-bs-toggle="modal" data-bs-target="#modalTransactionStatus">Update</button>
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
</div>

<!-- ========================================================================================= -->
<!-- MODAL FORM DETAIL -->
<!-- ========================================================================================= -->
<div class="modal fade" id="modalTransactionDetail" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"><b>INVOICE</b> #<span class="pull-right" id="transaction_id"></span></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <td class="float-end" id="account_name"></td>
                    </tr>
                    <tr>
                        <th scope="row">No. Telepon</th>
                        <td class="float-end" id="nomor_telp"></td>
                    </tr>
                    <tr>
                        <th scope="row">Alamat</th>
                        <td class="float-end" id="alamat"></td>
                    </tr>
                    <tr>
                        <th scope="row">Pengiriman</th>
                        <td class="float-end" id="pengiriman"></td>
                    </tr>
                    <tr>
                        <th scope="row">Durasi</th>
                        <td class="float-end" id="estimasi_day"></td>
                    </tr>
                    <tr>
                        <th scope="row">Ongkir</th>
                        <td class="float-end" id="ongkir"></td>
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
                        <td class="float-end" id="nama"></td>
                    </tr>
                    <tr>
                        <th scope="row">Harga</th>
                        <td class="float-end" id="harga"></td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah</th>
                        <td class="float-end" id="qty"></td>
                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td class="float-end" id="total_beli"></td>
                    </tr>
                    </tbody>
                </table>
                </div>                
                <hr class="new2" />
                <table class="table table-struk">
                <tr>
                    <td><h5 class="font-weight-bold">Total Bayar</h5></td>
                    <td><h4 class="float-end font-weight-bold" id="total_bayar"></h4></td>
                </tr>
                </table>
                

            </div>
        </div>  
      </div>
      <div class="modal-footer">
          <button class="btn btn-info" onclick="window.print();">Print</button>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM DETAIL -->
<!-- ========================================================================================= -->

<!-- ========================================================================================= -->
<!-- MODAL FORM UPDATE STATUS -->
<!-- ========================================================================================= -->
<div class="modal fade" id="modalTransactionStatus" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/update_transaksi_status'); ?>" id="formTransaction" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="transaction_id_ubah" class="form-label">Transaction ID</label>
                <input type="text" class="form-control" id="transaction_id_ubah" name="transaction_id" readonly>
            </div>
            <div class="mb-3">
                <label for="transaction_date_ubah" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="transaction_date_ubah" name="transaction_date" readonly>
            </div>
            <div class="mb-3">
                <label for="transaction_status_ubah" class="form-label">Transaction Status</label>
                <select id="transaction_status_ubah" class="form-select" name="transaction_status">
                    <option value="Batal" id="batal" class="d-none">Batal</option>
                    <option value="Menunggu" id="menunggu" class="d-none">Menunggu</option>
                    <option value="Proses" id="proses" class="d-none">Proses</option>
                    <option value="Dikirim" id="dikirim" class="d-none">Dikirim</option>
                    <option class="d-none">Selesai</option>
                </select>
            </div>
            <div class="mb-3 d-none" id="form-resi" class="d-none">
                <label for="resi_ubah" class="form-label">Nomor Resi</label>
                <input type="text" class="form-control" id="resi_ubah" name="tracking">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btn_transaksi_status">Update Transaksi</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM UPDATE STATUS -->
<!-- ========================================================================================= -->
