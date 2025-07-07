<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <h5 class="card-header">Order</h5>

    <div class="table-responsive text-nowrap">
      <div class="demo-inline-spacing">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th>Name</th>
              <th>Price</th>
              <th>Amount</th>
              <th>SubTotal</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php foreach ($order as $item) : ?>
              <tr>
                <td><span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px"><?= esc($item['name']) ?></span></td>
                <td><?= number_to_currency($item['price'], 'IDR', 'id_ID', 2) ?></td>
                <td><?= esc($item['amount']) ?></td>
                <td><?= number_to_currency($item['subtotal'], 'IDR', 'id_ID', 2) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>