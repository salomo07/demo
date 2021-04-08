<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead>
  <tr>
    <th><center>ID</center></th>
    <th><center>Batch</center></th>
    <th><center>ID Produk</center></th>
    <th><center>ID Formula</center></th>
    <th><center>PD</center></th>
    <th><center>ED</center></th>
    <th><center>EDS</center></th>
    <th><center>Filler</center></th>
    <th><center>BN</center></th>
    <th><center>Jam Sampling</center></th>
    <th><center>Keterangan</center></th>
    <th><center></center></th>
  </tr>
</thead>
<tbody>
  <?php foreach ($detailOutputWTP as $key => $detail): ?>
    <tr>  
      <td type="hidden" style="display: none"><center><input id="idBatch" value="<?php echo $detail->ID?>"></center></td>
      <td id="txtID"><center><?php echo $detail->ID;?></center></td>
      <td id="txtBatch"><center><?php echo $detail->Batch; ?></center></td>               
      <td id="txtProductID"><center><?php echo str_replace(' ', '', $detail->ProductID); ?></center></td>
      <td id="txtFormula"><center><?php echo str_replace(' ', '', $detail->Formula); ?></center></td>
      <td id="txtPD"><center><?php echo str_replace(' ', '', $detail->PD); ?></center></td>
      <td id="txtED"><center><?php echo str_replace(' ', '', $detail->ED); ?></center></td>
      <td id="txtEDS"><center><?php $pd=substr($detail->PD, 6)."-".substr($detail->PD, 3,2)."-".substr($detail->PD, 0,2);      
                if (strpos(strtoupper($detail->ProductID), 'SZW') !== false) 
                {
                  echo date('d-m-Y',strtotime($pd.'+'.($detail->Month+6).' months'));
                }
                else
                {
                  echo date('d-m-Y',strtotime($pd.'+'.($detail->Month+3).' months'));
                  //echo str_replace(' ', '', $detail->ED);//date('d-m-Y',strtotime($ed.'+'.($detail->Month).' months')).'s';
                }

                ?></center></td>
      <td id="txtFiller"><center><?php echo str_replace(' ', '', $detail->Filler); ?></center></td>
      <td id="txtBN"><center><?php if(isset($detail->BN)){echo $detail->BN;} ?></center></td>
      <td><center><input size="5" id="jamSampling" placeholder="(HH:MM)"></center></td>
      <td><center><input size="20" id="txtKet" placeholder="Keterangan"></center></td>
      <td><center><input type="checkbox" onchange="chkChange(this)" class="chk[]" name="chk[]" value="<?php echo $detail->Batch?>"></center></td>
    </tr>
<?php endforeach ?>
</tbody>