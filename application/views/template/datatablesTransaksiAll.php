<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead>
  <tr>
    <th><center>ID Transaksi</center></th>
    <th><center>Kategori</center></th>
    <th><center>Filler</center></th>
    <th><center>PD</center></th>
    <th><center>ED</center></th>
    <th><center>Kolom</center></th>
    <th><center>Umur</center></th>
    <th><center>BN</center></th>
  </tr>
</thead>
<tbody>
  <?php foreach ($arrayTransaksiData as $key => $detail): ?>
    <tr onclick="viewDetail(this)"> 
      <div>  
      <td><center><?php echo $detail->Id_Transaksi; ?></center></td>          
      <td><center><?php echo $detail->Kategori; ?></center></td>
      <td><center><?php echo $detail->Kode_Filler; ?></center></td>
      <td><center><?php echo $detail->Tanggal_Produksi; ?></center></td>
      <td><center><?php echo $detail->Tanggal_Expired; ?></center></td>
      <td><center><?php echo $detail->Kolom; ?></center></td>
      <td><center><?php echo $detail->Umur." bulan"; ?></center></td>
      <td><center><?php echo $detail->BN; ?></center></td>
      <div>
    </tr>
<?php endforeach ?>
</tbody>