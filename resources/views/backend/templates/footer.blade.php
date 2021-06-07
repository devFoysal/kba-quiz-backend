<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    {{-- <b>Version</b> 1.00 --}}
  </div>
  <span id="bheart" class="text-md-right d-sm-block d-md-inline-block text-sm-center">
    Developed <span class="with">with <img width="1%" class="img-fluid" src="{{asset('storage/images/heart.svg')}}"
        alt="">
    </span>by <a href="http://www.beatnik.technology/" style="color: #FFC107; font-weight: 600">Beatnik</a>
  </span>
  <strong> &copy; <?php echo date('Y'); ?>
</footer>
<!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="{{asset('')}}dashboard/assets/plugins/datatables/jquery.dataTablesNew.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> --}}
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('')}}dashboard/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('')}}dashboard/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{asset('')}}dashboard/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('')}}dashboard/assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{asset('')}}dashboard/assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('')}}dashboard/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{asset('')}}dashboard/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{asset('')}}dashboard/assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('')}}dashboard/assets/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('')}}dashboard/assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('')}}dashboard/assets/dist/js/demo.js"></script>

{{-- https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js --}}

{{-- https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js
https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js

https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js
https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script> --}}



{{-- <script src="{{asset('')}}dashboard/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/datatables/buttons.flash.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/datatables/jszip.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="{{asset('')}}dashboard/assets/plugins/datatables/dataTables.select.min.js"></script> --}}

<!-- Select2 -->
<script src="{{asset('')}}dashboard/assets/plugins/select2/select2.full.min.js"></script>

<script>
  setTimeout(function(){
        $('.alert').css({'display':'none'})
      }, 1000);

    function showPreviewImage1(objFileInput) {
      if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
          $("#lableImage1").html('<img src="'+e.target.result+'" class="upload-preview" />');
          $("#lableImage1").css('opacity','0.7');
          $(".icon-choose-image").css('opacity','0.5');
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
      }
    }

     function showPreviewImage2(objFileInput) {
      if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
          $("#lableImage2").html('<img src="'+e.target.result+'" class="upload-preview" />');
          $("#lableImage2").css('opacity','0.7');
          $(".icon-choose-image").css('opacity','0.5');
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
      }
    }

    
     function showPreviewImage3(objFileInput) {
      if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
          $("#lableImage3").html('<img src="'+e.target.result+'" class="upload-preview" />');
          $("#lableImage3").css('opacity','0.7');
          $(".icon-choose-image").css('opacity','0.5');
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
      }
    }

  function reloadPage(duration){
      setTimeout(function(){
        location.reload();
      },duration);
    }
 function responseHandelar(statusCode, error, message){
      if (parseInt(statusCode) == 200 || error == null) {
        return toastr.success(message);
      }else if(parseInt(statusCode) == 500 || error == null){
        return toastr.error(message);
      }else if(parseInt(statusCode) == 404 || error == null){
        return toastr.error(message);
      }else if(parseInt(statusCode) == 401 || error == null){
        return toastr.error(message);
      }else{
        return toastr.error('Something went wrong !');
      }
    }
    
</script>

@stack('script')
</body>


</html>