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
          <h3 class="box-title"><i class="fa fa-cubes" style="color:#00c0ef"></i> Tabel Item</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <a href="#" class="btn btn-app" data-toggle="modal" data-target="#addModal" data-backdrop="static">
          <i class="fa fa-plus"></i> Add
        </a>
        <div class="box-body" style="overflow: auto">  
          <table id="tblTransaksiHariIni" class="table table-bordered table-hover" style="overflow: auto">
            <thead>
              <tr>
                <th><center>Id</center></th>
                <th><center>Nama Item</center></th>
                <th><center>Unit</center></th>
                <th><center>Stok</center></th>
                <th><center>Harga Satuan</center></th>
                <th><center>Harga Grosir</center></th>
                <th><center>Image</center></th>
                <th><center>Edit/Delete</center></th>
              </tr>
            </thead>

            <tbody>
              <?php if (count($dataItem)>0): ?>
                <?php foreach ($dataItem as $val): ?>
                <tr>   
                  <td><center><?= $val->Id ?></center></td>          
                  <td><center><?= $val->Nama ?></center></td>
                  <td><center><?= ($val->Unit==1)? "Kg": "Pcs" ?></center></td>
                  <td><center><?= $val->Stok ?></center></td>
                  <td><center><?= $val->HargaSatuan ?></center></td>
                  <td><center><?= $val->HargaGrosir ?></center></td>
                  <td><center><?= ($val->Image!="") ? '<img src="'.$val->Image.'" alt="$val->Nama" border=3 height=100 width=300></img>' : "---" ?></center></td>
                  <td><button type='button' onclick='itemEdit(this);' class='btn btn-default fa fa-edit btn-lg btn-block'></button>
                    <button type='button' onclick='itemDelete(this);' class='btn btn-default fa fa-trash btn-lg btn-block'></button></td>
                </tr>
              <?php endforeach ?>
              <?php else: ?>
                <tr onclick="">   
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
    <h4 class="modal-title">Add / Edit Item</h4>
  </div>
  <div class="modal-body">
    <p></p>
    <div class="table-responsive">
      <?php echo form_open_multipart('item/add');?>
      <table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="text-align: center">Nama Item</th>
                    <th style="text-align: center">Unit</th>
                    <th style="text-align: center">Stok</th>
                    <th style="text-align: center">Harga Satuan</th>
                    <th style="text-align: center">Harga Grosir</th>
                    <th style="text-align: center">Image</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td><input id="nama" name="nama" class="form-control" placeholder="Nama Item"></td>
                <td style="width: 80px"><select name="unit" class="custom-select custom-select-lg form-control mb-3">
                      <option selected value=1>Kg</option>
                      <option value=2>Pcs</option>
                    </select></td>
                <td><input id="stok" type="number" name="stok" class="form-control" placeholder="Stok"></td>
                <td><input id="hargasatuan" type="number" name="hargasatuan" class="form-control" placeholder="Harga Satuan"></td>
                <td><input id="hargagrosir" type="number" name="hargagrosir" class="form-control" placeholder="Harga Grosir"></td>
                <td><input type="file" class="custom-file-input" name="imageItem"></td>
              </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary .float-lg-right">Save</button>
        
        </form>
    </div>
  </div>
  </div><!-- /.modal-content -->
  </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
  <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Edit Item</h4>
  </div>
  <div class="modal-body">
    <p></p>
    <div class="table-responsive">
      <?php echo form_open_multipart('item/edit');?>
      <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align: center">Nama Item</th>
                <th style="text-align: center">Unit</th>
                <th style="text-align: center">Stok</th>
                <th style="text-align: center">Harga Satuan</th>
                <th style="text-align: center">Harga Grosir</th>
                <!-- <th style="text-align: center">Image</th> -->
            </tr>
        </thead>
        <tbody>
          <tr>
            <td><input id="id" name="id" class="form-control" type="hidden"><input id="nama" name="nama" class="form-control" placeholder="Nama Item" disabled></td>
            <td style="width: 80px"><select id="unit" name="unit" class="custom-select custom-select-lg form-control mb-3">
                  <option value=1>Kg</option>
                  <option value=2>Pcs</option>
                </select></td>
            <td><input id="stok" type="number" name="stok" class="form-control" placeholder="Stok"></td>
            <td><input id="hargasatuan" type="number" name="hargasatuan" class="form-control" placeholder="Harga Satuan"></td>
            <td><input id="hargagrosir" type="number" name="hargagrosir" class="form-control" placeholder="Harga Grosir"></td>
            <!-- <td><img id="img" src="" border=3 height=100 width=300></img><input type="file" class="custom-file-input" name="imageItem" id="imageItem"></td> -->
          </tr>
        </tbody>
        </table>
        <button type="submit" class="btn btn-primary .float-lg-right">Save</button>
        
        </form>
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
  function itemEdit(x)
  {
      $.ajax({
          url: "item/showDetailByID",
          method:"POST",
          dataType:"json",
          data : {id:$(x).closest('tr').find('td').eq(0).text()},
          success: function (response) 
          {            
            $('#editModal').modal('show');
            $('#editModal').find("#id").val(response.Id);
            $('#editModal').find("#nama").val(response.Nama);
            $('#editModal').find("#unit").val(response.Unit);  
            $('#editModal').find("#stok").val(response.Stok);
            $('#editModal').find("#hargasatuan").val(response.HargaSatuan);
            $('#editModal').find("#hargagrosir").val(response.HargaGrosir);
            $('#editModal').find("input:file").val("");
            $('#editModal').find("#img").attr("src",response.Image);
          }
      });  
  }
  function itemDelete(x)
  {
      $.ajax({
          url: "item/delete",
          method:"POST",
          dataType:"text",
          data : {id:$(x).closest('tr').find('td').eq(0).text()},
          success: function (response) 
          {
            setInterval(()=>{location.reload();}, 100);
          }
      });  
  }
</script>


<!--<script> 
$('#datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });
</script>-->