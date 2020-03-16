<?php echo $nav;?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php echo $navbar; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php echo $sidebar; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>KAS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Kas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Master Kas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <?=$this->session->flashdata('pesan')?>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus-circle"></i> Tambah </button>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jumlah Kas</th>
                  <th>Kas Type</th>
                  <th>Data Masuk</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           <?php
                                         $nomor = 1;
                                         foreach($data as $d){  $id=$d['id'];?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $nomor; ?></td>
                                            <td><?php echo $d['amount']; ?></td>
                                            <td><?php echo $d['jenis_kas']; ?></td>
                                            <td><?php echo $d['created_at']; ?></td>
                                           
                                            <td align="center">
                                               <a data-toggle="modal" data-target="#modal-edit<?php echo $id;?>" class="btn btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i>Edit</a>
                                      <a href="<?php echo site_url('Welcome/delete/'.$d['id']); ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$d['amount'];?> ?');" class="btn btn-danger btn-circle" data-popup="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php 
                                            $nomor = $nomor+1; } ?>
                </tbody>
               
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
<div id="modal-tambah" class="modal fade">
    <div class="modal-dialog">
      <form action="<?php echo site_url('Welcome/add'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label class='col-md-3'>Jumlas Kas</label>
            <div class='col-md-9'><input type="text" name="amount" autocomplete="off" required placeholder="Masukkan Jumlas Kas" class="form-control" ></div>
          </div>
          <div class="form-group">
                                            <label>Type Kas</label>
                                            <select class="form-control" name="kas_type">
                                                <option  value="">Pilih Type</option>                    
                                                
                                                <option value="1">Kas Besar</option>
                                                <option value="2">Kas Office</option>
                                                <option value="3">Kas Lapangan</option>
                                               
                                            </select>    
                                        </div>
          <br>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="icon-checkmark-circle2"></i> Simpan</button>
          </div>
        </form>
    </div>
</div>  

 
</div>
<?php
        foreach($data as $i):
            $id=$i['id'];
            $amount=$i['amount'];
            $kas_type=$i['kas_type'];
            $jenis_kas=$i['jenis_kas'];
            
        ?>
        <div class="modal fade" id="modal-edit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Barang</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'Welcome/do_update'?>">
                <div class="modal-body">
 
                    <div class="form-group">
                      
                        <div class="col-xs-8">
                            <input name="kas_id" value="<?php echo $id;?>" class="form-control" type="hidden" placeholder="Kode Barang..." readonly>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jumlah Kas</label>
                        <div class="col-xs-8">
                            <input name="amount" value="<?php echo $amount;?>" class="form-control" type="text" placeholder="Jumlah Kas..." required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kas Type</label>
                        <div class="col-xs-8">
                             <select name="kas_type" class="form-control" required>
                                <option value="<?php echo $kas_type;?>"><?php echo $jenis_kas;?></option>
                               
                                    <option value="1">Kas Besar</option>
                                    <option value="2">Kas Office</option>
                                    <option value="3">Kas Lapangan</option>
                                    
                             </select>
                        </div>
                    </div>
 
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
 
    <?php endforeach;?>

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.3-pre
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
