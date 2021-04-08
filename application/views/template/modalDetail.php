<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <h4 class="modal-title"><?php echo $_GET['titleModal'];?></h4>
	</div>
	<div class="modal-body">
	  <p><?php echo $_GET['bodyModal'];?></p>
	  <div class="table-responsive">
	  	<table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="text-align: center">ID Transaksi</th>
                    <th style="text-align: center">ID Produk</th>
                    <th style="text-align: center">ID Formula</th>
                    <th style="text-align: center">Batch No</th>
                    <th style="text-align: center">Batch Detail</th>
                </tr>
            </thead>
            <tbody>
            	<?php foreach ($detailTransksi as $key => $detail): ?>
            	<tr>
                    <td><center><?php echo $detail->ID_Transaksi;?></center></td>
                    <td><center><?php echo $detail->ID_Produk;?></center></td>
                    <td><center><?php echo $detail->ID_Formula;?></center></td>
                    <td><center><?php echo $detail->BatchWTPNo;?></center></td>
                    <td><center><?php echo $detail->BatchWTPNoDetail;?></center></td>
                </tr>
            	<?php endforeach ?>
            </tbody>
        </table>
	  </div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button type="button" class="btn btn-primary">Ok</button>
	</div>
  </div><!-- /.modal-content -->
</div>