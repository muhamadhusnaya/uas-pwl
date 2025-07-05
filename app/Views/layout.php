<!doctype html>

<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: Dashboard - Analytics | Sneat - Bootstrap Dashboard FREE</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <?= $this->include('components/sidebar') ?>

        <!-- Layout container -->
        <div class="layout-page">
          
        <?= $this->include('components/header') ?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <?= $this->renderSection('content') ?>

            <?= $this->include('components/footer') ?>

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/popper/popper.js"></script>
    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/js/bootstrap.js"></script>

    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->

    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="sneat-bootstrap-html-admin-template-free-v3.0.0/sneat-bootstrap-html-admin-template-free/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
