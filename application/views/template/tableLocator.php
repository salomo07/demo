<thead>
    <tr>
        <th style="text-align: center">Kode Kolom</th>
        <th style="text-align: center">Masa Penyimpanan</th>
        <th style="text-align: center">Transaksi Tersimpan</th>
    </tr>
</thead>
<tbody>
  <?php foreach ($daftarLocator as $key => $detail): ?>
  <tr onclick="getKodeKolom(this)">   
      <td><center><?php echo $detail->Kode_Kolom;?></center></td>               
      <td><center><?php echo $detail->Masa_Simpan;?></center></td>
      <td><center><?php echo $detail->TransaksiTersimpan;?></center></td>
  </tr>
  <?php endforeach ?>
</tbody>
