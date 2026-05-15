        </div> <!-- End Main Content -->
    </div> <!-- End Row -->
</div> <!-- End Container -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
<?php if (isset($_SESSION['flash_message'])): ?>
    Swal.fire({
        icon: '<?= ($_SESSION['flash_type'] ?? 'success') === 'success' ? 'success' : 'error' ?>',
        title: '<?= ($_SESSION['flash_type'] ?? 'success') === 'success' ? 'نجاح!' : 'تنبيه' ?>',
        text: '<?= addslashes($_SESSION['flash_message']) ?>',
        confirmButtonText: 'حسناً',
        confirmButtonColor: '#d4af37'
    });
<?php
    unset($_SESSION['flash_message']);
    unset($_SESSION['flash_type']);
endif;
?>
</script>
</body>
</html>
