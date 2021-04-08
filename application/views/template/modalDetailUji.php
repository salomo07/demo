<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <h4 class="modal-title">Konfirmasi Detail Pengujian Sampel</h4>
	</div>
	<div class="modal-body">
    <form action="action_page.php">
    <input id="txtIDTransaksi" type="hidden" value="<?php echo $IDTrans; ?>">
    <input id="txtUmurTransaksi" type="hidden" value="<?php echo $umur; ?>">
    ID Transaksi : <?php echo $IDTrans; ?><br>
    Filler       : <?php echo $filler; ?><br>
    PD           : <?php echo $pd; ?><br>
    Kolom : <?php echo $kolom; ?><br>
    Umur : <?php echo $umur.' Bulan'; ?><br>
    BN : <?php echo $bn; ?><br><br>
    <center><label>Detail Transaksi Uji</label></center><br>
	  <div class="table-responsive">
	  	<table id="tblDetailTransaksi" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="text-align: center">ID Detail</th>
                    <th style="text-align: center">ID Transaksi</th>
                    <th style="text-align: center">ID Produk</th>
                    <th style="text-align: center">ID Formula</th>
                    <th style="text-align: center">Batch No</th>
                    <th style="text-align: center">Batch Detail</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($detailTransksi as $key => $value): ?>
                <tr>
                    <td><center><?php echo $value->Id_Detail_Transaksi;?></center></td>
                    <td><center><?php echo $value->ID_Transaksi;?></center></td>
                    <td><center><?php echo $value->ID_Produk;?></center></td>
                    <td><center><?php echo $value->ID_Formula;?></center></td>
                    <td><center><?php echo $value->BatchWTPNo;?></center></td>
                    <td><center><?php echo $value->BatchWTPNoDetail;?></center></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
	  </div>
    </form>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
	  <button id="btnUjiTransaksi" href="<?php echo base_url()?>Storage/sendTransaksiUji" style="color: rgb(255, 255, 255); border-color: rgb(46, 109, 164); background-color: green;" type="button" class="btn btn-primary">Uji Sampel</button>
	</div>
  </div><!-- /.modal-content -->
</div>
<script>
$('#btnUjiTransaksi').on('click', function() 
{
    $.ajax({ //Simpan Histori Uji
            url: "<?php echo base_url();?>Storage/sendTransaksiUji",
            method:"POST",
            data : {'idTrans':$('#txtIDTransaksi').val(),'umur':$('#txtUmurTransaksi').val()},
            success: function (response) 
            {
                $('#myModal').modal('hide');
                alert('Histori pengujian telah tersimpan.');
            },
            dataType: "text"
        });
});
</script>