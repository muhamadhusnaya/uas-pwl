<?= $this->extend('layout/layout_user') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card" style="margin-bottom:10px">
        <h5 class="card-header">Cart</h5>

        <!-- Alert untuk menampilkan pesan -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive text-nowrap">
            <div class="demo-inline-spacing">
                <?php if (empty($items)) : ?>
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Keranjang Kosong</h4>
                        <p>Belum ada produk dalam keranjang belanja Anda.</p>
                        <hr>
                        <p class="mb-0"><a href="<?= base_url() ?>" class="btn btn-primary">Mulai Belanja</a></p>
                    </div>
                <?php else : ?>
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td>
                                        <img src="<?= base_url('img/produk/' . $item['image']) ?>"
                                            alt="<?= esc($item['name']) ?>"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>
                                        <span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">
                                            <?= esc($item['name']) ?>
                                        </span>
                                    </td>
                                    <td>Rp. <?= number_format($item['price'], 0, ',', '.') ?>.000</td>
                                    <td>
                                        <form action="<?= base_url('keranjang/update') ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="number" name="qty" value="<?= $item['qty'] ?>"
                                                min="1" max="99" style="width: 80px;"
                                                class="form-control form-control-sm d-inline-block"
                                                onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td>Rp. <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>.000</td>
                                    <td>
                                        <a href="<?= base_url('keranjang/remove/' . $item['id']) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus produk ini dari keranjang?')">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total:</th>
                                <th>Rp. <?= number_format($total, 0, ',', '.') ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($items)) : ?>
        <div class="col-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Checkout</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('keranjang/process') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-6">
                            <label for="username" class="form-label">Username</label>
                            <input
                                class="form-control"
                                type="text"
                                id="username"
                                value="<?= session()->get('username') ?? '@username' ?>"
                                aria-label="username input example"
                                name="username"
                                readonly />
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="address">Shipping Address</label>
                            <textarea class="form-control" id="address"
                                placeholder="Masukkan alamat lengkap pengiriman"
                                name="shipping_address"
                                rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="tel" class="form-control" id="phone"
                                placeholder="Masukkan nomor telepon"
                                name="phone"
                                required />
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="notes">Notes (Optional)</label>
                            <textarea class="form-control" id="notes"
                                placeholder="Catatan tambahan untuk pesanan"
                                name="notes"
                                rows="2"></textarea>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">
                            <button type="submit" class="btn rounded-pill btn-outline-success">
                                <span class="icon-base bx bx-cart icon-sm me-2"></span>Finish Payment
                            </button>

                            <a href="<?= base_url('user/home') ?>" class="btn rounded-pill btn-outline-primary">
                                <span class="icon-base bx bx-plus icon-sm me-2"></span>Buy More
                            </a>

                            <a href="<?= base_url('keranjang/clear') ?>"
                                class="btn rounded-pill btn-outline-warning"
                                onclick="return confirm('Kosongkan semua keranjang?')">
                                <span class="icon-base bx bx-trash icon-sm me-2"></span>Clear Cart
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>