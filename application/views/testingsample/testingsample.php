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

    <section class="content">
      <div class="row"></div>
      <div class="col-md-7">
        <div class="box" style="border-top-color: green;">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-flask" style="color:green"></i> Sampel Uji Hari Ini</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" style="color:green"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove" style="color:green"></i></button>
            </div>
          </div>
          <div class="box-body">
          <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Pengujian :</label>
              <div class="radio" id="rgSwitchTanggalPengujian" disabled="">
                <form>
                  <label>
                    <input type="radio" name="rgSwitchTanggalPengujian" id="optionradioOff" value="disabled" checked="">
                    Tanggal Hari Ini
                  </label>
                  <label> </label>
                  <label>
                    <input type="radio" name="rgSwitchTanggalPengujian" id="optionradioOn" value="pilih">
                    Pilih Tanggal
                  </label>
                  <label></label>
                </form>
              </div>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTanggalPengujian" class="form-control pull-right" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-6">
          </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <center id="sedangMemuat1" >Sedang memuat ...</center><br>
              <div id="divTblMonitor" class="table-responsive">
                <table id="tblTestingHariIni" class="table table-bordered table-hover">
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
          <div class="box-footer">

          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="box" style="border-top-color: green;">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-flask" style="color:green"></i> Detail Transaksi</h3>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-body">
            <div id="divTblMonitor" class="table-responsive">
              <table id="tblDetailTransaksi" class="table table-bordered table-hover">
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
          <div class="box-footer">
            <input id="btnKirimUji" type="submit" class="btn" style="visibility: hidden; float:right; background-color: green;color: #fff;border-color: #2e6da4;"  value="Kirim Sampel">
          </div>
        </div>
      </div>
      <div id="myModal" class="modal  fade" tabindex="-1" role="dialog"></div>

    </section>
  <div id="lala"></div>
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
</body>
</html>

<?php $this->load->view('template/scripthome');?>
<script src="<?php echo base_url();?>assets/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/js/demo.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>


<script>
  var idTrans;
  var arrayOfObject=[];
  var umur;
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

  $('#btnKirimUji').on('click', function()
  {
    var arrayOfObject=[];
    var JS='asdasd';var QS='asdasd';
    $('#tblDetailTransaksi tbody tr').each(function() {
        $(this).find('input:checkbox:checked').each(function() {
          var ID=$(this).closest('tr').find('td').eq(0).text();
          var IDTrans=$(this).closest('tr').find('td').eq(1).text();
          var IDProduct=$(this).closest('tr').find('td').eq(2).text();
          var IDFormula=$(this).closest('tr').find('td').eq(3).text();
          var JamSampling=$(this).closest('tr').find('td').eq(4).find('#jamSampling').val();
          var QtySampling=$(this).closest('tr').find('td').eq(5).find('#qtySampling').val();
          if(JamSampling==''){JS='';}if(QtySampling==''){QS='';}
          var objDetailTransksi={"ID":ID,'IDTrans':IDTrans,'IDProduct':IDProduct,'IDFormula':IDFormula,'JamSampling':JamSampling,'QtySampling':QtySampling}
          arrayOfObject.push(objDetailTransksi);
        });
    });
    if(arrayOfObject.length==0){alert('Silahkan pilih transaksi yang akan diuji.');}
    else if(JS==''){alert('Silahkan lengkapi jam sampling terlebih dahulu.');}
    else if(QS==''){alert('Silahkan lengkapi jumlah sampling terlebih dahulu.');}
    else
    {
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Testing_Sample/sendTransaksiUji",
          data: {'arrayOfObject': arrayOfObject,'tglAntar':$('#txtTanggalPengujian').val()},
          success : function(msg)
          {
            //console.log(msg);
            alert('Transaksi yang anda pilih telah tersimpan pada Histori Uji dan siap dikirim.');
            loadUjiHariIni($("#txtTanggalPengujian").val());
          }
      });
    }
  });
  $('#txtTanggalPengujian').datepicker(
  {
      autoclose: true,format: 'dd-mm-yyyy'
  });

  var d = new Date();var month = d.getMonth()+1;var day = d.getDate();var output =(day<10 ? '0' : '') + day+'/'+(month<10 ? '0' : '') + month +'/'+d.getFullYear();
  $("#txtTanggalPengujian").val(output);
  loadUjiHariIni($("#txtTanggalPengujian").val());

  $('#rgSwitchTanggalPengujian').on('change', function()
  {
    if($("input[name='rgSwitchTanggalPengujian']:checked").val()=='disabled')
    {
      var d = new Date();var month = d.getMonth()+1;var day = d.getDate();var output =(day<10 ? '0' : '') + day+'/'+(month<10 ? '0' : '') + month +'/'+d.getFullYear();
      $("#txtTanggalPengujian").val(output);
      $('#txtTanggalPengujian').prop('disabled', true);
      loadUjiHariIni($('#txtTanggalPengujian').val());
    }
    else
    {
      $('#txtTanggalPengujian').prop('disabled', false);
    }
  });
  $('#txtTanggalPengujian').datepicker().on('changeDate', function (ev)
  {
    loadUjiHariIni($('#txtTanggalPengujian').val());
  });
  function getDetailTransaksi(id,umur)
  {
    idTrans=id.replace(/(\r\n|\n|\r)/gm,"");
    umur=umur.replace(' bulan','');
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Storage/getDetailTransaksi?check=1",
        data: {'idTrans' : idTrans},
        success : function(msg)
        {
          $('#tblDetailTransaksi').html(msg);
          $('#btnKirimUji').css('visibility', 'visible');
        }
    });
  }
  function viewDetail(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string') return el.textContent;
          if (typeof el.innerText === 'string') return el.innerText;
      }
      var id=document.getElementById('tblTestingHariIni').rows[x.rowIndex].cells[0].innerText;
      var umur=document.getElementById('tblTestingHariIni').rows[x.rowIndex].cells[5].innerText;
      getDetailTransaksi(id,umur);
  }
  function loadUjiHariIni(tgl)
  {
      tgl=tgl.replace(/\\/g, '-');
      $('#sedangMemuat1').text('Sedang memuat...');
      $.ajax({
          type: "POST",
          url: "<?php echo base_url()?>"+"Testing_Sample/getUjiHariIni",
          data : { 'tgl': tgl},
          success : function(msg) {
            console.log(msg);
            var table=$('#tblTestingHariIni').DataTable();
            table.destroy();
            $("#tblTestingHariIni").html(msg);
            $('#tblTestingHariIni').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });
            $('#sedangMemuat1').text('');
            $('#tblDetailTransaksi').html('');
          }
      });
  }
</script>