<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead>
    <tr>        
        <th style="text-align: center">ID Produk</th>
        <th style="text-align: center">ID Formula</th>
        <th style="text-align: center">Waktu</th>
        <th style="text-align: center">Umur</th>
        <th style="text-align: center">Operator</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($detailTransksi as $key => $detail): ?>
    <tr>        
        <td><center><?php echo $detail->ID_Produk;?></center></td>
        <td><center><?php echo $detail->ID_Formula;?></center></td>
        <td><center><?php echo $detail->Tanggal_Uji;?></center></td>
        <td><center><?php echo $detail->Umur.' Bulan';?></center></td>
        <td><center><?php echo $detail->Operator;?></center></td>
    </tr>
    <?php endforeach ?>
</tbody>