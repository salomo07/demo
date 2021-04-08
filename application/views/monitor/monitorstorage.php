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
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

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
          <h3 class="box-title"><i class="fa fa-desktop" style="color:violet"></i> Monitor Penyimpanan Sampel</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">  
          <div class="table-responsive col-md-6">
            <center><label>Tabel Transaksi</label></center><br>
            <div style="float:left"><label><input id="chkShowProduct" onclick="chkChange(this)" type="checkbox" value="">  Lihat Transaksi & ID Produk</label></div><br><br><center id="sedangMemuat1" >Sedang memuat ...</center>
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
          <div class="table-responsive col-md-6">
            <center><label>Detail Transaksi </label></center><br><br><br><br>
            <table id="tblDetailTransaksi" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th style="text-align: center">ID Transaksi</th>
                    <th style="text-align: center">ID Produk</th>
                    <th style="text-align: center">ID Formula</th>
                    <th style="text-align: center">Batch No</th>
                    <th style="text-align: center">Batch Detail</th>
                    <th style="text-align: center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><center></center></td>
                    <td><center></center></td>
                    <td><center></center></td>
                    <td><center></center></td>
                    <td><center></center></td>
                    <td><center></center></td>
                </tr>
            </tbody>
            </table>
            <div class="col-md-6">
              <center><input id="btnEdit" style="visibility: hidden;" type="submit" class="btn" value="Edit Transaksi"></center>
            </div>
            <div class="col-md-6">
              <center><input id="btnDelete" style="visibility: hidden;" type="submit" class="btn" value="Hapus Transaksi"></center>
            </div><br><br><br><br>
            <div id="divCurrentTransaction">
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
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(".select2").select2();
  $('#tblUjiHariIni').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "bSortable": false, 
    "scrollCollapse": true,   
  });
</script>

<script>
  var idT=''; 
  $(".select2").select2();
  loadTransaksiAll();
  function viewDetail(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string')
              return el.textContent;
          if (typeof el.innerText === 'string')
              return el.innerText;
      }
      getDetailTransaksi(getText(document.getElementById('tblMonitorStorage').rows[x.rowIndex].cells[0]))      
  }
  function getDetailTransaksi(id) 
  {
    var idTrans=id;idT=id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Monitor_Storage/getDetailTransaksi?titleModal=Detail Transaksi&&bodyModal=",
        data: {idTrans : idTrans}, 
        dataType : "text",
        success : function(msg) {
          console.log(msg)
            $('#tblDetailTransaksi').html(msg);
            $('#btnEdit').css('visibility', 'visible');$('#btnEdit').val('Edit Transaksi');
            $('#btnDelete').css('visibility', 'visible'); $('#divCurrentTransaction').html('');
        }
    });
  }
  $('#btnEdit').on('click', function() 
  {
    if ( idT =='') {
        alert( 'Silahkan pilih transaksi yang akan dihapus.');
    }
    else
    {
      if($('#btnEdit').val()=='Edit Transaksi')
      {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Monitor_Storage/getTransaksiByID",
          data: {idTrans : idT}, 
          success : function(msg) {
              $('#divCurrentTransaction').html(msg);$('#btnEdit').val('Simpan Transaksi');$(".select2").select2();
          }
        });
      }
      else
      {
        var kodeKolom=$('#selectKodeKolom').val();
        var rbED=$("input[name='rbED']:checked").val();
        var rbEDS=$("input[name='rbEDS']:checked").val();
        $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Monitor_Storage/editTransaksi",
          data: {idTrans : idT,kodeKolom:kodeKolom,expiredDate:rbED,expiredDateSampel:rbEDS}, 
          success : function(msg) {
              $('#divCurrentTransaction').html("<center>"+msg+"</center>");
              window.location.href = "<?php echo site_url('Monitor_Storage') ?>";
          }
        });
      }
    }
  });
  $('#btnDelete').on('click', function() 
  {
    if (idT =='') {
        alert( 'Silahkan pilih transaksi yang akan dihapus.' );
    }
    else
    {
      $('#sedangMemuat1').text('Sedang memuat...');
      $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Storage/deleteTransaksi",
        data: {idTrans : idT}, 
        dataType : "text",
        success : function(msg) 
        {   
            console.log(msg);
            var table=$('#tblMonitorStorage').DataTable();
            table.destroy();
            $("#tblMonitorStorage").html(msg); 
            $('#tblMonitorStorage').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });
            $('#btnEdit').css('visibility', 'hidden');
            $('#btnDelete').css('visibility', 'hidden');
            $('#tblDetailTransaksi').html('');
            $('#sedangMemuat1').text('');
        }
      });
    }
  });
  function loadTransaksiAll()
  {
      $('#sedangMemuat1').text('Sedang memuat...');
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Monitor_Storage/getTransaksiAll",
          success : function(msg) 
          {
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
  function chkChange(ele)
  {
    if($(ele).is(':checked'))
    {
      $('#sedangMemuat1').text('Sedang memuat...');
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Monitor_Storage/getTransaksiAll2",
          success : function(msg) {
              $('#sedangMemuat1').text('');
              var table=$('#tblMonitorStorage').DataTable();
              table.destroy();
              $('#divTblMonitor').html(msg);
              $('#tblMonitorStorage').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });
          }
      });
    }
    else
    {
      loadTransaksiAll();
    }
  }
</script>


<!--<script> 
$('#datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });
</script>-->