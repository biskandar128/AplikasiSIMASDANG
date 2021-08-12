<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                        <?php if ($this->session->flashdata('success_input_about') != '') : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                                <strong>Sukses!</strong> <?= $this->session->flashdata('success_input_about'); ?>
                            </div>   
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('success_update_about') != '') : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                                <strong>Sukses!</strong> <?= $this->session->flashdata('success_update_about'); ?>
                            </div>                                     
                        <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-center mb-3">Konten Tentang Kami</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAbout">Tambah data</button>
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
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Status Konten</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataAbout)) : $i = 0; foreach ($DataAbout as $about) : ?>

                                    <tr>
                                        <td><?= ++$i; ?></td>
                                        <td><?= $about->about_desc; ?></td>
		                                    <td><img src="<?= base_url('upload/konten_about/'.$about->about_img); ?>" class="img-thumbnail" width="150" /></td>
                                        <td><?= ($about->about_status) ? 'Aktif' : 'Nonaktif'; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-update-about" data-about-status="<?= $about->about_status; ?>" data-about-id="<?= $about->about_id; ?>" data-about-desc="<?= $about->about_desc; ?>" data-about-img="<?= $about->about_img; ?>" data-bs-toggle="modal" data-bs-target="#modalUbahAbout">Update</button>
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
<div class="modal fade" id="modalAbout" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Konten</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/tambah_konten_about'); ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="about_desc" id="deskripsi" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
            </div>
            <div class="mb-3">
                <label for="about_img" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="about_img" name="about_img">
            </div>            
            <div class="mb-3">
                <label for="about_status" class="form-label">Status Konten</label>
                <!-- <input type="text" class="form-control" id="about_status" name="about_status"> -->
                <select name="about_status" id="about_status" class="form-select">
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="1">Aktif</option>
                    <option value="0">Noaktif</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnTambahAbout">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM TAMBAH -->
<!-- ========================================================================================= -->

<!-- ========================================================================================= -->
<!-- MODAL FORM TAMBAH -->
<!-- ========================================================================================= -->
<div class="modal fade" id="modalUbahAbout" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ubah Konten</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/ubah_konten_about'); ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="about_desc" class="form-label">Deskripsi</label>
                <textarea name="about_desc" id="about_desc" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
                <input type="hidden" id="about_id" name="about_id">
            </div>
            <div class="mb-3">
                <label>Gambar Sebelumnya</label> <br>
                <img src="" width="150" class="mt-2 img-thumbnail" id="about_img_ubah"/>
                <input type="hidden" id="old_img" name="old_image">
            </div>
            <div class="mb-3">
                <label for="about_img" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="about_img" name="about_img">
            </div>            
            <div class="mb-3">
                <label for="about_status_ubah" class="form-label">Status Konten</label>
                <!-- <input type="text" class="form-control" id="about_status_ubah" name="about_status_ubah"> -->
                <select name="about_status" id="about_status_ubah" class="form-select">                    
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="1">Aktif</option>
                    <option value="0">Noaktif</option>
                </select>            
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnUbahAbout">Ubah Konten</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM TAMBAH -->
<!-- ========================================================================================= -->