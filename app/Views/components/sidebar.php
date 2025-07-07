<!-- Menu -->
<?php $uri = service('uri');
$segment1 = $uri->getSegment(1);
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="dashboard" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="<?= base_url() ?>/img/OrganicstationLogo.png" style="width : 40px">
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-1" style="font-size : 24px">Organicstation</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
    </a>
  </div>

  <div class="menu-divider mt-0"></div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item <?= ($segment1 == 'dashboard') ? 'active' : 'text-dark' ?>">
      <a
        href="dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-smile"></i>
        <div class="text-truncate" data-i18n="Email">Dashboard</div>
      </a>
    </li>
    <li class="menu-item <?= ($segment1 == 'produk') ? 'active' : 'text-dark' ?>">
      <a
        href="produk" class="menu-link">
        <i class="menu-icon tf-icons bx bx-store"></i>
        <div class="text-truncate" data-i18n="Email">Product</div>
      </a>
    </li>
    <li class="menu-item <?= ($segment1 == 'order') ? 'active' : 'text-dark' ?>">
      <a
        href="order" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cart"></i>
        <div class="text-truncate" data-i18n="Email">Order</div>
      </a>
    </li>
    <li class="menu-item <?= ($segment1 == 'kategori') ? 'active' : 'text-dark' ?>">
      <a
        href="kategori" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cart"></i>
        <div class="text-truncate" data-i18n="Email">Category</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->