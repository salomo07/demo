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
      <div class="box box-info"> 
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cubes" style="color:#00c0ef"></i> Tabel Transaksi Hari Ini</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body" style="overflow: auto">  
          <table id="tblTransaksiHariIni" class="table table-bordered table-hover" style="overflow: auto">
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
                  <td><center></center></td>          
                  <td><center></center></td>
                  <td><center></center></td>
                  <td><center></center></td>
                  <td><center></center></td>
                  <td><center></center></td>
                  <td><center></center></td>
                </tr>
            </tbody>
          </table>

          <center><label>Pending : </label>
          <center>
          <p>Form baru untuk input sampel yang tidak terencana/tidak ada dalam data WTP</p>
          <p>Tambah radiobutton expire of sample 24 bulan pada penyimpanan sampel</p>
          <center>
        </div> 
      </div>
    </section>
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
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"></div>
<?php $this->load->view('template/scripthome');?>
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>  
  function getTransaksiHariIni() 
  {
    $.ajax({
          url: "<?php echo base_url();?>Storage/getTransaksiHariIni",
          success: function (response) 
          {
            var table=$('#tblTransaksiHariIni').DataTable();
            table.destroy();
            $("#tblTransaksiHariIni").html(response);    
            $('#tblTransaksiHariIni').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });       
          }
      });
  }
  function getKodeKolom(x)
  {
    $('#txtKodeKolom').val(document.getElementById('tblLocatorAll').rows[x.rowIndex].cells[0].innerText);     
  }
  function viewDetail(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string')
              return el.textContent;
          if (typeof el.innerText === 'string')
              return el.innerText;
      }
      getDetailTransaksi(getText(document.getElementById('tblTransaksiHariIni').rows[x.rowIndex].cells[0]))      
  }
</script>


<!--<script> 
$('#datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });
</script>-->