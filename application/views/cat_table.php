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