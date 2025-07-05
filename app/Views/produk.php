<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
                <h5 class="card-header">Product</h5>
                
                <div class="table-responsive text-nowrap">
                        <button type="button" class="btn rounded-pill btn-outline-secondary">
                            <span class="icon-base bx bx-plus icon-sm me-2"></span>Tambah
                        </button>
                        <button type="button" class="btn rounded-pill btn-outline-secondary">
                            <span class="icon-base bx bx-download icon-sm me-2"></span>Download
                        </button>

                        <div class="demo-inline-spacing">
                            <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
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
                        </td>
                        <td><span class="badge text-bg-success">Ready</span></td>
                        <td>

                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="icon-base bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <span class="app-brand-text demo menu-text fw-medium ms-1" style="font-size : 14px">Apple Orcant</span>
                        </td>
                        <td>90.000</td>
                        <td>190</td>
                        <td><span class="badge text-bg-danger">Out Of Stock</span></td>
                        <td>
                            
                        </td>
                        <td>
                            <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="icon-base bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="icon-base bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="icon-base bx bx-trash me-1"></i> Delete</a
                                >
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                                            <h5 class="mb-0">Basic Layout</h5>
                                            <small class="text-body float-end">Default label</small>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-fullname">Full Name</label>
                                                <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-company">Company</label>
                                                <input type="text" class="form-control" id="basic-default-company" placeholder="ACME Inc." />
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-email">Email</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text"id="basic-default-email"class="form-control"placeholder="john.doe"aria-label="john.doe"aria-describedby="basic-default-email2" />
                                                    <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                                </div>
                                                <div class="form-text">You can use letters, numbers & periods</div>
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-phone">Phone No</label>
                                                <input type="text" id="basic-default-phone" class="form-control phone-mask" placeholder="658 799 8941" />
                                            </div>
                                            <div class="mb-6">
                                                <label class="form-label" for="basic-default-message">Message</label>
                                                <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"></textarea>
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