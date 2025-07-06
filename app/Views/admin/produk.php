<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
                <h5 class="card-header">Product</h5>
                
                <div class="table-responsive text-nowrap">
                        <button type="button" class="btn rounded-pill btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                            <span class="icon-base bx bx-plus icon-sm me-2"></span>Tambah
                        </button>
                        <button type="button" class="btn rounded-pill btn-outline-primary" >
                            <span class="icon-base bx bx-download icon-sm me-2"></span>Download
                        </button>

                        <div class="demo-inline-spacing">
                            <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>
                          <span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">Susu Kedelai Organik</span>
                        </td>
                        <td>1.900.000</td>
                        <td>19</td>
                        <td>Minuman Kesehatan</td>
                        </td>
                        <td><span class="badge text-bg-success">Ready</span></td>
                        <td>

                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" style="margin-right : 10px">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">Apple Orcant</span>
                        </td>
                        <td>90.000</td>
                        <td>190</td>
                        <td>Minuman Kesehatan</td>
                        <td><span class="badge text-bg-warning">Out Of Stock</span></td>
                        <td>
                            
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" style="margin-right : 10px">Edit</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('produk/edit/')?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="" placeholder="Nama Barang" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="harga" class="form-control" id="harga" value="" placeholder="Harga Barang" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="jumlah" class="form-control" id="jumlah" value="" placeholder="Jumlah Barang" required>
                            </div>
                            <img src="<?php echo base_url() . "img/"?>" width="100px">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                                <label class="form-check-label" for="check">
                                    If Want Change Image
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="name">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal End -->
            <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Layout -->
                            <div class="row mb-6 gy-6">
                                <div class="col-xl">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                        </div>
                                        <div class="card-body">
                                            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-fullname">Name</label>
                                                <input type="text" class="form-control" id="basic-default-fullname"/>
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-company">Price</label>
                                                <input type="text" class="form-control" id="basic-default-company"/>
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-company">Stock</label>
                                                <input type="text" class="form-control" id="basic-default-company" />
                                            </div>
                                            
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-phone">Status</label>
                                                <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-message">Image</label>
                                                <input type="file" class="form-control" id="foto" name="foto">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
<?= $this->endSection() ?>