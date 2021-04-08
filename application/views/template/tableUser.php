<thead>
    <tr>
        <th style="text-align: center">NIK</th>
        <th style="text-align: center">Username</th>
        <th style="text-align: center">Role</th>
    </tr>
</thead>
<tbody>
  <?php foreach ($daftarUser as $key => $detail): ?>
  <tr onclick="getKodeKolom(this)">   
      <td><center><?php echo $detail->Nik;?></center></td>               
      <td><center><?php echo $detail->Username;?></center></td>
      <td><center><?php echo $detail->Role;?></center></td>
  </tr>
  <?php endforeach ?>
</tbody>
