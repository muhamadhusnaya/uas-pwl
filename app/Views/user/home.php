<?= $this->extend('layout/layout_user') ?>
<?= $this->section('content') ?>
<div class="row mb-12 g-6">
    <?php foreach ($produk as $item) : ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img class="card-img-top" src="<?= base_url('img/produk/' . $item['images']) ?>" alt="<?= esc($item['name']) ?>"/>
                <div class="card-body">
                    <h5 class="card-title"><?= esc($item['name']) ?></h5>
                    <p class="card-text">Rp. <?= number_format($item['price'], 0, ',', '.') ?>.000</p>
                    <a href="" class="btn btn-outline-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>