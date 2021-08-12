<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->flashdata('success_update_konten_testimonial') != '') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Sukses!</strong> <?= $this->session->flashdata('success_update_konten_testimonial'); ?>
                </div>                                     
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-center mb-3">Konten Testimonial</h3>
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
                                    <th>Ulasan</th>
                                    <th>Rate</th>
                                    <th>Nama Akun</th>
                                    <th>Transaksi ID</th>
                                    <th>Status Aktif</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataTestimonial)) : $i = 0; foreach ($DataTestimonial as $testi) : ?>

                                    <tr>
                                        <td><?= ++$i; ?></td>
                                        <td><?= $testi->ulasan; ?></td>
                                        <td><?= $testi->rate; ?></td>
                                        <td><?= $testi->account_name; ?></td>
                                        <td><?= $testi->transaction_id; ?></td>
                                        <td><?= ($testi->testi_status) ? 'Aktif' : 'Nonaktif'; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-update-testi" data-testimonial-id="<?= $testi->testimonial_id; ?>" data-testi-status="<?= $testi->testi_status; ?>" data-bs-toggle="modal" data-bs-target="#modalTesti">Ubah Status</button>
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
<!-- MODAL FORM TESTI -->
<!-- ========================================================================================= -->
<div class="modal fade" id="modalTesti" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ubah Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/ubah_status_testimonial'); ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="testi_status" class="form-label">Status</label>
                <input type="hidden" id="testimonial_id" name="testimonial_id">
                <select name="testi_status" id="testi_status" class="form-select">
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="0">Nonaktif</option>
                    <option value="1">Aktif</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnUbahTesti">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM TESTI -->
<!-- ========================================================================================= -->
