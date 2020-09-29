<footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright &copy; 20 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted & Made with <i class="icon-heart5 pink"></i></span></p>
</footer>

<!-- BEGIN VENDOR JS-->
<script src="/app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
<script src="/app-assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="/app-assets/js/core/app.js" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="/app-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="/app-assets/js/scrits/popover/popover.js"></script>
<script src="/app-assets/js/scrits/modal/components-modal.js"></script>
<script src="/app-assets/js/select/bootstrap.js"></script>
<script src="/app-assets/js/select/jquery-2.2.3.min.js"></script>

<script>
    function previewImg() {

        // membuat variabel
        const sampul = document.querySelector('#kuitansi');
        const sampulLebel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        sampulLebel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<script>
    function previewImg2() {

        // membuat variabel
        const sampul = document.querySelector('#foto');
        const sampulLebel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        sampulLebel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

</body>

</html>