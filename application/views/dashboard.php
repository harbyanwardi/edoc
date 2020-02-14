<?php 
  echo $header; 
  echo link_tag('assets/css/skins/_all-skins.min.css');
  echo link_tag('assets/plugins/iCheck/flat/blue.css');
  echo link_tag('assets/plugins/morris/morris.css');
  echo link_tag('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css');
  echo link_tag('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
?>
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b>ON</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>RKAS</b>ONLINE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#">
              <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <span class="hidden-xs">Selamat datang, Harby</span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-book"></i> <span>Siswa</span>
              <span class="pull-right-container">
                <i class="glyphicon glyphicon-triangle-bottom pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#" id="cat_siswa"><i class="fa fa-circle-o"></i> Kategori Siswa</a></li>
              <li><a href="#" id="data_siswa"><i class="fa fa-circle-o"></i> Jumlah Siswa</a></li>
            </ul>
          </li>
        </ul>


        <ul class="sidebar-menu">
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-book"></i> <span>Data Transaksi</span>
              <span class="pull-right-container">
                <i class="glyphicon glyphicon-triangle-bottom pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#" id="data_penerimaan"><i class="fa fa-circle-o"></i> Penerimaan</a></li>
              <li><a href="#" id="data_pengeluaran"><i class="fa fa-circle-o"></i> Pengeluaran</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-th-list"></i> <span>Rekapitulasi</span>
              <span class="pull-right-container">
                <i class="glyphicon glyphicon-triangle-bottom pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#" id="triwulan_table"><i class="fa fa-circle-o"></i> Triwulan</a></li>
              <li><a href="#" id="tahunan_table"><i class="fa fa-circle-o"></i> Tahunan</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="<?php echo base_url("auth/logout"); ?>">
              <i class="glyphicon glyphicon-log-out"></i> <span>Logout</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content" id="container">
    <div class="box">
  <div class="box-header">
    <h3 class="box-title">Kategori Siswa</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <ul class="list-group" id="lg">
      <?php
        $i = 0;

        foreach ($cat as $value) {
          echo '<li class="list-group-item" data-name="' . $value['keterangan'] . '">' . $value['keterangan'];
          
          if($this->session->userdata('role')) {
            echo $i++ > 0 ? '<span class="pull-right-container"><i class="fa fa-times pull-right"></i></span>' : '';
          }
          echo "</li>";
        }
      ?>
      <?php if($this->session->userdata('role')): ?>
      <li class="list-group-item" id="newCat">Tambah Baru<span class="pull-right-container"><i class="glyphicon glyphicon-plus pull-right"></i></span></li>
      <?php endif; ?>
    </ul> 
  </div>
</div>

<!-- /.row (main row) -->

<div id="modalCat" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title" id="modalCatTitle">Kategori</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" id="editorCat">
        <input type="hidden" class="form-control" id="flag" value="">
        <input type="hidden" class="form-control" id="old" value="">
        <div class="box-body">
          <div class="form-group">
            <div class="col-sm-12">
              <input type="text" class="form-control" id="catName" required>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-info pull-right" id="update">Edit</button>
          <button type="submit" class="btn btn-info pull-right" id="delete" style="margin-right: 20px;">Hapus</button>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>

  </div>
</div>

<script>
  var ft = null,
  	$kelas = null,
  	$date = "<?php echo $date; ?>",
    $modal = $('#modal'),
    $editor = $('#editor');

  $( ".list-group-item:not(:first)" ).click(function() {
    //$("#modalCatTitle").html($(this).html());
    $("#editorCat").find('#catName').val("");
    
    if(<?php echo $this->session->userdata('role'); ?>) {
        if ($(this).attr('id') == "newCat") {
          $("#editorCat").find('#flag').val("1");
          $("#editorCat").find('#update').html("Tambah");
          $('#delete').hide();
        } else {
          $("#editorCat").find('#flag').val("0");
          $("#editorCat").find('#old').val($(this).attr("data-name"));
          $("#editorCat").find('#update').html("Edit");
          $("#editorCat").find('#catName').val($(this).attr("data-name"));
          $('#delete').show();
        }
        
        $("#modalCat").modal('show');
    }
  });

  $('#save').on('click', function(e) {
    if (this.checkValidity && !this.checkValidity()) return;
    e.preventDefault();  
    $modal.modal('hide');

    var row = $modal.data('row'),
      total = 0;

      <?php 
        foreach ($cat as $value){
          echo "S" . $value['kode'] . " = parseInt($('#editor').find('#S" . $value['kode'] . "').val());";
          echo "total += S" . $value['kode'] . ";";
        }
      ?>
      values = {
        kode: $editor.find('#jenjang').val(),
        <?php 
          foreach ($cat as $value) echo "S" . $value['kode'] . ": S" . $value['kode'] . ",";
        ?>
        total: total
      };

      if (row instanceof FooTable.Row) {
          rows_func(values);
          row.val(values);
      }
  });

  $('#update, #delete').on('click', function(e) {
    if (this.checkValidity && !this.checkValidity()) return;
    e.preventDefault();
    $("#modalCat").modal('hide');

    var values = {
      flag: $("#editorCat").find('#flag').val(),
      name: $("#editorCat").find('#catName').val()
    }

    if (values.flag == "0") values.old = $("#editorCat").find('#old').val();
    if ($(this).attr('id') == "delete") values.flag = "2";
    var json = JSON.stringify(values);
    
    $.ajax({
        url : 'dashboard/kategori_siswa',
        data: {'data': json},
        type: "post",
        success : function(data) {
          reload_me('cat_siswa');
        },
        error : function(xhr, statusText, error) { 
            alert(xhr+ statusText+ error);
        }
    });
  });
</script>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js');?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  //$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/moment.js');?>"></script>
<script src="<?php echo base_url('assets/js/footable.js');?>"></script>
<!-- daterangepicker -->

<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js');?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/app.min.js');?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/js/dashboard.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>
<script type="text/javascript">
  $("#data_penerimaan, #cat_siswa, #data_siswa, #data_pengeluaran, #triwulan_table, #tahunan_table").click(function() {
    reload_me($(this).attr('id'));
  });

  function reload_me(url){
    $.ajax({
      url: "dashboard/" + url,
      success: function(data){
        $("#container").html(data);
      },
      error: function(xhr, statusText, error) {}
    });
  }
</script>
</body>
</html>