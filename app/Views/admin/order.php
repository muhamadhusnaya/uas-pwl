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
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr>
              <td><span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">Susu Kedelai Organik</span></td>
              <td>1.900.000</td>
              <td>1</td>
              <td>1.900.000</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>

              <td><span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">Apple Orcant</span></td>
              <td>90.000</td>
              <td>2</td>
              <td>180.000</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="icon-base bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>