<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead>
    <tr>
        <th style="text-align: center">ID Product</th>
        <th style="text-align: center">ID Formula</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($detailTransksi as $key => $detail): ?>
    <tr>
        <td><?php echo $detail->ID_Produk;?></td>
        <td><?php echo $detail->ID_Formula;?></td>
    </tr>
    <?php endforeach ?>
</tbody>