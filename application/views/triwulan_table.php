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
    <h3 class="box-title">Data Triwulan</h3>
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
      <div class="col-sm-push-6 col-sm-3">
        <button type="button" class="btn btn-info" id="pdfButton" style="float: right;margin-right: 15px;" disabled>Print</button>
      </div>
    </div>
    <div class="content table-responsive table-full-width">
      <table class="table table-hover table-striped" id="penerimaan">
      </table>
    </div>
  </div>
</div>
<!-- /.row (main row) -->

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
              <input type="text" class="form-control" id="keterangan">
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

<div id="pdfViewer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content" style="height: 600px">
    <object data="" type="application/pdf" width="100%" height="100%">
        
    </object>
    </div>

  </div>


</div>

<script>
  var ft = null,
    $kelas = null,
    $date = "<?php echo $date; ?>",
    $modal = $('#modal'),
    $editor = $('#editor'),
    vJson = {};

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

    $("#pdfButton").on("click", function(e) {
      var oReq = new XMLHttpRequest();

      oReq.open("POST", 'dashboard/show_pdf');
      oReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      oReq.responseType = "arraybuffer";


      oReq.onload = function(e) {
        var arraybuffer = oReq.response; // not responseText
        var blob = new Blob([arraybuffer], {type: 'application/pdf'});
        var pdfurl = window.URL.createObjectURL(blob);
        $("#pdfViewer object").attr("data", pdfurl);
        $('#pdfViewer').modal('show');
      }
      var tri = parseInt($date.substring(5));
      oReq.send("data=" + JSON.stringify(vJson) + "&tahun=" + $date + "&jenjang=" + $kelas + "&tri=" + Math.ceil(tri/3));
    });

    $('#sk1').on('change', function() {
      if ($(this).val() == 0) {
        $('#sk2').val(0);
        $('#sk2').attr('disabled','disabled');
      }
      else $('#sk2').removeAttr('disabled');
    });

    ft = FooTable.init($('#penerimaan'), {
     "columns": [{"name":"k1","title":"Uraian Sumber Dana","breakpoints":"xs sm md"},{"name":"j1","title":"Jumlah"},{"name":"k2","title":"Uraian Penggunaan","breakpoints":"xs sm md"},{"name":"j2","title":"Jumlah"}]
    });

  });

  $( "#paud, #sd, #smp, #sma, #smk" ).click(function() {
    $kelas = $(this).attr('id');
    $(".box-title").html("Data Triwulan " + $kelas.toUpperCase());
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
      url : 'dashboard/get_nth/' + k,
      method: "POST",
      data: {'date': $date, 'n': 3},
      beforeSend : function () {
        ft.$el.hide().after(ft.$loader);
      },
      complete : function () {
        ft.$el.show();
      },
      success : function(data) {
          data = JSON.parse(data);
          vJson = data;
          ft.rows.load(data);
          $('#pdfButton').prop('disabled', false);
      },
      error : function(xhr, statusText, error) { 
          alert("Error! Could not retrieve the data.");
      }
    });
  }
</script>