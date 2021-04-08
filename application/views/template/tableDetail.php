<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead>
    <tr>
        <th style="text-align: center">ID Detail</th>
        <th style="text-align: center">ID Transaksi</th>
        <th style="text-align: center">ID Produk</th>
        <th style="text-align: center">ID Formula</th>
        <th style="text-align: center">Batch No</th>
        <th style="text-align: center">Batch Detail</th>
        <th><center>Keterangan</center></th>
    </tr>
</thead>
<tbody>
    <?php foreach ($detailTransksi as $key => $detail): ?>
    <tr>
        <td><center><?php echo $detail->Id_Detail_Transaksi;?></center></td>
        <td><center><?php echo $detail->ID_Transaksi;?></center></td>
        <td><center><?php echo $detail->ID_Produk;?></center></td>
        <td><center><?php echo $detail->ID_Formula;?></center></td>
        <td><center><?php echo $detail->BatchWTPNo;?></center></td>
        <td><center><?php echo $detail->BatchWTPNoDetail;?></center></td>
        <td><center><?php echo $detail->Keterangan; ?></center></td>
    </tr>
    <?php endforeach ?>
</tbody>