<?= $this->extend('layout/layout_user') ?>
<?= $this->section('content') ?>
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
<div class="row mb-12 g-6">
    <?php foreach ($produk as $item) : ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img class="card-img-top" src="<?= base_url('img/produk/' . $item['images']) ?>" alt="<?= esc($item['name']) ?>" />
                <div class="card-body">
                    <h5 class="card-title"><?= esc($item['name']) ?></h5>
                    <p class="card-text">Rp. <?= number_format($item['price'], 0, ',', '.') ?>.000</p>
                    <form action="<?= base_url('keranjang/add') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <input type="hidden" name="name" value="<?= esc($item['name']) ?>">
                        <input type="hidden" name="price" value="<?= $item['price'] ?>">
                        <input type="hidden" name="image" value="<?= $item['images'] ?>">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bx bx-cart-add"></i> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>