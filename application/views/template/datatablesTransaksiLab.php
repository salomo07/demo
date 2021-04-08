<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead>
  <tr>
    <th><center>ID Transaksi</center></th>
    <th><center>ID Product</center></th>
    <th><center>Formula</center></th>
    <th><center>PD</center></th>
    <th><center>Filler</center></th>    
    <th><center>Jam Sampling</center></th>
    <th><center>Qty</center></th>
    <th><center>ED</center></th>
    <th><center>Umur</center></th>    
    <th><center>BN</center></th>
    <th><center>Pengirim</center></th>
    <th><center>Waktu</center></th>
    <th><center>Penerima</center></th>
    <th><center></center></th>
  </tr>
</thead>
<?php print_r($dataPenerimaan); ?>
<tbody>
  <?php foreach ($dataPenerimaan as $key => $detail): ?>

    <tr> 
      <div>  
      <td id="txtIDTransaksi"><center><?php  echo $detail->idtransaksi; ?><input type="hidden" id="txtIdPenerimaan" value="<?php echo $detail->idpenerimaan;?>"></center></td>          
      <td><center><?php echo $detail->idproduct; ?></center></td>
      <td><center><?php echo $detail->idformula; ?></center></td>
      <td><center><?php echo $detail->productiondate; ?></center></td>
      <td><center><input type="text" id="txtFiller" style="width: 30px;" value="<?php echo $detail->filler; ?>"></center></td>
      <td><center><input type="text" id="txtTime" style="width: 55px;" value="<?php echo $detail->productiontime; ?>" placeholder="HH:MM"></center></td>
      <td><center><input type="text" id="txtQty" style="width: 35px;" value="<?php echo $detail->qty; ?>" placeholder="Qty"></center></center></td>
      <td onclick="getModalEditED(this)"><center><?php echo $detail->expiredate; ?></center></td>
      <td><center><?php echo $detail->month.' bulan'; ?></center></td>
      
      <td><center><?php echo $detail->bn; ?></center></td>
      <td><center><?php echo $detail->pengirim; ?></center></td>
      <td><center><input type="text" id="txtWaktuPengiriman" style="width: 50px;" value="<?php echo $detail->waktupengiriman; ?>"></center></td>
      <td><center><?php echo $detail->penerima; ?></center></td>
      <td><center><input type="checkbox" class="chk[]" name="chk[]" value="<?php echo $detail->idtransaksi; ?>">
      <div>
    </tr>
<?php endforeach ?>
</tbody>