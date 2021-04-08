$(".select2").select2();
  $('#tblOutputWTP').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
  });
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
              var ID=$(this).closest('tr').find('td').eq(1).text();
              var Batch=$(this).closest('tr').find('td').eq(2).text();
              var IdProduct=$(this).closest('tr').find('td').eq(3).text();
              var IdFormula=$(this).closest('tr').find('td').eq(4).text();
              var Filler=$(this).closest('tr').find('td').eq(5).text();
              var BN=$(this).closest('tr').find('td').eq(6).text();
              var objDetailTransksi={"ID":ID,"Batch":Batch,"IdProduct":IdProduct,"IdFormula":IdFormula,"Filler":Filler,"BN":BN}
              arrayOfObject.push(objDetailTransksi);
            });
        });
        $.ajax({
            url: "<?php echo base_url();?>Storage/saveSample",
            method:"POST",
            data : { selectCat: selectCat, selectPD: selectPD,selectFiller:selectFiller,txtKodeKolom:txtKodeKolom, chk:chk,rbED:rbED,rbEDS:rbEDS,arrayOfObject:arrayOfObject},
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
      $.ajax({
          url: "<?php echo base_url();?>Storage/cekSudahPernahDisimpan",
          method:"POST",
          data : { batchID: $('#idBatch').val(), batchDetail: ele.value},
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
  function getDetailTransaksi(id) 
  {
    var idTrans=id;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url()?>"+"Storage/getDetailTransaksi?titleModal=Detail Transaksi&&bodyModal=&&modal=1",
        data: {idTrans : idTrans}, 
        dataType : "text",
        success : function(msg) {
            $('#myModal').html(msg);
            $('#myModal').modal('show');
        }
    });
  }
  function getKodeKolom(x)
  {
      $('#txtKodeKolom').val(document.getElementById('tblLocatorAll').rows[x.rowIndex].cells[0].innerText);     
  }
  function getTransaksiHariIni () 
  {
    $.ajax({
          url: "<?php echo base_url();?>Storage/getTransaksiHariIni",
          success: function (response) 
          {
            console.log(response);
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