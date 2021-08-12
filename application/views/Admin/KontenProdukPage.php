<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">            
            <?php if ($this->session->flashdata('success_update_produk_konten') != '') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Sukses!</strong> <?= $this->session->flashdata('success_update_produk_konten'); ?>
                </div>                                     
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-center mb-3">KONTEN PRODUK</h3>
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
                                    <th>Nama</th>
                                    <th>Produk Image</th>
                                    <th>Deskripsi</th>
                                    <th>Status Barang</th>
                                    <th>Status Konten</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataGoodsContent)) : $i = 0; foreach ($DataGoodsContent as $kontenProduk) : ?>

                                    <tr>
                                        <td><?= ++$i; ?></td>
                                        <td><?= $kontenProduk->varian; ?></td>
                                        <td><img src="<?= base_url('upload/konten_produk/'.$kontenProduk->goods_img); ?>" class="img-thumbnail" width="150" /></td>
                                        <td><?= $kontenProduk->deskripsi; ?></td>
                                        <td>
                                            <?php if ($kontenProduk->status == 0) :  ?>
                                            Ready
                                            <?php elseif ($kontenProduk->status == 1) :  ?>
                                            Pre-order
                                            <?php else : ?>
                                            Batal
                                            <?php endif; ?>                                        
                                        </td>
                                        <td><?= ($kontenProduk->goods_status) ? 'Aktif' : 'Nonaktif'; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-update-konten-produk" data-content-id="<?= $kontenProduk->content_id; ?>" data-goods-status="<?= $kontenProduk->goods_status; ?>" data-deskripsi="<?= $kontenProduk->deskripsi; ?>" data-goods-img="<?= $kontenProduk->goods_img; ?>" data-status="<?= $kontenProduk->status; ?>" data-goods-name="<?= $kontenProduk->nama.': '.$kontenProduk->varian; ?>" data-bs-toggle="modal" data-bs-target="#modalUbahKontenProduk">Update</button>
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
<!-- MODAL FORM UBAH -->
<!-- ========================================================================================= -->
<div class="modal fade" id="modalUbahKontenProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ubah Konten Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/ubah_konten_produk'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="goods_nama_ubah" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="goods_nama_ubah" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="konten_produk_img_ubah" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" name="goods_img" id="konten_produk_img_ubah">
                        <input type="hidden" id="kontenId_ubah" name="content_id">
                        <input type="hidden" id="old_img" name="old_image">
                        <label class="form-label mt-2">Gambar sebelumnya</label>
                        <br>
                        <img class="img-thumbnail" src="" width="150" id="kontenProduk_img_ubah"/>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="deskripsiKonten_ubah" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" style="resize: none;" id="deskripsiKonten_ubah" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status_ubah" class="form-label">Status Barang</label>
                        <select name="status" id="status_ubah" class="form-select">
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="0">Ready</option>
                            <option value="1">Pre-order</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="goods_status_ubah" class="form-label">Status Konten</label>
                        <select name="goods_status" id="goods_status_ubah" class="form-select">
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnUbahProdukKonten">Ubah Konten</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM UBAH -->
<!-- ========================================================================================= -->