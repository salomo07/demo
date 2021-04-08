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
          <h3 class="box-title"><i class="fa fa-flask" style="color:violet"></i> Sampel Uji Hari Ini</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">  
          <div class="row">
            <div class="col-md-6" style="float:left">
              <div class="form-group">
                <center><label>Tanggal pengiriman sampel</label></center>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="dtPicker">
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="tblSampelDikirim" class="table table-bordered table-hover" style="overflow: auto">
                  <thead>
                    <tr>
                      <th><center>ID Transaksi</center></th>
                      <th><center>Filler</center></th>
                      <th><center>PD</center></th>
                      <th><center>ID Product</center></th>
                      <th><center>Umur</center></th>
                      <th><center>BN</center></th>
                      <th><center>Pengirim</center></th>
                      <th><center>Waktu Pengiriman</center></th>
                      <th><center>Penerima</center></th>
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
                        <td><center></center></td>
                        <td><center></center></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
        <?php $userData=$this->session->userdata('dataUser'); if ($userData['Role']==1||$userData['Role']): ?>
          <div class="col-md-6" style="float:right">
              <div class="col-md-6">
                <button id="btnHapusHistoriLab" type="submit" class="btn btn-block btn-primary" style="background-color:violet;">Hapus Histori</button>
              </div>
              <div class="col-md-6">
                <button id="btnEditHistoriLab" type="submit" class="btn btn-block btn-primary" style="background-color:violet;">Edit Histori</button>
              </div>
          </div>
        <?php endif ?>         
          
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
var arrayOfObject=[];
  $('#btnEditHistoriLab').on('click', function() 
  {  
    $('#tblSampelDikirim tbody tr').each(function() 
    {
      $(this).find('input:checkbox:checked').each(function() {
        var IDPenerimaan=$(this).closest('tr').find('#txtIdPenerimaan').val();
        var Filler=$(this).closest('tr').find('#txtFiller').val();
        var Time=$(this).closest('tr').find('#txtTime').val();
        var Qty=$(this).closest('tr').find('#txtQty').val();
        var WaktuPengiriman=$(this).closest('tr').find('#txtWaktuPengiriman').val();
        var objDetailTransksi={"IDPenerimaan":IDPenerimaan,"Filler":Filler,"Time":Time,"Qty":Qty,"waktupengiriman":WaktuPengiriman}
        arrayOfObject.push(objDetailTransksi);        
      });
    });
    if(arrayOfObject.length>0)
    {
      $.ajax({
            url: "<?php echo base_url();?>Monitor_Lab/updateDataPenerimaan",
            data: {'arrayOfObject' : arrayOfObject},
            method:"POST",
            success: function (response) 
            {
              console.log(response);
              alert('Data penerimaan telah berhasil diperbaharui.');
              getTransaksiHariIni($("#dtPicker").val());    
            }
        });
    }else{alert('Silahkan pilih sampel yang akan diperbaharui.');}
  });
  $('#btnHapusHistoriLab').on('click', function() 
  {  
    $('#tblSampelDikirim tbody tr').each(function() 
    {
      $(this).find('input:checkbox:checked').each(function() {
        var IDPenerimaan=$(this).closest('tr').find('#txtIdPenerimaan').val();
        arrayOfObject.push(IDPenerimaan);        
      });
    });

    if(arrayOfObject.length>0)
    {
      $.ajax({
            url: "<?php echo base_url();?>Monitor_Lab/hapusDataPenerimaan",
            data: {'arrayOfObject' : arrayOfObject},
            method:"POST",
            success: function (response) 
            {
              console.log(response);
              alert('Data penerimaan telah berhasil dihapus.');
              getTransaksiHariIni($("#dtPicker").val());    
            }
        });
    }else{alert('Silahkan pilih sampel yang akan dihapus.');}
  });
  function getModalEditED(xxx)
  {
    console.log($(xxx).closest('tr').find('#txtIDTransaksi').text())
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Monitor_Storage/getDetailTransaksi?titleModal=Detail Transaksi&&bodyModal=",
        data: {idTrans : idTrans}, 
        dataType : "text",
        success : function(msg) {
            $('#tblDetailTransaksi').html(msg);
            $('#btnEdit').css('visibility', 'visible');$('#btnEdit').val('Edit Transaksi');
            $('#btnDelete').css('visibility', 'visible'); $('#divCurrentTransaction').html('');
        }
    });
  }
  function getTransaksiHariIni(tgl) 
  {
    $.ajax({
          url: "<?php echo base_url();?>Monitor_Lab/getDataPenerimaanByTanggal",
          data: {'tgl' : tgl},
          method:"POST",
          success: function (response) 
          {
            console.log(response);
            var table=$('#tblSampelDikirim').DataTable();
            table.destroy();
            $("#tblSampelDikirim").html(response);    
            $('#tblSampelDikirim').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });       
          }
      });
  }
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  var output =(day<10 ? '0' : '') + day+'-'+(month<10 ? '0' : '') + month +'-'+d.getFullYear();
  $("#dtPicker").val(output);
  getTransaksiHariIni($("#dtPicker").val());
  $('#dtPicker').datepicker(
  {
      autoclose: true,format: 'dd-mm-yyyy'
  });
  $('#dtPicker').on('change', function() 
  {
    getTransaksiHariIni($("#dtPicker").val());
  });
</script>