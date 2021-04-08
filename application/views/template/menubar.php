<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>Home">PSG Sample Locator</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">   
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo base_url();?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
          <span class="hidden-xs"><?php $rrr=$this->session->userdata('dataUser');  echo $rrr['Username'];?></span>
        </a>
        <ul class="dropdown-menu">
          <li class="user-header">
            <img src="<?php echo base_url();?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            <p>
              PSG Sample Locator
            </p>
          </li>
          <li class="user-body">
            <div class="row">
              <div class="col-xs-12 text-center">
                <a id="linkChangePassword" href="#">Change Password</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <li class="user-footer">
            <div class="pull-left">
              <a href="<?php echo base_url(); ?>Home" id="btnToHome" class="btn btn-default btn-flat">Home</a>
            </div>
            <div class="pull-right">
              <a href="<?php echo base_url(); ?>Home/signout?nik=<?php echo $rrr['Nik']; ?>" id="btnLogOut" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
      <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>     
      </ul>
    </div>
  </div>
</nav>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
  $('#linkChangePassword').on('click', function() 
  {
    $.ajax({
          url: "<?php echo base_url();?>Master_User/getModalChangePassword",
          method:"POST",
          data:{idUser:<?php echo $userid;?>},
          success: function (response) 
          {            
            $('#myModalChangePassword').html(response);
            $('#myModalChangePassword').modal('show');
          },
          dataType: "html"
    });
  });
</script>