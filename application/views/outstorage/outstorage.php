<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG Sample Locator</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">

</head>
<?php $this->load->view('template/linklogin');?>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  <header class="main-header">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas"></a>
    <?php echo $dataMenu;?>
  </header>
  <?php echo $dataSidebar;?>

  <div class="content-wrapper">
    <section class="content-header"><br>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"> PSG Sample Locator</a></li>
        <li class="active"><?php echo $this->router->fetch_class();?></li>
      </ol>
    </section>

    <section class="content" style="overflow: auto;">
      <div class="row"></div>
      <div class="col-md-12">
        <div class="box" style="border-top-color: orange;">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-external-link" style="color:orange"></i> Sampel Kadaluarsa Hari Ini</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Kadaluarsa :</label>
              <div class="radio" id="rgSwitchTanggalKadaluarsa" disabled="">
                <form>
                  <label>
                    <input type="radio" name="rgSwitchTanggalKadaluarsa" id="optionradioOff" value="disabled" checked="">
                    Tanggal Hari Ini
                  </label>
                  <label> </label>
                  <label>
                    <input type="radio" name="rgSwitchTanggalKadaluarsa" id="optionradioOn" value="pilih">
                    Pilih Tanggal
                  </label>
                  <label></label>
                </form>
              </div>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTanggalKadaluarsa" class="form-control pull-right" disabled="">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="table-responsive">
              <center id="sedangMemuat2" >Sedang memuat ...</center>
              <table id="tblOutHariIni" class="table table-bordered table-hover" >
                <thead>
                  <tr>
                    <th><center>ID Transaksi</center></th>
                    <th><center>Kategori</center></th>
                    <th><center>Filler</center></th>
                    <th><center>PD</center></th>
                    <th><center>Kolom</center></th>
                    <th><center>Umur</center></th>
                    <th><center>BN</center></th>
                    <th><center>Keterangan</center></th>
                  </tr>
                </thead>
                <tbody>
                    <tr onclick="viewDetail2(this)">
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                      <td><center></center></td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="col-md-6" >
        <div class="box" style="border-top-color: orange;">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cubes" style="color:orange"></i> Tabel Transaksi Sampel</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body" style="max-height: 400px; overflow-y: auto;">
            <center id="sedangMemuat1" >Sedang memuat ...</center>
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Pengeluaran Sample :</label>
                <div class="radio" id="rgSwitchTanggalKadaluarsa2" disabled="">
                  <form>
                    <label>
                      <input type="radio" name="rgSwitchTanggalKadaluarsa2" id="optionradioOff" value="disabled" checked="">
                      Tanggal Hari Ini
                    </label>
                    <label> </label>
                    <label>
                      <input type="radio" name="rgSwitchTanggalKadaluarsa2" id="optionradioOn" value="pilih">
                      Pilih Tanggal
                    </label>
                    <label></label>
                  </form>
                </div>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="txtTanggalKadaluarsa2" class="form-control pull-right" disabled="">
                </div>
              </div>
            </div> -->
            <div class="col-md-12" >
              <div class="table-responsive">
                <table id="tblTransaksiAll" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><center>ID Transaksi</center></th>
                      <th><center>Kategori</center></th>
                      <th><center>Filler</center></th>
                      <th><center>PD</center></th>
                      <th><center>Kolom</center></th>
                      <th><center>Umur</center></th>
                      <th><center>BN</center></th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr onclick="viewDetail(this)">
                        <div>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <td><center></center></td>
                        <div>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box" style="border-top-color: orange;">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cube" style="color:orange"></i> Detail Transaksi</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="tblDetailTransaksi" class="table table-bordered table-hover" >
              </table>
            </div>
            <input id="btnOutSample" style="visibility: hidden; background-color: orange;color: #fff;" type="submit" class="btn btn-block" value="Keluarkan Sampel">
          </div>
        </div>
      </div>
    </section>
  <?php $this->load->view('template/control_sidebar'); ?>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <center><strong>Copyright &copy; 2016 <a href="<?php echo base_url(); ?>">PT. Sambu Guntung</a>.</strong> All rights
    reserved.</center>
  </footer>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog"></div>
</body>
</html>


<?php $this->load->view('template/scripthome');?>
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  var idTr;
  var expired=0;
  function getTransaksiAll()
  {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Monitor_Storage/getTransaksiAll",
        dataType : "text",
        async: true,
        success : function(msg)
        {
            $('#tblTransaksiAll').html(msg);
            var table=$('#tblTransaksiAll').DataTable();
            table.destroy();
            $('#tblTransaksiAll').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false
            });
            $('#sedangMemuat1').html('');
        }
    });
  }
  function viewDetail(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string')
              return el.textContent;
          if (typeof el.innerText === 'string')
              return el.innerText;
      }
      getDetailTransaksi(getText(document.getElementById('tblTransaksiAll').rows[x.rowIndex].cells[0]),0);
      expired=0;
  }
  function viewDetail2(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string')
              return el.textContent;
          if (typeof el.innerText === 'string')
              return el.innerText;
      }
      getDetailTransaksi(getText(document.getElementById('tblOutHariIni').rows[x.rowIndex].cells[0]),1);
      expired=1;idTr=getText(document.getElementById('tblOutHariIni').rows[x.rowIndex].cells[0]);
  }
  function getDetailTransaksi(id,exp)
  {
    var idTrans=id;idTr=id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Storage/getDetailTransaksi?check=1",
        data: {idTrans : idTrans},
        dataType : "text",
        success : function(msg) {
            $('#tblDetailTransaksi').html(msg);
            $('#btnOutSample').css('visibility', 'visible');
        }
    });
  }
  function check(ele)
  {
      var checkboxes = document.getElementsByTagName('input');
      if (ele.checked) {
          for (var i = 0; i < checkboxes.length; i++) {
              if (checkboxes[i].type == 'checkbox') {
                  checkboxes[i].checked = true;
              }
          }
      } else {
          for (var i = 0; i < checkboxes.length; i++) {
              if (checkboxes[i].type == 'checkbox') {
                  checkboxes[i].checked = false;
              }
          }
      }
  }
  $('#btnOutSample').on('click', function()
  {
    var chk=[];
    var objDetailTransksi;
    var sudahHabis;
    if(expired==1)//Transaksi sudah expired
    {
      $('#tblDetailTransaksi tbody tr').each(function()
      {
          $(this).find('input:checkbox:checked').each(function()
          {
            var ID=$(this).closest('tr').find('td').eq(0).text();
            var IDTrans=$(this).closest('tr').find('td').eq(1).text();
            var IDProduk=$(this).closest('tr').find('td').eq(2).text();
            var IDFormula=$(this).closest('tr').find('td').eq(3).text();
            var JamSampling=$(this).closest('tr').find('td').eq(4).find('#jamSampling').val();
            var QtySampling=$(this).closest('tr').find('td').eq(5).find('#qtySampling').val();
            objDetailTransksi={"ID":ID,'IDTrans':IDTrans,'IDProduk':IDProduk,'IDFormula':IDFormula,'JamSampling':JamSampling,'QtySampling':QtySampling};
            chk.push(objDetailTransksi);
          });
      });
      $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Out_Storage/updateTransaksiOutKadaluarsa",
        dataType : "text",
        data : {'detail':chk,'tglAntar':$('#txtTanggalKadaluarsa').val()},
        success : function(msg)
        {
            getExpiredToday($('#txtTanggalKadaluarsa').val());$('#tblDetailTransaksi').html('');
        }
      });
    }
    else
    {
      $.ajax({
              url: "<?php echo base_url();?>Storage/cekDetailHabis",
              method:"POST",
              data : {idtransaksi:idTr},
              success: function (response)
              {
                sudahHabis=response;
              },
              async: false,
              dataType: "json"
          });
      var QS='asdasd';
      $('#tblDetailTransaksi tbody tr').each(function()
      {
          $(this).find('input:checkbox:checked').each(function()
          {
            var ID=$(this).closest('tr').find('td').eq(0).text();
            var IDTrans=$(this).closest('tr').find('td').eq(1).text();
            var IDProduk=$(this).closest('tr').find('td').eq(2).text();
            var IDFormula=$(this).closest('tr').find('td').eq(3).text();
            var JamSampling=$(this).closest('tr').find('td').eq(4).find('#jamSampling').val();
            var QtySampling=$(this).closest('tr').find('td').eq(5).find('#qtySampling').val();
            objDetailTransksi={"ID":ID,'IDTrans':IDTrans,'IDProduk':IDProduk,'IDFormula':IDFormula,'JamSampling':JamSampling,'QtySampling':QtySampling};
            if(QtySampling==''){QS='';}
            if(sudahHabis.length==0){chk.push(objDetailTransksi);}
            else
            {
              for(var i=0; i<sudahHabis.length;i++)
              {
                if(sudahHabis[i].Id_Detail_Transaksi!=ID)
                {
                  chk.push(objDetailTransksi);
                }
              }
            }
          });
      });
      if(QS==''){alert('Silahkan lengkapi jumlah sampling terlebih dahulu.');}
      else if(chk.length>0)
      {
        $.ajax({ //Load Detail Modal
              url: "<?php echo base_url();?>Storage/loadDetailModalOut",
              method:"POST",
              data : {chk:chk},
              success: function (response)
              {
                 $('#myModal').html(response)
                 $('#myModal').modal('show');
              },
              dataType: "text"
        });
      }
      else if(chk.length ==0 && sudahHabis.length>0)
      {
        alert('Sampel yang anda pilih sudah habis dikeluarkan.');
      }
      else{alert('Silahkan pilih sampel yang akan dikeluarkan.');}
    }
  });
  $( document ).ready(function() {
    getExpiredToday($('#txtTanggalKadaluarsa').val());
    getTransaksiAll();
  });
  function getExpiredToday(tgl)
  {
    $.ajax({
        url: "<?php echo base_url();?>Out_Storage/getExpired",
        method:"POST",
        data : {date:tgl},
        success: function (response)
        {
           $('#tblOutHariIni').html(response);
            var table=$('#tblOutHariIni').DataTable();
            table.destroy();
            $('#tblOutHariIni').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false
            });
            $('#sedangMemuat2').html('');
        },
        dataType: "text"
    });
  }
  $('#txtTanggalKadaluarsa').datepicker(
  {
      autoclose: true,format: 'dd-mm-yyyy'
  });
  $('#txtTanggalKadaluarsa2').datepicker(
  {
      autoclose: true,format: 'dd-mm-yyyy'
  });
  var d = new Date();
  var month = d.getMonth()+1;
  var day = d.getDate();
  var output =(day<10 ? '0' : '') + day+'-'+(month<10 ? '0' : '') + month +'-'+d.getFullYear();
  $("#txtTanggalKadaluarsa").val(output);$("#txtTanggalKadaluarsa2").val(output);
  $('#rgSwitchTanggalKadaluarsa').on('change', function()
  {
    if($("input[name='rgSwitchTanggalKadaluarsa']:checked").val()=='disabled')
    {
      var d = new Date();var month = d.getMonth()+1;var day = d.getDate();var output =(day<10 ? '0' : '') + day+'/'+(month<10 ? '0' : '') + month +'/'+d.getFullYear();
      $("#txtTanggalKadaluarsa").val(output);
      $('#txtTanggalKadaluarsa').prop('disabled', true);
      getExpiredToday($('#txtTanggalKadaluarsa').val());
    }
    else
    {
      $('#txtTanggalKadaluarsa').prop('disabled', false);
    }
  });
  $('#rgSwitchTanggalKadaluarsa2').on('change', function()
  {
    if($("input[name='rgSwitchTanggalKadaluarsa2']:checked").val()=='disabled')
    {
      var d = new Date();var month = d.getMonth()+1;var day = d.getDate();var output =(day<10 ? '0' : '') + day+'/'+(month<10 ? '0' : '') + month +'/'+d.getFullYear();
      $("#txtTanggalKadaluarsa2").val(output);
      $('#txtTanggalKadaluarsa2').prop('disabled', true);
    }
    else
    {
      $('#txtTanggalKadaluarsa2').prop('disabled', false);
    }
  });
  $('#txtTanggalKadaluarsa').datepicker().on('changeDate', function (ev)
  {
    getExpiredToday($('#txtTanggalKadaluarsa').val());
  });
</script>


<!--<script>
$('#datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });
</script>-->