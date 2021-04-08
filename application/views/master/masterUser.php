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
      <div class="col-md-12">
        <div class="box" style="border-top-color: red;"> 
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user" style="color:red"></i> Master User</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body">  
            <div class="table-responsive col-md-6">
            <center><label>Tabel User</label></center><br>
              <table id="tblUser" class="table table-bordered table-hover">
                <thead>
                  <tr>
                      <th style="text-align: center">NIK</th>
                      <th style="text-align: center">Username</th>
                      <th style="text-align: center">Role</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>   
                        <td><center></center></td>               
                        <td><center></center></td>
                        <td><center></center></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
              <center><label>Data User</label></center><br>
                <div class="form-group">
                  <label>NIK User</label>
                  <input name="txtNIK" id="txtNIK" class="form-control" style="width: 100%;" placeholder="NIK User" disabled>
                </div>
                <div class="form-group">
                  <label>Fullname</label>
                  <input name="txtFullname" id="txtFullname" class="form-control" style="width: 100%;" placeholder="Fullname" disabled>
                </div>
                <div class="form-group">
                  <label>Role</label>
                  <input name="txtRole" id="txtRole" class="form-control" style="width: 100%;" placeholder="Role" disabled>
                </div>
                <br>
                <div class="col-md-3"><input id="btnNew" type="submit" class="btn btn-block" value="Add"></div>
                <?php $dataUser=$this->session->userdata('dataUser'); $role=$dataUser['Role']; if($role!=3) {echo '<div class="col-md-3"><input id="btnEdit" type="submit" class="btn btn-block" value="Edit"></div>';} ?> 
                <?php $dataUser=$this->session->userdata('dataUser'); $role=$dataUser['Role']; if($role!=3) {echo '<div class="col-md-3"><input id="btnDelete" type="submit" class="btn btn-block" value="Delete"></div>';} ?>
                <div class="col-md-3"><input id="btnCancel" type="submit" class="btn btn-block" value="Cancel"></div>
              </div>
            </div>
            <div id="divTransaksi" class="col-md-12">
            </div>
          </div> 
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
<?php $this->load->view('template/scripthome');?>
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  var perintah='';
  $(".select2").select2();
  $.ajax({
      url: "<?php echo base_url();?>Master_User/getUser",
      success: function (response) 
      {
        var table=$('#tblUser').DataTable();
        table.destroy();
        $("#tblUser").html(response); 
        $('#tblUser').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "lengthMenu": [[6, 12, 18, -1], [6, 12, 18, "All"]]
        });           
      }
  });
  function getKodeKolom(x)
  {
      $('#txtNIK').val(document.getElementById('tblUser').rows[x.rowIndex].cells[0].innerText); 
      $('#txtKodeKolomOld').val(document.getElementById('tblUser').rows[x.rowIndex].cells[0].innerText);   
      $('#txtFullname').val(document.getElementById('tblUser').rows[x.rowIndex].cells[1].innerText); 
      $('#txtRole').val(document.getElementById('tblUser').rows[x.rowIndex].cells[2].innerText); 
      if($('#txtNIK').val()!=''&&perintah=='Delete')
      {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>Master_User/deleteUser",
          data : {nik:$('#txtNIK').val()},
            success: function (response) 
            {
              console.log(response);
              if(response=='User telah terdelete.')
              {window.location.href = "<?php echo site_url('Master_User') ?>";}
            }
          });
      }
  }
  $('#btnNew').on('click', function() 
  {
    if($('#btnNew').val()=='Add')
    {
      $('#txtNIK').prop("disabled", false);$('#txtFullname').prop("disabled", false);$('#btnNew').val('Save');$('#btnEdit').val('Edit')
      ;$('#txtRole').prop("disabled", false);
    }
    else
    {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>Master_User/insertUser",
        async: false,
        data : {nik:$('#txtNIK').val(),full:$('#txtFullname').val(),role:$('#txtRole').val()},
          success: function (response) 
          {
            console.log(response);
            if(response=='Nik sudah digunakan.')
            {
              alert('User dengan NIK ini telah tersimpan sebelumnya.');
            }
            else
            {
              window.location.href = "<?php echo site_url('Master_User') ?>";
            }            
          }
      });
    }
  });
  $('#btnEdit').on('click', function() 
  {
    if($('#btnEdit').val()=='Edit')
    {
      perintah='Edit';$('#txtKodeKolom').prop("disabled", false);$('#txtFullname').prop("disabled", false);$('#btnEdit').val('Save');$('#btnNew').val('New');$('#txtRole').prop("disabled", false);
    }
    else
    {
      if($('#txtNIK').val()!='')
      {
        $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>Master_User/editUser",
        async: false,
        data : {nik:$('#txtNIK').val(),full:$('#txtFullname').val(),role:$('#txtRole').val()},
          success: function (response) 
          {
            if(response=='User telah terupdate.')
            {window.location.href = "<?php echo site_url('Master_User') ?>";}
          }
        });
      }
    }
  });
  $('#btnDelete').on('click', function() 
  {
    perintah='Delete'; alert('Silahkan pilih user yang akan dihapus.');
  });
  $('#btnCancel').on('click', function() 
  {
    $('#btnNew').val('Add');$('#btnEdit').val('Edit');$('#txtNIK').prop("disabled", true);$('#txtFullname').prop("disabled", true);perintah='';
  });
  
</script>


<!--<script> 
$('#datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });
</script>-->