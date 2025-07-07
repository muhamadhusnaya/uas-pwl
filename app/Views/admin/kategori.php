<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Kategori</h5>

        <div class="table-responsive text-nowrap">
            <button type="button" class="btn rounded-pill btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">
                <span class="icon-base bx bx-plus icon-sm me-2"></span>Tambah
            </button>

            <div class="demo-inline-spacing">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Name Category</th>
                            <th>Slug</th>
                            <th>img</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach ($kategori as $item) : ?>
                            <tr>
                                <td>
                                    <span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px"><?= esc($item['category_type']) ?></span>
                                </td>
                                <td><?= esc($item['slug']) ?></td>
                                <td>
                                    <?php if ($item['image']) : ?>
                                        <img src="<?= base_url('img/kategori/' . $item['image']) ?>" alt="<?= esc($item['category_type']) ?>" width="50px">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>" style="margin-right : 10px">Edit</button>
                                    <form method="post" action="<?= base_url('admin/kategori/delete/' . $item['id']) ?>" style="display: inline;">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Edit Modal untuk setiap item -->
                            <div class=" modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('admin/kategori/edit/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="category_type">Name Category</label>
                                                    <input type="text" class="form-control" name="category_type" id="category_type<?= $item['id'] ?>" value="<?= esc($item['category_type']) ?>" required />
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="form-label" for="slug">Slug</label>
                                                    <input type="text" class="form-control" name="slug" id="slug<?= $item['id'] ?>" value="<?= esc($item['slug']) ?>" required />
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
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('admin/kategori') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="category_type">Name Category</label>
                                    <input type="text" class="form-control" name="category_type" id="category_type" placeholder="Category Name" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Category Slug" required />
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="image">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
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
            <!-- Add Modal End -->
        </div>
    </div>
</div>
</div>
<script>
    function deleteCategory(id) {
        if (confirm('Are you sure you want to delete this category?')) {
            window.location.href = '<?= base_url('admin/kategori/delete/') ?>' + id;
        }
    }
</script>
<?= $this->endSection() ?>