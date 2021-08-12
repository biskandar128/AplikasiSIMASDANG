<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php if ($this->session->flashdata('success_input_produk') != '') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Sukses!</strong> <?= $this->session->flashdata('success_input_produk'); ?>
                </div>   
            <?php endif; ?>
            <?php if ($this->session->flashdata('success_update_produk') != '') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                    <strong>Sukses!</strong> <?= $this->session->flashdata('success_update_produk'); ?>
                </div>                                     
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="font-weight-bold text-center mb-3">DAFTAR PRODUK</h3>
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduk">Tambah data</button>
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
                                    <th>Nama Barang</th>
                                    <th>Varian</th>
                                    <th>Berat (gr)</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($DataGoods)) : $i = 0; foreach ($DataGoods as $produk) : ?>

                                    <tr>
                                        <td><?= ++$i; ?></td>
                                        <td><?= $produk->nama; ?></td>
                                        <td><?= $produk->varian; ?></td>
                                        <td><?= $produk->berat; ?></td>
                                        <td>Rp<?= number_format($produk->harga, 0, '', '.'); ?></td>
                                        <td><?= $produk->stok; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-update-produk" data-stok="<?= $produk->stok; ?>" data-nama-barang="<?= $produk->nama; ?>" data-varian="<?= $produk->varian; ?>" data-berat="<?= $produk->berat; ?>" data-harga = "<?= $produk->harga; ?>" data-goods-id="<?= $produk->goods_id; ?>" data-bs-toggle="modal" data-bs-target="#modalUbahProduk">Update</button>
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
<div class="modal fade" id="modalProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/tambah_produk'); ?>" id="formAddProduk" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="varian" class="form-label">Varian</label>
                        <input type="text" class="form-control" id="varian" name="varian">
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat (gr)</label>
                        <input type="number" class="form-control" id="berat" name="berat">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                    </div>
                </div>
                <div class="col-md-6 col-12">                                    
                    <div class="mb-3">
                        <label for="konten_produk_img" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" id="konten_produk_img" name="goods_img">
                    </div>
                    <div class="mb-3">
                        <label for="desc_content" class="form-label">Deskripsi</label>
                        <!-- <input type="text" class="form-control" id="desc_content" name="deskripsi"> -->
                        <textarea name="deskripsi" id="desc_content" cols="30" rows="5" class="form-control" style="resize: none;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status_barang" class="form-label">Status Barang</label>
                        <select name="status" id="status_barang" class="form-control">
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="0">Ready</option>
                            <option value="1">Pre-order</option>
                        </select>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnTambahProduk">Tambah Produk</button>
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
<div class="modal fade" id="modalUbahProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Ubah Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/ubah_produk'); ?>">
            <div class="mb-3">
                <label for="nama_ubah" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_ubah" name="nama">
                <input type="hidden" class="form-control" id="produkId_ubah" name="goods_id">
            </div>
            <div class="mb-3">
                <label for="varian_ubah" class="form-label">Varian</label>
                <input type="text" class="form-control" id="varian_ubah" name="varian">
            </div>
            <div class="mb-3">
                <label for="berat_ubah" class="form-label">Berat (gr)</label>
                <input type="number" class="form-control" id="berat_ubah" name="berat">
            </div>
            <div class="mb-3">
                <label for="harga_ubah" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga_ubah" name="harga">
            </div>
            <div class="mb-3">
                <label for="stok_ubah" class="form-label">Stok</label>
                <input type="text" class="form-control" id="stok_ubah" name="stok">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnUbahProduk">Ubah Produk</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ========================================================================================= -->
<!-- END OF MODAL FORM TAMBAH -->
<!-- ========================================================================================= -->