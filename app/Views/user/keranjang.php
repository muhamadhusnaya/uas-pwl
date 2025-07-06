<?= $this->extend('layout/layout_user') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card" style="margin-bottom:10px">
                <h5 class="card-header">Cart</h5>
                
                <div class="table-responsive text-nowrap">
                        <div class="demo-inline-spacing">
                            <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td><span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">Susu Kedelai Organik</span></td>
                        <td>1.900.000</td>
                        <td><input type="number" value="1"></td>
                        <td>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                      </tr>
                      <tr>
                        
                        <td><span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">Apple Orcant</span></td>
                        <td>90.000</td>
                        <td><input type="number" value="2"></td>
                        <td>  
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<a href="checkout">
    <button type="button" class="btn rounded-pill btn-outline-success" style="margin-right:10px">
    <span class="icon-base bx bx-cart icon-sm me-2"></span>Finsh Payment
</button>
</a>

<a href="home">
    <button type="button" class="btn rounded-pill btn-outline-primary" >
    <span class="icon-base bx bx-plus icon-sm me-2"></span>Buy More
    </button>
</a>
<a href="">
    <button type="button" class="btn rounded-pill btn-outline-warning">
    <span class="icon-base bx bx-chart icon-sm me-2"></span>Update Cart
    </button>
</a>

</div>
    
<?= $this->endSection() ?>