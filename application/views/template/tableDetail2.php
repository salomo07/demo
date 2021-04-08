<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead>
    <tr>
        <th style="text-align: center">ID Detail</th>
        <th style="text-align: center">ID Transaksi</th>
        <th style="text-align: center">ID Produk</th>
        <th style="text-align: center">ID Formula</th>
        <th style="text-align: center">Jam Sampling</th>
        <th style="text-align: center">Qty</th>
        <!-- <th><center><input type="checkbox" onchange="check(this)"></center></th> -->
    </tr>
</thead>
<tbody>
    <?php foreach ($detailTransksi as $key => $detail): ?>
    <tr>
        <td><center><?php echo $detail->Id_Detail_Transaksi;?></center></td>
        <td><center><?php echo $detail->ID_Transaksi;?></center></td>
        <td><center><?php echo str_replace(" ","",$detail->ID_Produk);?></center></td>
        <td><center><?php echo str_replace(" ","",$detail->ID_Formula);?></center></td>
        <td><center><input size="5" id="jamSampling" placeholder="(HH:MM)" value="<?php echo $detail->JamSampling;?>"></center></td>
        <td><center><input size="5" id="qtySampling" value="1"></center></td>
        <td><center><input type="checkbox"  class="chk[]" name="chk[]" value="<?php echo $detail->Id_Detail_Transaksi; ?>" <?php if($detail->Habis==1) echo 'checked' ?>></center></td>
    </tr>
    <?php endforeach ?>
</tbody>