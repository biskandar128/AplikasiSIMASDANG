<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->flashdata('success_input_payment') != '') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Sukses!</strong> <?= $this->session->flashdata('success_input_payment'); ?>
                </div>   
            <?php endif; ?>
            <?php if ($this->session->flashdata('success_update_payment') != '') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Sukses!</strong> <?= $this->session->flashdata('success_update_payment'); ?>
                </div>                                     
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-center mb-3">Metode Pembayaran</h3>
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPayment">Tambah data</button>
                    </div>
                    <div class="dropdown-divider mb-3"></div>
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-striped table-bordered"
                        >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Nama Penerima</th>
                                    <th>Nomor Transafer</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataPayment)) : $i = 0; foreach ($DataPayment as $payment) : ?>

                                    <tr>
                                        <td><?= ++$i; ?></td>
		                                <td><img src="<?= base_url('upload/konten_payment/'.$payment->payment_img); ?>" class="img-thumbnail" width="150" /></td>
                                        <td><?= $payment->payment_name; ?></td>
                                        <td><?= $payment->payment_receiver; ?></td>
                                        <td><?= $payment->payment_transfer; ?></td>
                                        <td><?= ($payment->payment_status) ? 'Aktif' : 'Nonaktif'; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-update-about" data-payment-transfer="<?= $payment->payment_transfer; ?>" data-payment-receiver="<?= $payment->payment_receiver; ?>" data-payment-id="<?= $payment->payment_id; ?>" data-payment-name="<?= $payment->payment_name; ?>" data-payment-status="<?=$payment->payment_status; ?>" data-payment-img="<?= $payment->payment_img; ?>" data-bs-toggle="modal" data-bs-target="#modalUbahPayment">Update</button>
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
<!-- MODAL FORM TAMBAH -->
<!-- ========================================================================================= -->
<div class="modal fade" id="modalPayment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Metode</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/tambah_payment'); ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="payment_img" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="payment_img" name="payment_img">
            </div>            
            <div class="mb-3">
                <label for="payment_name" class="form-label">Nama Pembayaran</label>
                <input type="text" class="form-control" id="payment_name" name="payment_name">
            </div>        
            <div class="mb-3">
                <label for="payment_receiver" class="form-label">Penerima</label>
                <input type="text" class="form-control" id="payment_receiver" name="payment_receiver">
            </div>        
            <div class="mb-3">
                <label for="payment_transfer" class="form-label">No. Transfer</label>
                <input type="text" class="form-control" id="payment_transfer" name="payment_transfer">
            </div>     
            <div class="mb-3">
                <label for="payment_status" class="form-label">Status Konten</label>
                <select name="payment_status" id="payment_status" class="form-select">
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="0">Nonaktif</option>
                    <option value="1">Aktif</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnAddPayment">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM TAMBAH -->
<!-- ========================================================================================= -->

<!-- ========================================================================================= -->
<!-- MODAL FORM UBAH -->
<!-- ========================================================================================= -->
<div class="modal fade" id="modalUbahPayment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ubah Konten</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/ubah_payment'); ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="payment_img" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="payment_img" name="payment_img">
                <input type="hidden" id="payment_id_ubah" name="payment_id">
            </div>
            <div class="mb-3">
                <label for="payment_img" class="form-label">Gambar Sebelumnya</label> <br>
                <img src="" width="150" class="mt-2 img-thumbnail" id="payment_img_tampil"/>
                <input type="hidden" id="old_img" name="old_image">
            </div>
            <div class="mb-3">
                <label for="payment_name_ubah" class="form-label">Nama Pembayaran</label>
                <input type="text" class="form-control" id="payment_name_ubah" name="payment_name">
            </div>        
            <div class="mb-3">
                <label for="payment_receiver_ubah" class="form-label">Penerima</label>
                <input type="text" class="form-control" id="payment_receiver_ubah" name="payment_receiver">
            </div>        
            <div class="mb-3">
                <label for="payment_transfer_ubah" class="form-label">No. Transfer</label>
                <input type="text" class="form-control" id="payment_transfer_ubah" name="payment_transfer">
            </div>  
            <div class="mb-3">
                <label for="payment_status_ubah" class="form-label">Status Konten</label>                
                <select name="payment_status" id="payment_status_ubah" class="form-select">
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="0">Nonaktif</option>
                    <option value="1">Aktif</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnUbahPayment">Ubah Konten</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM UBAH -->
<!-- ========================================================================================= -->