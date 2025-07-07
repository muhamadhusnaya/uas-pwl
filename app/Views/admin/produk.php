<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Product</h5>

        <div class="table-responsive text-nowrap">
            <button type="button" class="btn rounded-pill btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                <span class="icon-base bx bx-plus icon-sm me-2"></span>Tambah
            </button>
            <button type="button" class="btn rounded-pill btn-outline-primary">
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
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach ($produk as $item) : ?>
                            <tr>
                                <td>
                                    <span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px"><?= esc($item['name']) ?></span>
                                </td>
                                <td>Rp. <?= number_format($item['price'], 0, ',', '.') ?>.000</td>
                                <td><?= esc($item['stock']) ?></td>
                                <td><?= esc($item['category_name']) ?></td>
                                <td>
                                    <?php if (!empty($item['images'])) : ?>
                                        <img src="<?= base_url('img/produk/' . $item['images']) ?>" alt="<?= esc($item['name']) ?>" width="50">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>" style="margin-right : 10px">Edit</button>
                                    <form method="post" action="<?= base_url('admin/produk/delete/' . $item['id']) ?>" style="display: inline;">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit untuk setiap item -->
                            <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('admin/produk/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="<?= esc($item['name']) ?>" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="price">Price</label>
                                                    <input type="number" class="form-control" name="price" id="price" value="Rp. <?= number_format($item['price'], 0, ',', '.') ?>" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="stok">Stock</label>
                                                    <input type="number" class="form-control" name="stock" id="stok" value="<?= esc($item['stock']) ?>" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Category</label>
                                                    <select class="form-select" name="category_id" id="category_id" required>
                                                        <option value="">Select Category</option>
                                                        <?php foreach ($categories as $category) : ?>
                                                            <option value="<?= $category['id'] ?>"><?= esc($category['category_type']) ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <?php if (!empty($item['image'])) : ?>
                                                    <div class="form-label mb-3">
                                                        <label class="form-label">Current Image</label><br>
                                                        <img src="<?= base_url('img/kategori/' . $item['image']) ?>" width="100px" alt="Current Image">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="image<?= $item['id'] ?>">New Image</label>
                                                    <input type="file" class="form-control" name="image" id="image<?= $item['id'] ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <!-- Modal Add -->
                <div class="modal fade" id="addModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('admin/produk') ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="price">Price</label>
                                        <input type="number" class="form-control" name="price" id="price" value="" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="stok">Stock</label>
                                        <input type="number" class="form-control" name="stock" id="stok" value="" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-select" name="category_id" id="category_id" required>
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category['id'] ?>"><?= esc($category['category_type']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Add End -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>