      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo date('Y') ?> <a href="<?php echo base_url(); ?>">Keuangan Daerah</a>.</span> All rights reserved.
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?php echo base_url() ?>auth/logout">Logout</a>
            </div>
          </div>
        </div>
      </div>

      <!-- <script src="<?php echo base_url(); ?>assets/js/format-money.js"></script> -->
      <!-- <script src="<?php echo base_url(); ?>assets/js/search_autocomplete.js"></script> -->

      <!-- Custom Script -->
      <script src="<?php echo base_url(); ?>assets/sweet_alert/dist/sweetalert2.all.min.js"></script>

      <script>
        $('.button-delete').on('click', function(e) {

          e.preventDefault();
          const href = $(this).attr('href');

          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
          }).then((result) => {
            if (result.value) {
              document.location.href = href;
            }
          });
        });
      </script>

      <script>
        window.setTimeout(function() {
          $(".alert").fadeTo(3000, 500).slideUp(500, function() {
            $(this).remove();
          });
        })
      </script>

      <!-- <script>
        $(document).ready(function() {
          $('.sidebar-menu').tree()
        })
      </script> -->

      <script>
        //untuk ajax role akses
        $('.access-input').on('click', function() {
          const menuId = $(this).data('menu');
          const roleId = $(this).data('role');

          $.ajax({
            url: "<?php echo base_url('usercontrol/accessupdate') ?>",
            type: "POST",
            data: {
              //object data: variabel(yang diambil dari checkbox)
              menuId: menuId,
              roleId: roleId
            },
            success: function() {
              document.location.href = "<?php echo base_url('usercontrol/accessrole/'); ?>" + roleId;
            }
          });

        });
      </script>
      </body>

      </html>