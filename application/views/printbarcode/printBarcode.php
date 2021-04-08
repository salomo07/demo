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
      <div class="col-md-7">
        <div class="box box-info"> 
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cubes" style="color:#00c0ef"></i> Tabel Transaksi Sampel</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body" style="overflow-y: scroll; height: 780px;">  
          <center id="sedangMemuat1" >Sedang memuat ...</center>
            <div>
              <table id="tblTransaksiAll" class="table table-bordered table-hover">
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
            <input id="btnPrintTransaksi" style="visibility: hidden; background-color: #00c0ef;color: #fff;" type="submit" class="btn btn-block" value="Print Transaksi">
          </div> 
        </div>

      </div>
      <div class="col-md-5">
        <div class="box box-info"> 
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cube" style="color:#00c0ef"></i> Detail Transaksi</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">  
            <div class="table-responsive">
              <table id="tblDetailTransaksi" class="table table-bordered table-hover" >              
              </table>
            </div>
          </div> 
        </div>
      </div>
    </section>
    <div id="demo"></div>
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
  var idTrans='';
  var table;
  $(".select2").select2();
  $('#myModal').draggable();
  getTransaksiAll();
  function getTransaksiAll()
  {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Monitor_Storage/getTransaksiAll?checkbox=yes",
        dataType : "text",
        success : function(msg) {
            $('#tblTransaksiAll').html(msg);
            table=$('#tblTransaksiAll').DataTable();
            table.destroy();
            $('#tblTransaksiAll').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": false,
              "bSortable": false, 
              "scrollCollapse": true,  
              "bInfo" : false,
              "lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]] 
            });            
            $('#btnPrintTransaksi').css('visibility', 'visible');$('#sedangMemuat1').html('');
        }
    });
  }
  function viewDetail(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string')
              return el.textContent;
          if (typeof el.innerText === 'string')
              return el.innerText;
      }
      getDetailTransaksi(getText(document.getElementById('tblTransaksiAll').rows[x.rowIndex].cells[0]));     
  }
  function getDetailTransaksi(id) 
  {
    idTrans=id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Storage/getDetailTransaksi?titleModal=Detail Transaksi&&bodyModal=",
        data: {idTrans : idTrans}, 
        dataType : "text",
        success : function(msg) {
            $('#tblDetailTransaksi').html(msg);            
            $('#btnPrintTransaksi').css('visibility', 'visible');
        }
    });
  }
  function check(ele) 
  {
      var checkboxes = document.getElementsByTagName('input');
      if (ele.checked) {
          for (var i = 0; i < checkboxes.length; i++) {
              if (checkboxes[i].type == 'checkbox') {
                  checkboxes[i].checked = true;
              }
          }
      } else {
          for (var i = 0; i < checkboxes.length; i++) {
              console.log(i)
              if (checkboxes[i].type == 'checkbox') {
                  checkboxes[i].checked = false;
              }
          }
      }
  }
  $('#btnPrintTransaksi').on('click', function() 
  {
    var arrayOfObject=[];
    $('#tblTransaksiAll tbody tr').each(function() {
        $(this).find('input:checkbox:checked').each(function() {
          var ID=$(this).closest('tr').find('td').eq(0).text();
          var Kategori=$(this).closest('tr').find('td').eq(1).text();
          var Filler=$(this).closest('tr').find('td').eq(2).text();
          var PD=$(this).closest('tr').find('td').eq(3).text();
          var Kolom=$(this).closest('tr').find('td').eq(4).text();
          var Umur=$(this).closest('tr').find('td').eq(5).text();
          var BN=$(this).closest('tr').find('td').eq(6).text();
          var objTransksi={"ID":ID,"Kategori":Kategori,"Filler":Filler,"PD":PD,"Kolom":Kolom,"Umur":Umur,"BN":BN}
          arrayOfObject.push(objTransksi);
        });
    });
    if(arrayOfObject.length>0)
    {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Print_Barcode/result",
        data: {chk:arrayOfObject}, 
        dataType : "text",
        success : function(msg) {
            window.location.href = "<?php echo base_url()?>"+"Print_Barcode/printBarcode";   
        }
      });
    }else{alert('Silahkan pilih transaksi yang ingin di cetak.');}
  });
</script>