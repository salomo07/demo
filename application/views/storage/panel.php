<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3 id="jumlahSampel">0</h3>
        <p>Transaksi Tersimpan</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-archive"></i>
      </div>
      <a href="<?php echo base_url(); ?>Storage" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-2 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3 id="jumlahUji">0</h3>
        <p>Pengujian Hari Ini</p>
      </div>
      <div class="icon">
        <i class="fa fa-flask"></i>
      </div>
      <a href="<?php echo base_url(); ?>Testing_Sample" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-2 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3 id="jumlahOut">0</h3>
        <p>Sampel Kadaluarsa</p>
      </div>
      <div class="icon">
        <i class="fa fa-external-link"></i>
      </div>
      <a href="<?php echo base_url(); ?>Out_Storage" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-2 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3 id="jumlahLocator">0</h3>
        <p>Kolom Locator</p>
      </div>
      <div class="icon">
        <i class="fa fa-file-text-o"></i>
      </div>
      <a href="<?php echo base_url(); ?>Master_Locator" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-fuchsia">
      <div class="inner">
        <h3><br></h3>
        <p>Monitor Penyimpanan</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-archive"></i>
      </div>
      <a href="<?php echo base_url(); ?>Monitor_Storage" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
  getJumlahTransaksi();
  function getJumlahTransaksi()
  {
    $.ajax({
          url: "<?php echo base_url();?>Storage/getJumlahTransaksi",
          success: function (response) 
          {
            $('#jumlahSampel').text(response); getJumlahTransaksiUjiHariIni();       
          }
      });
  }
  function getJumlahTransaksiUjiHariIni()
  {
    $.ajax({
          url: "<?php echo base_url();?>Testing_Sample/getJumlahUjiHariIni",
          success: function (response) 
          {
            $('#jumlahUji').text(response);    
            getJumlahTransaksiKadaluarsa();    
          }
      });
  }
  function getJumlahTransaksiKadaluarsa()
  {
    $.ajax({
          url: "<?php echo base_url();?>Out_Storage/getJumlahKadaluarsa",
          success: function (response) 
          {

            $('#jumlahOut').text(response);  getJumlahLocator();      
          }
      });
  }
  function getJumlahLocator()
  {
    $.ajax({
          url: "<?php echo base_url();?>Master_Locator/getJumlahLocator",
          success: function (response) 
          {

            $('#jumlahLocator').text(response);        
          }
      });
  }
</script>