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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        <h3 class="box-title"><i class="fa fa-cubes" style="color:#00c0ef"></i> Tabel Transaksi</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <a href="#" class="btn btn-app" data-toggle="modal" data-target="#addModal" data-backdrop="static">
        <i class="fa fa-plus"></i> Add
      </a>
      <div class="box-body" style="overflow: auto">  
        <table id="tblTransaksi" class="table table-bordered table-hover" style="overflow: auto">
          <thead>
            <tr>
              <th><center>Kode Transaksi</center></th>
              <th><center>Tanggal</center></th>
              <th><center>Customer</center></th>
              <th><center>Tipe</center></th>
              <th><center>Total Diskon</center></th>
              <th><center>Total Bayar</center></th>
            </tr>
          </thead>

          <tbody>
            <?php if (count($dataTransaksi)>0): ?>
              <?php foreach ($dataTransaksi as $val): ?>
              <tr onclick="viewDetail(this)">   
                <td><center><?= $val->Code ?></center></td>          
                <td><center><?= $val->Tanggal ?></center></td>
                <td><center><?= $val->Customer?></center></td>
                <td><center><?= $val->Tipe ?></center></td>
                <td><center><?= $val->TotalDiskon ?></center></td>
                <td><center><?= $val->TotalBayar ?></center></td> 
              </tr>
            <?php endforeach ?>
            <?php else: ?>
              <tr >   
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
            <?php endif ?>
            
              
          </tbody>
        </table>
      </div> 
      </div>
      <div class="box box-info"> 
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cubes" style="color:#00c0ef"></i> Tabel Detail Transaksi</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body" style="overflow: auto">  
          <table id="tblDetailTransaksi" class="table table-bordered table-hover" style="overflow: auto">
            <thead>
              <tr>
                <th><center>Kode Transaksi</center></th>
                <th><center>Tanggal</center></th>
                <th><center>Customer</center></th>
                <th><center>Tipe</center></th>
                <th><center>Total Diskon</center></th>
                <th><center>Total Bayar</center></th>
              </tr>
            </thead>

            <tbody>
              <?php if (count($dataTransaksi)>0): ?>
                <?php foreach ($dataTransaksi as $val): ?>
                <tr>   
                  <td><center><?= $val->Code ?></center></td>          
                  <td><center><?= $val->Tanggal ?></center></td>
                  <td><center><?= $val->Customer?></center></td>
                  <td><center><?= $val->Tipe ?></center></td>
                  <td><center><?= $val->TotalDiskon ?></center></td>
                  <td><center><?= $val->TotalBayar ?></center></td> 
                </tr>
              <?php endforeach ?>
              <?php else: ?>
                <tr >   
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
              <?php endif ?>
              
                
            </tbody>
          </table>
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Transaksi</h4>
  </div>
  <div class="modal-body">
    <p></p>
    <div class="table-responsive">
      <table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><center>Tanggal</center></th>
                <th><center>Customer</center></th>
                <th><center>Tipe</center></th>
              </tr>
            </thead>
            <tbody>
              <tr >
                <td><input id="kode" type="hidden" name="kode" class="form-control"><input id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal"></td>
                <td>
                  <select id="customer" name="customer" class="custom-select custom-select-lg form-control mb-3">
                    <?php if (count($dataCustomer)>0): ?>
                      <?php foreach ($dataCustomer as $val): ?>
                        <option value=<?= $val->Id ?>><?= $val->Nama ?></option>
                      <?php endforeach ?>
                    <?php endif ?>
                  </select>
                </td>
                <td><select style="width: 150px" id="tipe" name="tipe" class="custom-select custom-select-lg form-control mb-3">
                      <option selected value="Cash">Cash</option>
                      <option value="Credit">Credit</option>
                  </select></td>
              </tr>
            </tbody>
      </table>
      <button id="btnSave" onclick="saveTransaksi()" class="btn btn-primary .float-lg-right">Save</button>
    </div>
  </div>
  </div><!-- /.modal-content -->
  </div>
</div>
<div class="modal fade" id="addDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Detail Transaksi</h4>
  </div>
  <div class="modal-body">
    <p></p>
    <div class="table-responsive">
      <input id="idtransaksi" type="hidden" class="form-control">
      <input id="idcustomer" type="hidden" class="form-control">
      <div class="form-group">
        <label>Total Diskon</label>
        <input id="totalDiskon" type="text" class="form-control" placeholder="..." disabled="">
      </div>      
      <table id="tblDetailtransaksix" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th><center>Nama Item</center></th>
            <th><center>Harga Satuan</center></th>
            <th><center>Qty</center></th>
          </tr>
        </thead>
        <tbody style="overflow-x: 'scroll'">
          <tr>
            <td>
              <select id="iditem" name="iditem" class="custom-select custom-select-lg form-control mb-3">
                <?php if (count($dataItem)>0): ?>
                  <?php foreach ($dataItem as $val): ?>
                    <option value=<?= $val->Id ?>><?= $val->Nama ?></option>
                  <?php endforeach ?>
                <?php endif ?>
              </select>
            </td>
            <td><input id="qty" type="number" name="qty" class="form-control" placeholder="Qty">
            </td>
          </tr>
        </tbody>
      </table>
      <button id="btnSave" onclick="saveDetailTransaksi()" class="btn btn-primary .float-sm-right">Save</button>
      <button onclick="addRowDetail(this)" class="btn btn-primary .float-sm-right">Add Row</button>
    </div>
  </div>
  </div><!-- /.modal-content -->
  </div>
</div>
<?php $this->load->view('template/scripthome');?>
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  
  function saveDetailTransaksi(){
    var idTrans=$('#addDetailModal').find("#idtransaksi").val();
    var arrayDetail=[];
    $("#tblDetailtransaksix tbody > tr").map((idx,tr)=>{
      if($(tr).find("#qty").val()!=null && $(tr).find("#qty").val()!=0)
      {
        arrayDetail.push({IdTransaksi:$(tr).find("#iditem option:selected").val(),IdItem:$(tr).find("#iditem option:selected").val(),Qty:$(tr).find("#qty").val()});
      }
    })
    $.ajax({
        url: "sales/addDetailTransaksi",
        method:"POST",
        data : arrayDetail,
        success: function (response) 
        {
          console.log(response);
          // setInterval(()=>{location.reload();}, 100);
        }
    });
  }
  function saveTransaksi(){
    $("#btnSave").prop('disabled', true);
    if($("#addModal").find("#tanggal").val()==""||$("#addModal").find("#tipe option:selected").val()=="")
    {
      alert("Isi seluruh data yang diperlukan");$("#btnSave").prop('disabled', false);
    }
    else{
      $.ajax({
            url: "sales/addTransaksi",
            method:"POST",
            dataType:"json",
            data : {Tanggal:$("#addModal").find("#tanggal").val(),Customer:$("#addModal").find("#customer option:selected").val(),Tipe:$("#addModal").find("#tipe option:selected").val()},
            success: function (response) 
            {
              console.log(response);
              $("#btnSave").prop('disabled', false);
              $('#addModal').modal('hide');
              $('#addDetailModal').modal('show');
              $('#addDetailModal').find("#idtransaksi").val(response.Code);
              $('#addDetailModal').find("#diskon").val(response.Diskon);
              $('#addDetailModal').find("#idcustomer").val(response.Customer);
            },
            error:()=>{
              $("#btnSave").prop('disabled', false);alert("Error");
            }
      });
    }
  }
  function hitungDetail()
  {
    $("#tblDetailtransaksix tbody > tr").map((idx,tr)=>{
      if($(tr).find("#qty").val()!=null && $(tr).find("#qty").val()!=0)
      {
        arrayDetail.push({IdTransaksi:$(tr).find("#iditem option:selected").val(),IdItem:$(tr).find("#iditem option:selected").val(),Qty:$(tr).find("#qty").val()});
      }
    })
  }
  function addRowDetail(x){
    var lastTr=$(x).closest(".modal-body").find("table > tbody> tr:last").clone();
    lastTr.insertAfter($(x).closest(".modal-body").find("table > tbody> tr:last"));
  }
  function viewDetail(x) 
  {
    $.ajax({
        url: "customer/showDetailByID",
        method:"POST",
        dataType:"json",
        data : {id:$(x).closest('tr').find('td').eq(0).text()},
        success: function (response) 
        { 

        }
    });
  }
  $( "#tanggal" ).datepicker();
</script>
