<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2024 - CHU DE COCODY - PORTAIL RH</span>
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

<div class="gtranslate_wrapper"></div>
<script>
    window.gtranslateSettings = {
        "default_language": "fr",
        "detect_browser_language": true,
        "wrapper_selector": ".gtranslate_wrapper",
        "flag_style": "3d"
    }
</script>

<script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment quitter ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Cliquez sur "Deconnexion" pour terminer votre session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" href="<?php
                                                    echo base_url('/home/logout');
                                                    ?>">Deconnexion</a>
            </div>
        </div>
    </div>
</div>


<!--#pied-->
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('js/sb-admin-2.min.js'); ?>"></script>
<!-- Page level plugins -->
<script src="<?php echo base_url('vendor/chart.js/Chart.min.js'); ?>"></script>
<!-- Page level custom scripts -->
<script src="<?php echo base_url('js/demo/chart-area-demo.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/chart-pie-demo.js'); ?>"></script>
<!-- Page level plugins -->
<script src="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
<!-- Page level custom scripts -->
<script src="<?php echo base_url('js/demo/datatables-demo.js'); ?>"></script>
<script src="//code.tidio.co/b7ig8ovqgzgvpxwrkc50qbaplkp0pwpk.js" async></script>
</body>

</html>