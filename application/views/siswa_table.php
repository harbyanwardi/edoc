<div class="row">
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <a href="#" class="small-box bg-aqua" id="paud">
      <div class="inner">
        <h3>PAUD</h3>
      </div>
    </a>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <a href="#" class="small-box bg-green" id="sd">
      <div class="inner">
        <h3>SD</h3>
      </div>
    </a>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <a href="#" class="small-box bg-yellow" id="smp">
      <div class="inner">
        <h3>SMP</h3>
      </div>
    </a>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <a href="#" class="small-box bg-red" id="sma">
      <div class="inner">
        <h3>SMA</h3>
      </div>
    </a>
  </div>
  <!-- ./col -->
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <a href="#" class="small-box bg-red" id="smk">
      <div class="inner">
        <h3>SMK</h3>
      </div>
    </a>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title" id="boxTitle">Siswa</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <div class='input-group date' id='dtp'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
            </div>
        </div>
    </div>
  </div>

    <div class="content table-responsive table-full-width">
      <table class="table table-hover table-striped" id="siswa"></table>
    </div>
  </div>
</div>

<div id="modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title" id="modalTitle">Horizontal Form</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" id="editor">
        <input type="hidden" class="form-control" id="jenjang" value="">
        <div class="box-body">
          <?php foreach ($cat as $value): ?>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $value['keterangan'];?></label>

            <div class="col-sm-10">
              <input type="number" class="form-control" id="S<?php echo $value['kode'];?>">
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-info pull-right" id="save">Edit</button>
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

  $(function () {  
    $('#dtp').datetimepicker({
      minDate: '2017-07',
        viewMode: 'years',
        format: 'YYYY-MM',
        defaultDate: $date
    });

    $("#dtp").on("dp.update", function(e) {
        $date = $("#dtp").find("input").val();
        ajax_table($kelas);
    });

    ft = FooTable.init($('#siswa'), {
      "columns": <?php echo $cols;?>,
      "editing": {
        "enabled": <?php echo $this->session->userdata('role') ? 'true' : 'false'; ?>,
        "allowAdd": false,
        "allowDelete": false,
        "alwaysShow": true,
        editRow: function(row) {
            var values = row.val();
            $editor.find('#jenjang').val(values.id);

            <?php
              foreach ($cat as $value) {
                echo '$editor.find("#S' . $value['kode'] . '").val(values.S' . $value['kode'] . ');';
              }
            ?>
            $modal.data('row', row);
            $('#modalTitle').text('Siswa ' + values.jenjang);
            $modal.modal('show');
        },
      }
    });
  });

  $( "#paud, #sd, #smp, #sma, #smk" ).click(function() {
    $kelas = $(this).attr('id');
    $("#boxTitle").html("Siswa " + $kelas.toUpperCase());
    ajax_table($kelas);
  });

  $('#save').on('click', function(e) {
    if (this.checkValidity && !this.checkValidity()) return;
    e.preventDefault();  
    $modal.modal('hide');

    var inp = {};

  $('#editor input').each(function(){
    inp[$(this).attr('id')] = $(this).val();
  });

  var values = {
      kode: $editor.find('#jenjang').val(),
      num: inp
    };

    rows_func(values);
  });

  function rows_func(content){
    delete content.num.jenjang;
    content.date = $date;
    var json = JSON.stringify(content);
    
    $.ajax({
        url : 'dashboard/update_siswa',
        data: {'data': json},
        type: "post",
        success : function(data) {
            ajax_table($kelas);
            },
        error : function(xhr, statusText, error) { 
            alert(xhr+ statusText+ error);
        }
    });
  }

  function ajax_table(kelas) {
    switch(kelas) {
      case "paud":
        k = "A";
        break;
      case "sd":
        k = "B";
        break;
      case "smp":
        k = "C";
        break;
      case "sma":
        k = "D";
        break;
      case "smk":
        k = "E";
        break;
    }

    $.ajax({
      url : 'dashboard/get_siswa/' + k,
      method: "POST",
      data: {'date': $date},
      beforeSend : function () {
        ft.$el.hide().after(ft.$loader);
      },
      complete : function () {
        ft.$el.show();
      },
      success : function(data) {
          data = JSON.parse(data);
          ft.rows.load(data);
      },
      error : function(xhr, statusText, error) { 
          alert("Error! Could not retrieve the data.");
      }
    });
  }
</script>