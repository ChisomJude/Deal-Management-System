
</div>
<script type="text/javascript">
  $(document).ready(function(){
  var url = "modalbox.php";
   
    $('#modellink').click();

      

  jQuery('#modellink').click(function(e) {
    $('.modal-container').load(url,function(result){
    $('#myModal').modal({show:true});
    });
  });
  $("#modellink").click();
 
  });
  
</script>

 <?php include'modalboxx.php'; ?>

<footer class="main-footer">
    
    <strong>Copyright &copy; <a href="https://salesruby.com"> SalesRuby</a>.</strong> All rights
    reserved. <a href="https://chisomjude.com">Design Credits </a>
  </footer>

  <!-- Control Sidebar -->
  
</div>
<!-- ./wrapper -->

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap jquery UI -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="includes/parsley.min.js"></script>


<script>
$(document).ready(function(){
$('#example2, #example3').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

  });

</script>



<script>
$(document).ready(function(){
      
$('#modellink2').click(){
  $("#profile").modal();
}
 });
</script>


<script type="text/javascript">
  $(document).ready(function(){
  var url = "modalbox.php";
   
    $('#modellink').click();

      

  jQuery('#modellink').click(function(e) {
    $('.modal-container').load(url,function(result){
    $('#myModal').modal({show:true});
    });
  });
  $("#modellink").click();
 
  });
  
</script>


<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
</body>
</html>