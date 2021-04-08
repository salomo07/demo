<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <h4 class="modal-title"><?php echo $titleModal;?></h4>
	</div>
	<div class="modal-body">
	  <p><?php echo $bodyModal;?></p>
      <div class="row">
        <div class="col-md-12">
          <label >Fullname</label><input type="text" class="form-control" value="<?php echo $username ?>" disabled="">
          <br>
          <label >Old Password</label><input id="txtOldPass2" type="password" class="form-control"">
          <br>
          <label >New Password</label><input id="txtNewPass" type="password" class="form-control"">
          <br>
          <label >Reentry Password</label><input id="txtNewPass2" type="password" class="form-control"">
        </div>
      </div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button id="btnChangePassword" type="button" class="btn btn-primary">Save</button>
	</div>
  </div><!-- /.modal-content -->
</div>
<script>
  $('#btnChangePassword').on('click', function(e) 
  {
    if($('#txtNewPass').val()!=$('#txtNewPass2').val())
    {
      alert('Password baru yang anda masukkan belum sama.');
    }
    else
    {
      $.ajax({
          url: "<?php echo base_url();?>Master_User/cekPasswordLamaValid",
          method:"POST",
          data:{idUser:<?php echo $userid;?>,passLama:$('#txtOldPass2').val()},
          success: function (response) 
          {
            console.log(response);
            if(response=='Tidak valid')
            {
              alert('Password lama tidak valid.');
            }
            else
            {
              $.ajax({
                  url: "<?php echo base_url();?>Master_User/updatePasswordUser",
                  method:"POST",
                  data:{idUser:<?php echo $userid;?>,passBaru:$('#txtNewPass').val()},
                  success: function (response) 
                  {
                    alert('Password telah berhasil diubah.'); $('#myModalChangePassword').modal('hide');
                  },
                  dataType: "html"
              });
            }
          }
      });
    }
  });
</script>