<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG Sample Locator</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">

</head>
<?php $this->load->view('template/linklogin');?>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  <header class="main-header">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas"></a>
    <?php echo $dataMenu;?>
  </header>
  <?php echo $dataSidebar;?>

  <div class="content-wrapper">
    <section class="content-header"><br>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"> PSG Sample Locator</a></li>
        <li class="active"><?php echo $this->router->fetch_class();?></li>
      </ol>
    </section>
    

    <section class="content">
      <div class="row"></div>
      <div class="box" style="border-top-color: violet;"> 
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-external-link" style="color:violet"></i> Histori Pengeluaran Sampel</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">  
          <div class="col-md-7">
            <div>
              <center><label>Tabel Histori Pengeluaran</label></center><br>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label>Tanggal Pengeluaran :</label>
                    <div class="radio" id="rgSwitchTanggalOut" disabled="">
                      <form>
                        <label>
                          <input type="radio" name="rgSwitchTanggalOut" value="hariini" >
                          Tanggal Hari Ini
                        </label>
                        <label> </label>
                        <label>
                          <input type="radio" name="rgSwitchTanggalOut" value="pilih">
                          Pilih Tanggal
                        </label>
                        <label></label>
                        <label>
                          <input type="radio" name="rgSwitchTanggalOut" value="all" checked>
                          Semua Tanggal
                        </label>
                        <label></label>
                      </form>
                    </div>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="txtTanggalOut" class="form-control pull-right" disabled>
                    </div>
                  </div>
                </div>
              </div>
              <br><br><center id="sedangMemuat1" >Sedang memuat ...</center>
              <div id="divTblMonitor" class="table-responsive">
                <table id="tblMonitorStorage" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><center>ID Transaksi</center></th>
                      <th><center>Kategori</center></th>
                      <th><center>Filler</center></th>
                      <th><center>PD</center></th>
                      <th><center>Kolom</center></th>
                      <th><center>Umur</center></th>
                      <th><center>BN</center></th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr onclick="viewDetail(this)"> 
                        <div>  
                        <td><center></center></td>          
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <div>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="table-responsive">
              <center><label>Detail Transaksi </label></center><br><br><br>
              <table id="tblDetailTransaksi" class="table table-bordered table-hover">
                <thead>
                  <tr>
                      <th style="text-align: center">ID Transaksi</th>
                      <th style="text-align: center">ID Produk</th>
                      <th style="text-align: center">ID Formula</th>
                      <th style="text-align: center">Batch No</th>
                      <th style="text-align: center">Batch Detail</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                  </tr>
              </tbody>
              </table><br><br><br>
              <div id="divCurrentTransaction">
              </div>
            </div>
          </div>
        </div> 
      </div>
      <div class="box" style="border-top-color: violet;"> 
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-flask" style="color:violet"></i> Histori Pengujian Sampel</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body"> 
          <div class="col-md-7">
            <center><label>Tabel Histori Pengujian</label></center><br><br><center id="sedangMemuat2" >Sedang memuat ...</center>
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Tanggal Pengujian :</label>
                  <div class="radio" id="rgSwitchTanggalUji" disabled="">
                    <form>
                      <label>
                        <input type="radio" name="rgSwitchTanggalUji" value="hariini" >
                        Tanggal Hari Ini
                      </label>
                      <label> </label>
                      <label>
                        <input type="radio" name="rgSwitchTanggalUji" value="pilih">
                        Pilih Tanggal
                      </label>
                      <label></label>
                      <label>
                        <input type="radio" name="rgSwitchTanggalUji" value="all" checked>
                        Semua Tanggal
                      </label>
                      <label></label>
                    </form>
                  </div>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="txtTanggalUji" class="form-control pull-right" disabled>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="tblHistoriUji" class="table table-bordered table-hover" >
                <thead>
                  <tr>
                    <th><center>ID Transaksi</center></th>
                    <th><center>Kategori</center></th>
                    <th><center>Filler</center></th>
                    <th><center>PD</center></th>
                    <th><center>Kolom</center></th>
                    <th><center>Umur</center></th>
                    <th><center>BN</center></th>
                  </tr>
                </thead>
                <tbody>
                    <tr onclick="viewDetail(this)"> 
                      <div>  
                      <td><center></center></td>          
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <div>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-5">  
            <center><label>Detail Transaksi</label></center><br><br>
            <div class="table-responsive">
              <table id="tblDetailHistoriUji" class="table table-bordered table-hover" >
                <thead>
                  <tr>
                    <th><center>ID Transaksi</center></th>
                    <th><center>Kategori</center></th>
                    <th><center>Filler</center></th>
                    <th><center>PD</center></th>
                    <th><center>Kolom</center></th>
                    <th><center>Umur</center></th>
                    <th><center>BN</center></th>
                  </tr>
                </thead>
                <tbody>
                    <tr onclick="viewDetail(this)"> 
                      <div>  
                      <td><center></center></td>          
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <div>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> 
      </div>
      <div id="myModal" class="modal draggable fade" tabindex="-1" role="dialog"></div>
    </section>

  <div id="lala"></div>
    <?php $this->load->view('template/control_sidebar'); ?>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <center><strong>Copyright &copy; 2016 <a href="<?php echo base_url(); ?>">PT. Sambu Guntung</a>.</strong> All rights
    reserved.</center>
  </footer>
</div>
</body>
</html>
<div id="myModalChangePassword" class="modal fade" tabindex="-1" role="dialog"></div>
<?php $this->load->view('template/scripthome');?>
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>


<script>
  var idT=''; 
  function viewDetail(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string')
              return el.textContent;
          if (typeof el.innerText === 'string')
              return el.innerText;
      }
      if($(x).closest('table').attr('id')=='tblMonitorStorage')
      {
        getDetailTransaksi(getText(document.getElementById('tblMonitorStorage').rows[x.rowIndex].cells[0]));
      }
      else if($(x).closest('table').attr('id')=='tblHistoriUji')
      {
        getDetailTransaksi2(getText(document.getElementById('tblHistoriUji').rows[x.rowIndex].cells[0]));
      }    
  }
  function getDetailTransaksi(id) 
  {
    var idTrans=id;idT=id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Monitor_Out/getDetailOut",
        data: {idTrans : idTrans}, 
        dataType : "text",
        success : function(msg) {
            $('#tblDetailTransaksi').html(msg);
        }
    });
  }
  function getDetailTransaksi2(id) 
  {
    var idTrans=id;idT=id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Monitor_Out/getDetailUji",
        data: {idTrans : idTrans}, 
        dataType : "text",
        success : function(msg) {
          //console.log(msg);
            $('#tblDetailHistoriUji').html(msg);
        }
    });
  }
  function loadHistoriOut(tgl)
  {
      if(typeof(tgl)!='undefined'){tgl=tgl.replace(/\\/g, '-');}
      $('#sedangMemuat1').text('Sedang memuat...');
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Monitor_Out/getHistoriTransaksiOut",
          data : { 'tgl': tgl},
          success : function(msg) {     
            var table=$('#tblMonitorStorage').DataTable();
            table.destroy();
            $("#tblMonitorStorage").html(msg); 
            $('#tblMonitorStorage').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });   
            $('#sedangMemuat1').text('');
          }
          
      });
  }
  function loadHistoriUji(tgl)
  {
      if(typeof(tgl)!='undefined'){tgl=tgl.replace(/\\/g, '');}
      $('#sedangMemuat2').text('Sedang memuat...');
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Monitor_Out/getHistoriTransaksiUji",
          data : { 'tgl': tgl},
          success : function(msg) { 
          console.log();    
            var table=$('#tblHistoriUji').DataTable();
            table.destroy();
            $("#tblHistoriUji").html(msg); 
            $('#tblHistoriUji').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });   
            $('#sedangMemuat2').text('');
          }
          
      });
  }
  $('#txtTanggalOut').datepicker({
      autoclose: true,format: 'dd-mm-yyyy'
  });
  $('#txtTanggalUji').datepicker({
      autoclose: true,format: 'dd-mm-yyyy'
  });
  $('#txtTanggalUji').datepicker().on('changeDate', function (ev) 
  {
    loadHistoriUji($('#txtTanggalUji').val());
  });


  $('#txtTanggalOut').datepicker().on('changeDate', function (ev) 
  {
    loadHistoriOut($('#txtTanggalOut').val());
  });
  $('#rgSwitchTanggalOut').on('change', function() 
  {
    if($("input[name='rgSwitchTanggalOut']:checked").val()=='pilih')
    {
      $('#txtTanggalOut').prop('disabled', false);
    }
    else if($("input[name='rgSwitchTanggalOut']:checked").val()=='hariini')
    {
      var d = new Date();var month = d.getMonth()+1;var day = d.getDate();var output =(day<10 ? '0' : '') + day+'/'+(month<10 ? '0' : '') + month +'/'+d.getFullYear();
      $("#txtTanggalOut").val(output);loadHistoriOut($('#txtTanggalOut').val());$('#txtTanggalOut').prop('disabled', true);
    }
    else
    {
      loadHistoriOut($('#txtTanggalOutz').val());$("#txtTanggalOut").val('');
    }
  });

  $('#rgSwitchTanggalUji').on('change', function() 
  {
    if($("input[name='rgSwitchTanggalUji']:checked").val()=='pilih')
    {
      $('#txtTanggalUji').prop('disabled', false);
    }
    else if($("input[name='rgSwitchTanggalUji']:checked").val()=='hariini')
    {
      var d = new Date();var month = d.getMonth()+1;var day = d.getDate();var output =(day<10 ? '0' : '') + day+'/'+(month<10 ? '0' : '') + month +'/'+d.getFullYear();
      $("#txtTanggalUji").val(output);loadHistoriUji($('#txtTanggalUji').val());$('#txtTanggalUji').prop('disabled', true);
    }
    else
    {
      loadHistoriUji($('#txtTanggalUjiz').val());$("#txtTanggalUji").val('');
    }
  });
  loadHistoriOut();
  loadHistoriUji();
</script>