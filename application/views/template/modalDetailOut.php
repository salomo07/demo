<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <h4 class="modal-title"><?php if(isset($titleModal)){echo $titleModal;}?></h4>
	</div>
	<div class="modal-body">
    <form action="action_page.php">
  	  <p>Silahkan tambahkan alasan pengeluaran sampel...</p>
  	  <div class="table-responsive">
  	  	<table id="tblDetailTransaksi" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th style="text-align: center">ID Detail</th>
                      <th style="text-align: center">ID Transaksi</th>
                      <th style="text-align: center">ID Produk</th>
                      <th style="text-align: center">ID Formula</th>
                      <th style="text-align: center">Jam Sampling</th>
                      <th style="text-align: center">Qty</th>
                  </tr>
              </thead>
              <tbody>
              <?php foreach ($detailTransksi as $key => $value): ?>
                  <tr>
                      <td><center><?php echo $value['ID'];?></center></td>
                      <td><center><?php echo $value['IDTrans'];?></center></td>
                      <td><center><?php echo $value['IDProduk'];?></center></td>
                      <td><center><?php echo $value['IDFormula'];?></center></td>
                      <td><center><input size="5" id="jamSampling" placeholder="(HH:MM)" value="<?php echo $value['JamSampling'];?>"></center></td>
                      <td><center><input size="5" id="qtySampling" value="1"></center></td>
                  </tr>
              <?php endforeach ?>
              </tbody>
          </table>
  	  </div><br>
      <div style="float:right">
        <label>
          <input id="chkHabis" type="checkbox" value="habis">Sampel ini telah habis
        </label>
      </div>
      <br><br>
      <div>
        <textarea id="txtRemark" class="form-control" rows="3" placeholder="Alasan pengeluaran sampel" required></textarea>
        <label><center>Silahkan tuliskan kata 'Lab' jika sampel dikeluarkan untuk keperluan lab.</center></label>
      </div>
    </form>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
	  <button id="btnYesOut" href="<?php echo base_url()?>Storage/outDetailTransaksi" style="color: rgb(255, 255, 255); background-color: orange;" type="button" class="btn btn-primary">Keluarkan</button>
	</div>
  </div><!-- /.modal-content -->
</div>
<script>
$('#btnYesOut').on('click', function() 
{
    var chk=[];
    var objDetailTransksi;
    var chkHabis=false;
    if($('#chkHabis').is(":checked")==true){chkHabis=true; alert('Checked');}
    $('#tblDetailTransaksi tbody tr').each(function() {
        $(this).find('input:checkbox:checked').each(function() 
        {
          var ID=$(this).closest('tr').find('td').eq(0).text();
          var IDTrans=$(this).closest('tr').find('td').eq(1).text();
          var IDProduct=$(this).closest('tr').find('td').eq(2).text();
          var IDFormula=$(this).closest('tr').find('td').eq(3).text();
          var JamSampling=$(this).closest('tr').find('td').eq(4).find('#jamSampling').val();
          var QtySampling=$(this).closest('tr').find('td').eq(5).find('#qtySampling').val();
          objDetailTransksi={"ID":ID,'IDTrans':IDTrans,'IDProduct':IDProduct,'IDFormula':IDFormula,'JamSampling':JamSampling,'QtySampling':QtySampling,'Habis':chkHabis}
          console.log(chkHabis);
          chk.push(objDetailTransksi);//console.log(objDetailTransksi);
        });        
    });
    if($('#txtRemark').val()==''){alert('Silahkan lengkapi alasan pengeluaran sampel.');}
    else
    {
        $.ajax({ //Simpan Histori Keluar
            url: "<?php echo base_url();?>Storage/saveHistoriKeluar",
            method:"POST",
            data : {chk:chk,txtRemark:$('#txtRemark').val(),'tglAntar':$('#txtTanggalKadaluarsa').val(),'chkHabis':chkHabis},
            success: function (response) 
            {
              console.log(response);
                $('#myModal').modal('hide');
                alert('Sambil telah dikeluarkan dengan alasan : '+$('#txtRemark').val());
                $('#tblDetailTransaksi').html('');
                $('#btnOutSample').css('visibility', 'hidden');
            },
            dataType: "text"
        });
    }
});
  function chkChange(ele)
  {
  }
</script>