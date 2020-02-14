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
      </div>    </a>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Penerimaan</h3>
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
      <table class="table table-hover table-striped" id="penerimaan">
      </table>
    </div>
  </div>
</div>
<!-- /.row (main row) -->

<datalist id="komponen">
    <?php 
        if (isset($components)) {
            foreach ($components as $c) {
                echo '<option value="';
                echo $c['komponen'];
                echo '" />';
                // echo '<option value="' + $c[0] + '" />';
            }
        }
    ?>
</datalist>

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
        <input type="hidden" class="form-control" id="no" value="">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Komponen</label>

            <div class="col-sm-10">
              <input type="text" class="form-control" id="keterangan" list="komponen" autocomplete="off" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Satuan</label>

            <div class="col-sm-10">
              <input type="number" class="form-control" id="nominal">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Kelas</label>

            <div class="col-sm-10">
              <select class="form-control" id="sk1">
                <option value="0"></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Kategori</label>

            <div class="col-sm-10">
              <select class="form-control" id="sk2" disabled>
                <option value="0"></option>
              </select>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-info pull-right" id="save">Update</button>
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
      minDate: '2017-01',
        viewMode: 'years',
        format: 'YYYY-MM',
        defaultDate: $date
    });

    $("#dtp").on("dp.update", function(e) {
        $date = $("#dtp").find("input").val();
        ajax_table($kelas);
    });

    $('#sk1').on('change', function() {
      if ($(this).val() == 0) {
        $('#sk2').val(0);
        $('#sk2').attr('disabled','disabled');
      }
      else $('#sk2').removeAttr('disabled');
    });

    ft = FooTable.init($('#penerimaan'), {
     "columns": [{"name":"no","title":"No","visible":false},{"name":"keterangan","title":"Komponen","breakpoints":"xs sm md"},{"name":"kelas","title":"Kelas","visible":false},{"name":"nominal","title":"Satuan"},{"name":"jumlah_siswa","title":"Jumlah Siswa"},{"name":"jumlah","title":"Nominal"}],
      "editing": {
        "enabled": <?php echo $this->session->userdata('role') ? 'true' : 'false'; ?>,
        "alwaysShow": true,
        addRow: function() {
          $editor[0].reset();
          $('#modalTitle').text('Tambah Baru');
          $modal.modal('show');
        },
        editRow: function(row) {
          var values = row.val();
          $editor.find('#no').val(values.no);
          $editor.find('#keterangan').val(values.keterangan);
          $editor.find('#nominal').val(parseInt(values.nominal.replace(/,/g, "")));
          
          $editor.find('#sk1').val(values.kelas);
          $modal.data('row', row);
          $('#modalTitle').text(values.keterangan);
          $modal.modal('show');
        },
        deleteRow: function(row) {
          if (confirm('Are you sure you want to delete this row?')) {
            var values = row.val(),
              no = {
                no: values.no
              }
            rows_func(no, 3);
            row.delete();
          }
        }
      }
    });
  });

  $( "#paud, #sd, #smp, #sma, #smk" ).click(function() {
    $kelas = $(this).attr('id');
    $(".box-title").html("Data Penerimaan " + $kelas.toUpperCase());
    ajax_table($kelas);
  });

  $('#save').on('click', function(e) {
    if (this.checkValidity && !this.checkValidity()) return;
    e.preventDefault();  
    $modal.modal('hide');


    var row = $modal.data('row'),
      a = $("#sk1").val() ? $("#sk1").val() : 0,
      b = $("#sk2").val() ? $("#sk2").val() : 0,
      values = {
        no: $editor.find('#no').val(),
        keterangan: $editor.find('#keterangan').val(),
        nominal: $editor.find('#nominal').val(),
        bulan: $date + "-01",
        kelas: k + a + b
      };

    if (row instanceof FooTable.Row) {
      rows_func(values, 2);
      row.val(values);
    } else {
      rows_func(values, 1);
    }
  });

  function rows_func(content, flag){
    content.flag = flag;
    var json = JSON.stringify(content);

    $.ajax({
        url : 'dashboard/update_bp',
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
      url : 'dashboard/get_penerimaan/' + k,
      method: "POST",
      data: {'date': $date},
      success : function(data) {
          data = JSON.parse(data);
          ft.rows.load(data);
      },
      beforeSend : function () {
        ft.$el.hide().after(ft.$loader);
      },
      complete : function () {
        ft.$el.show();
      },
      error : function(xhr, statusText, error) { 
          alert("Error! Could not retrieve the data.");
      }
    });

    $.ajax({
      url : 'dashboard/get_kelas/' + k,
      success : function(data) {
        $("#sk1").html('<option value="0">' + $kelas.toUpperCase() + '</option>');
        data = JSON.parse(data);
        var i = 1;

        data.forEach(function(entry) {
          $("#sk1").append('<option value="' + (i++) + '">' + entry.kelas + '</option>');
        });
      },
      error : function(xhr, statusText, error) { 
          alert("Error! Could not retrieve the data.");
      }
    });

    $.ajax({
      url : 'dashboard/get_cat',
      success : function(data) {
        $("#sk2").html('<option value="0"></option>');
        data = JSON.parse(data);

        data.forEach(function(entry) {
          $("#sk2").append('<option value="' + entry.kode + '">' + entry.keterangan + '</option>');
        });
      },
      error : function(xhr, statusText, error) { 
          alert("Error! Could not retrieve the data.");
      }
    });
  }
</script>