<div class="col-md-12">
  <br><br><center><label>Data Transaksi</label></center><br>
  <div class="form-group">
    <input id="txtIDTransaksi" type="hidden">
    <label>Category</label>
    <input name="selectCat" id="selectCat" class="form-control" style="width: 100%;" value="<?php echo $transaksiByID->Kategori;?>" disabled>
  </div>
  <div class="form-group">
    <label>Production Date</label>
    <input name="selectPD" id="txtPD" class="form-control" style="width: 100%;" value="<?php echo $transaksiByID->Tanggal_Produksi;?>" disabled>
  </div>
  <div class="form-group">
    <label>Filler /  Machine</label>
    <input name="selectFiller" id="txtFiller" class="form-control" style="width: 100%;" value="<?php echo $transaksiByID->Kode_Filler;?>" disabled>
  </div>
  <div class="form-group">
    <label>Kode Kolom</label>
    <select name="selectKodeKolom" id="selectKodeKolom" class="form-control select2" style="width: 100%;">
    <?php foreach ($daftarLocator as $key => $value): ?>
      <option value="<?php echo $value->Kode_Kolom; ?>" <?php if($transaksiByID->Kode_Kolom==$value->Kode_Kolom){echo "selected";} ?>  ><?php echo $value->Kode_Kolom; ?></option>
    <?php endforeach ?>
    </select>  
  </div>
  <br>
  <div class="form-group">
    <div class="col-md-12">
      <label for="radio">Expire Date</label>
      <div class="radio" id="rgED" disabled>
        <form>
          <label>
            <input type="radio" name="rbED" id="optionradioED1" value="12" <?php if($transaksiByID->UmurED==12){echo 'checked';}?>>
            12 Bulan
          </label>
          <label> </label>
          <label>
            <input type="radio" name="rbED" id="optionradioED2" value="13" <?php if($transaksiByID->UmurED==13){echo 'checked';}?>>
            13 Bulan
          </label>
          <label> </label>
          <label>
            <input type="radio" name="rbED" id="optionradioED3" value="15" <?php if($transaksiByID->UmurED==15){echo 'checked';}?>>
            15 Bulan
          </label>
          <label>  </label>
          <label>
            <input type="radio" name="rbED" id="optionradioED4" value="18" <?php if($transaksiByID->UmurED==18){echo 'checked';}?>>
            18 Bulan
          </label>
          <label>  </label>
          <label>
            <input type="radio" name="rbED" id="optionradioED5" value="24" <?php if($transaksiByID->UmurED==24){echo 'checked';}?>>
            24 Bulan
          </label>
        </form>
      </div>
    </div>
  </div>
  <br><br>
  <div>
    <div class="col-md-12">
      <label for="radio">Expire Date of Sample</label>
      <div class="radio" id="rgEDS">
        <form>
        <label>
          <input type="radio" name="rbEDS" id="optionradioEDS1" value="15" <?php if($transaksiByID->UmurEDS==15){echo 'checked';}?>>
          15 Bulan
        </label>
        <label> </label>
        <label>
          <input type="radio" name="rbEDS" id="optionradioEDS2" value="16" <?php if($transaksiByID->UmurEDS==16){echo 'checked';}?>>
          16 Bulan
        </label>
        <label> </label>
        <label>
          <input type="radio" name="rbEDS" id="optionradioEDS3" value="18" <?php if($transaksiByID->UmurEDS==18){echo 'checked';}?>>
          18 Bulan
        </label>
        <label> </label>
        <label>
          <input type="radio" name="rbEDS" id="optionradioEDS4" value="21" <?php if($transaksiByID->UmurEDS==21){echo 'checked';}?>>
          21 Bulan
        </label>
        <label> </label>
        <label>
          <input type="radio" name="rbEDS" id="optionradioEDS5" value="27" <?php if($transaksiByID->UmurEDS==27){echo 'checked';}?>>
          27 Bulan
        </label>
        </form>
      </div>
    </div>
  </div>
</div>