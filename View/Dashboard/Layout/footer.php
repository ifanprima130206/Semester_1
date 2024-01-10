</div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Ifan Prima Nursaid</a>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

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
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= $base_url ?>Public/assets/dashboard/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= $base_url ?>Public/assets/dashboard/vendor/libs/popper/popper.js"></script>
    <script src="<?= $base_url ?>Public/assets/dashboard/vendor/js/bootstrap.js"></script>
    <script src="<?= $base_url ?>Public/assets/dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    
    <script src="<?= $base_url ?>Public/assets/dashboard/vendor/js/menu.js"></script>
    <!-- endbuild -->
    
    <!-- Main JS -->
    <script src="<?= $base_url ?>Public/assets/dashboard/js/main.js"></script>
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.7/dist/js/select2.full.min.js"></script>
    
    <script>
        new DataTable('#myTable');

        $(document).ready(function(){

          // $('#role').select2();
        });
    </script>
  </body>
</html>
