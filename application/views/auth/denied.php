	<!-- Begin Page Content -->
	<div class="container-fluid">

	<!-- 404 Error Text -->
	<div class="text-center">
	  <div class="error mx-auto" data-text="404">404</div>
	  <p class="lead text-gray-800 mb-5">Page Not Found</p>
	  <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
	  <a href="<?php echo base_url(); ?>user">&larr; Return to User Menu</a>
	</div>

	</div>
	<!-- /.container-fluid -->

<!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>

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
    $(document).ready(function() {
      $('.sidebar-menu').tree()
    })
  </script>

  <script>
    //untuk image file reader
    $('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    //untuk ajax role akses 
    $('.form-check-input').on('click', function() {
      const menuId = $(this).data('menu');
      const roleId = $(this).data('role');

      $.ajax({
        url: "<?php echo base_url('admin/accessupdate') ?>",
        type: "POST",
        data: {
          //object data: variabel(yang diambil dari checkbox)
          menuId: menuId,
          roleId: roleId
        },
        success: function() {
          document.location.href = "<?php echo base_url('admin/accessrole/'); ?>" + roleId;
        }
      });

    });
  </script>

  <script src="<?php echo base_url(); ?>assets/js/format-money.js"></script>
</body>

</html>