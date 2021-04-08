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
          <h3 class="box-title"><i class="fa fa-cubes" style="color:#00c0ef"></i> Tabel Customer</h3>
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
                <th><center>Nama</center></th>
                <th><center>Kontak</center></th>
                <th><center>Email</center></th>
                <th><center>Alamat</center></th>
                <th><center>Diskon</center></th>
                <th><center>Tipe Diskon</center></th>
                <th><center>Image</center></th>
                <th><center>PIC</center></th>
                <th><center>Add/Edit</center></th>
              </tr>
            </thead>

            <tbody>
              <?php if (count($dataCustomer)>0): ?>
                <?php foreach ($dataCustomer as $val): ?>
                <tr>   
                  <td><center><?= $val->Id ?></center></td>          
                  <td><center><?= $val->Nama ?></center></td>
                  <td><center><?= $val->Kontak?></center></td>
                  <td><center><?= $val->Email ?></center></td>
                  <td><center><?= $val->Alamat ?></center></td>
                  <td><center><?= $val->Diskon ?></center></td>
                  <td><center><?= ($val->Tipediskon==1)? "Percent" :"Fixed" ?></center></td>
                  <td><center><?= ($val->Image!="") ? '<img src="'.$val->Image.'" alt="$val->Nama" border=3 height=100 width=300></img>' : "---" ?></center></td>
                  <td>
                  <?php foreach (json_decode($val->PIC) as $user): ?>
                    <?php foreach ($dataPIC as $pic): ?>
                      <?= ($pic->Id==(int)$user) ? $pic->Username."<br>":""  ?>
                    <?php endforeach ?>
                  <?php endforeach ?></td>
                  <td><button type='button' onclick='itemEdit(this);' class='btn btn-default fa fa-edit btn-lg btn-block'></button>
                    <button type='button' onclick='itemDelete(this);' class='btn btn-default fa fa-trash btn-lg btn-block'></button></td>
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
    <h4 class="modal-title">Add Customer</h4>
  </div>
  <div class="modal-body">
    <p></p>
    <div class="table-responsive">
      <?php echo form_open_multipart('customer/add');?>
      <table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th><center>Nama</center></th>
                <th><center>Kontak</center></th>
                <th><center>Email</center></th>
                <th><center>Alamat</center></th>
                <th><center>Diskon</center></th>
                <th><center>Tipe Diskon</center></th>
                <th><center>PIC</center></th>
                <th><center>Image</center></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input style="width: 200px" id="nama" name="nama" class="form-control" placeholder="Nama"></td>
                <td><input id="kontak" name="kontak" class="form-control" placeholder="Kontak"></td>
                <td><input id="email" type="email" name="email" class="form-control" placeholder="Email"></td>
                <td><input id="alamat" name="alamat" class="form-control" placeholder="Alamat"></td>
                <td><input id="diskon" type="number" name="diskon" class="form-control" placeholder="Diskon"></td>
                <td>
                  <select style="width: 100px" id="tipediskon" name="tipediskon" class="custom-select custom-select-lg form-control mb-3">
                      <option selected value=1>Percent</option>
                      <option value=2>Fixed</option>
                  </select></td>
                <td>
                  <select style="width: 150px" class="js-example-basic-multiple" id="pic" name="pic[]" multiple="multiple">
                    <?php if (count($dataPIC)>0): ?>
                      <?php foreach ($dataPIC as $val): ?>
                        <option value="<?= $val->Id ?>"><?= $val->Username ?></option>
                      <?php endforeach ?>
                    <?php else: ?>
                      
                    <?php endif ?>
                    
                  </select>
                </td>
                <td>
                  <input type="file" class="custom-file-input" name="imageItem">
                </td>
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
      <?php echo form_open_multipart('customer/edit');?>
      <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><center>Nama</center></th>
                <th><center>Kontak</center></th>
                <th><center>Email</center></th>
                <th><center>Alamat</center></th>
                <th><center>Diskon</center></th>
                <th><center>Tipe Diskon</center></th>
                <th><center>PIC</center></th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td><input id="id" name="id" class="form-control" type="hidden"><input style="width: 200px" id="nama" name="nama" class="form-control" placeholder="Nama"></td>
                <td><input id="kontak" name="kontak" class="form-control" placeholder="Kontak"></td>
                <td><input style="width: 150px" id="email" type="email" name="email" class="form-control" placeholder="Email"></td>
                <td><input style="width: 150px" id="alamat" name="alamat" class="form-control" placeholder="Alamat"></td>
                <td><input style="width: 70px" id="diskon" type="number" name="diskon" class="form-control" placeholder="Diskon"></td>
                <td>
                  <select style="width: 100px" id="tipediskon" name="tipediskon" class="custom-select custom-select-lg form-control mb-3">
                      <option selected value=1>Percent</option>
                      <option value=2>Fixed</option>
                  </select></td>
                <td>
                  <select style="width: 150px" class="js-example-basic-multiple" id="pic" name=pic[] multiple="multiple">
                    <?php if (count($dataPIC)>0): ?>
                      <?php foreach ($dataPIC as $val): ?>
                        <option value="<?= $val->Id ?>"><?= $val->Username ?></option>
                      <?php endforeach ?>
                    <?php else: ?>
                      
                    <?php endif ?>
                    
                  </select>
                </td>
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
  $('#pic').select2();
  $('#editModal').find("#pic").select2();
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
  function itemEdit(x)
  {
      $.ajax({
          url: "customer/showDetailByID",
          method:"POST",
          dataType:"json",
          data : {id:$(x).closest('tr').find('td').eq(0).text()},
          success: function (response) 
          {            
            $('#editModal').modal('show');
            $('#editModal').find("#id").val(response.Id);
            $('#editModal').find("#nama").val(response.Nama);
            $('#editModal').find("#kontak").val(response.Kontak);
            $('#editModal').find("#email").val(response.Email);
            $('#editModal').find("#alamat").val(response.Alamat);
            $('#editModal').find("#diskon").val(response.Diskon);
            $('#editModal').find("#tipediskon").val(response.Tipediskon);  
            $('#editModal').find("#pic").val(JSON.parse(response.PIC)).change();
          }
      });  
  }
  function itemDelete(x)
  {
      $.ajax({
          url: "customer/delete",
          method:"POST",
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