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
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">

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
      <div class="row">
        <?php $this->load->view('storage/panel'); ?>
      </div>
      <div class="box box-info">    
        <?php if(isset($arrayUserdata)){echo $arrayUserdata['ID_Log'];} ?> 
          <div class="box-header with-border">
            <h3 class="box-title"><i class="ion ion-android-archive"></i> Simpan Sampel</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input id="txtIDTransaksi" type="hidden">
                  <label>Category</label>
                  <select name="selectCat" id="selectCat" class="form-control select2" style="width: 100%;">
                    <option value=""></option>
                    <option value="CCU">CCU</option>
                    <option value="CLD">CLD</option>
                    <option value="CWD">CWD</option>
                    <option value="CMD">CMD</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Production Date</label>
                  <select name="selectPD" id="selectPD" class="form-control select2" style="width: 100%;"></select>
                </div>
                <div class="form-group">
                  <label>Filler /  Machine</label>
                  <select name="selectFiller" id="selectFiller" class="form-control select2" style="width: 100%;"></select>
                </div>
                <div class="form-group">
                  <label>Kode Kolom</label>
                  <input type="text" class="form-control" id="txtKodeKolom" placeholder="Pilih Kode Kolom ..." disabled>
                </div>
                <br>
                <!-- <div class="form-group">
                  <div class="col-md-12">
                    <label for="radio">Expire Date</label>
                    <div class="radio" id="rgED" disabled>
                      <form>
                        <label>
                          <input type="radio" name="rbED" id="optionradioED1" value="12" checked>
                          12 Bulan
                        </label>
                        <label> </label>
                        <label>
                          <input type="radio" name="rbED" id="optionradioED4" value="13">
                          13 Bulan
                        </label>
                        <label> </label>
                        <label>
                          <input type="radio" name="rbED" id="optionradioED2" value="15">
                          15 Bulan
                        </label>
                        <label>  </label>
                        <label>
                          <input type="radio" name="rbED" id="optionradioED3" value="18">
                          18 Bulan
                        </label>
                        <label>  </label>
                        <label>
                          <input type="radio" name="rbED" id="optionradioED5" value="24">
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
                        <input type="radio" name="rbEDS" id="optionradioEDS1" value="15" checked>
                        15 Bulan
                      </label>
                      <label> </label>
                      <label>
                        <input type="radio" name="rbEDS" id="optionradioEDS2" value="16">
                        16 Bulan
                      </label>
                      <label> </label>
                      <label>
                        <input type="radio" name="rbEDS" id="optionradioEDS3" value="18">
                        18 Bulan
                      </label>
                      <label> </label>
                      <label>
                        <input type="radio" name="rbEDS" id="optionradioEDS4" value="21">
                        21 Bulan
                      </label>
                      <label> </label>
                      <label>
                        <input type="radio" name="rbEDS" id="optionradioEDS5" value="24">
                        24 Bulan
                      </label>
                      </form>
                    </div>
                  </div>
                </div> -->
              </div>
              <div class="col-md-12">
                <div class="col-md-12">
                  <div class="table-responsive"><br>
                    <label>Tabel Detail</label>
                    <table id="tblOutputWTP" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><center>Batch</center></th>
                        <th><center>ID Produk</center></th>
                        <th><center>ID Formula</center></th>
                        <th><center>Filler</center></th>
                        <th><center>BN</center></th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>   
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
                <div class="col-md-12">
                  <div id="divLocatorAll">
                    <div class="table-responsive">
                    <br>
                      <label>Tabel Locator</label>
                      <table id="tblLocatorAll" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                              <th style="text-align: center">Kode Kolom</th>
                              <th style="text-align: center">Masa Penyimpanan</th>
                              <th style="text-align: center">Transaksi Tersimpan</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr onclick="getKodeKolom(this)">   
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
              <br><br>              
            </div>            
          </div>
          <div class="box-footer">
            <div class="col-md-6"><input id="btnSave" type="submit" class="btn btn-block btn-info" value="Input Sampel"/></div>
            <div class="col-md-6"><input id="btnCancel" type="submit" class="btn btn-block btn-default" value="Cancel"/></div>
          </div>      
      </div>
      <div class="box box-info"> 
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cubes" style="color:#00c0ef"></i> Tabel Transaksi Hari Ini</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <div class="box-body" style="overflow: auto">  
            <table id="tblTransaksiHariIni" class="table table-bordered table-hover" style="overflow: auto">
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
    </section>
  <div id="lala"></div>
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog"></div>
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
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(".select2").select2();
  $('#tblLocatorAll').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
  });
  getTransaksiHariIni ();
  $("select").prop('disabled', true);
  $('#btnCancel').on('click', function() 
  {
    $("select").prop('disabled', true);
    $('#btnSave').val("Input Sampel");
  });
  $('#btnSave').on('click', function() 
  {
    if($('#btnSave').val()=='Input Sampel')
    {
      $('#btnSave').val('Simpan Sampel');$("#selectCat").prop('disabled', false);
    }
    else if($('#btnSave').val()=='Simpan Sampel')
    {
      var selectCat=$('#selectCat').val();
      var selectPD=$('#selectPD').val();
      var selectFiller=$('#selectFiller').val();
      var txtKodeKolom=$('#txtKodeKolom').val();
      var rbED=$("input[name='rbED']:checked").val();
      var rbEDS=$("input[name='rbEDS']:checked").val();
      var chk=[];
      $('tbody tr').each(function() 
      {
        chk.push($(this).find('input:checkbox:checked').val());
      })
      if(chk.length==0)
      {
        alert('Silahkan pilih sampel yang akan disimpan.');
      }
      else if(selectCat=='')
      {
        alert('Silahkan pilih ketegori sampel.');
      }
      else if(selectPD=='')
      {
        alert('Silahkan pilih tanggal produksi.');
      }
      else if(selectFiller=='')
      {
        alert('Silahkan pilih filler');
      }
      else if(txtKodeKolom=='')
      {
        alert('Silahkan pilih kode kolom');
      }
      else
      {
        var arrayOfObject=[];
        $('#tblOutputWTP tbody tr').each(function() {
            $(this).find('input:checkbox:checked').each(function() {
              var ID=$(this).closest('tr').find('#txtID').text();
              var Batch=$(this).closest('tr').find('#txtBatch').text();
              var IdProduct=$(this).closest('tr').find('#txtProductID').text();
              var IdFormula=$(this).closest('tr').find('#txtFormula').text();
              var Filler=$(this).closest('tr').find('#txtFiller').text();
              var BN=$(this).closest('tr').find('#txtBN').text();
              var ED=$(this).closest('tr').find('#txtED').text();
              var EDS=$(this).closest('tr').find('#txtEDS').text();
              var ket=$(this).closest('tr').find('#txtKet').val();
              var objDetailTransksi={"ID":ID,"Batch":Batch,"IdProduct":IdProduct,"IdFormula":IdFormula,"Filler":Filler,"BN":BN,"ED":ED,"EDS":EDS,"Keterangan":ket}
              arrayOfObject.push(objDetailTransksi);
            });
        });
        $.ajax({
              url: "<?php echo base_url();?>Storage/saveSample",
              method:"POST",
              data : { selectCat: selectCat, selectPD: selectPD,selectFiller:selectFiller,txtKodeKolom:txtKodeKolom, chk:chk,arrayOfObject:arrayOfObject},
              success: function (response) 
              {
                console.log(response);
                 getTransaksiHariIni ();
                 $('#btnSave').val("Input Sampel");
                 $("select").prop('disabled', false);
                 alert("Sampel berhasil disimpan");
                 $('#tblOutputWTP').html('');
              },
              dataType: "text"
          });
      }
    }
  });
  $('#selectCat').on('change', function() 
  {
    $("#selectPD").select2("val", "");$("#selectFiller").select2("val", "");
    $.ajax({
          url: "<?php echo base_url();?>Storage/getDaftarPDWTP?kategori="+this.value,
          success: function (response) 
          {
            //console.log(response);
            $('#selectPD').html(response); 
            $('#selectFiller').html('');
            $('#selectPD').prop('disabled', false);
          },
          dataType: "html"
    });
  });
  $('#selectPD').on('change', function() 
  {
    $("#selectFiller").select2("val", "");
    $.ajax({
          url: "<?php echo base_url();?>storage/getDaftarFillerWTP?kategori="+$('#selectCat').val()+"&tanggal="+this.value,
          success: function (response) 
          {            
            $('#selectFiller').val('');$("#selectFiller").html(response);$('#selectFiller').prop('disabled', false);
            $('#tblOutputWTP').html('');
          },
          dataType: "html"
    });
  });
  $('#selectFiller').on('change', function() 
  {
    $.ajax({
          url: "<?php echo base_url();?>Storage/getDetailOutputWTP?kategori="+$('#selectCat').val()+"&tanggal="+$('#selectPD').val()+"&filler="+this.value,
          dataType: "html",
          success: function (response) 
          {         
            console.log(response);
            $("#tblOutputWTP").html(response);
          }          
    });
  });
  function chkChange(ele)
  {
    var jumlahTerpilih=0;
    $('#tblOutputWTP tbody tr').each(function() {
        $(this).find('input:checkbox:checked').each(function() {
          jumlahTerpilih++;
        });
    });
    if(jumlahTerpilih>0)
    { 
      var baris=ele.closest('tr');
      var batchID=document.getElementById('tblOutputWTP').rows[baris.rowIndex].cells[1].innerText;
      $.ajax({
          url: "<?php echo base_url();?>Storage/cekSudahPernahDisimpan",
          method:"POST",
          data : { batchID: batchID, batchDetail: ele.value},
          success: function (response) 
          {
            if(response!="BelumTersimpan")
            {alert("Sampel yang anda pilih telah tersimpan sebelumnya, silahkan pilih detail lainnya."); ele.checked=false;}
            else{$("select").prop('disabled', true);}
          }
      });
      $.ajax({
          url: "<?php echo base_url();?>Master_Locator/getLocatorAll",
          success: function (response) 
          {
            var table=$('#tblLocatorAll').DataTable();
            table.destroy();
            $("#tblLocatorAll").html(response); 
            $('#tblLocatorAll').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
              "lengthMenu": [[6, 12, 18, -1], [6, 12, 18, "All"]]
            });           
          }
      });
    }
  }
  function getDetailTransaksi(id) 
  {
    var idTrans=id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Storage/getDetailTransaksi?titleModal=Detail Transaksi&&bodyModal=&&modal=1",
        data: {idTrans : idTrans}, 
        dataType : "text",
        success : function(msg) {
          console.log(msg);
            $('#myModal').html(msg);
            $('#myModal').modal('show');
        }
    });
  }  
  function getTransaksiHariIni () 
  {
    $.ajax({
          url: "<?php echo base_url();?>Storage/getTransaksiHariIni",
          success: function (response) 
          {
            var table=$('#tblTransaksiHariIni').DataTable();
            table.destroy();
            $("#tblTransaksiHariIni").html(response);    
            $('#tblTransaksiHariIni').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": false,
            });       
          }
      });
  }
  function getKodeKolom (x)
  {
      $('#txtKodeKolom').val(document.getElementById('tblLocatorAll').rows[x.rowIndex].cells[0].innerText);     
  }
  function viewDetail(x)
  {
      function getText(el) {
          if (typeof el.textContent === 'string')
              return el.textContent;
          if (typeof el.innerText === 'string')
              return el.innerText;
      }
      getDetailTransaksi(getText(document.getElementById('tblTransaksiHariIni').rows[x.rowIndex].cells[0]))      
  }
</script>


<!--<script> 
$('#datepicker').datepicker({
    format: 'dd-mm-yyyy'
 });
</script>-->