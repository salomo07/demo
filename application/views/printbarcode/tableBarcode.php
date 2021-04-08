
<center>
<table id="tblBarcode" border="1" width="642px" style="table-layout: fixed;">
    <?php
    $html='<tr class="col-md-12">';
    $i=1;
        foreach ($_SESSION["chk"] as $key => $value) {
            if(($i % 3)==0)
            {
                $html=$html."
                <td class='col-md-4'>                    
                    <div><center><label style='font-size:33px' ><b>".$value['PD']."</b></label></center>
                    <label style='font-size:0px' id='lbl".$i."' >".$value['ID']."</label>
                    <center><svg id=".'svg'.$i."></svg></center></div>                   
                    <div style='font-size:12px'><label style='float:left '>".$value['Filler']."</label> <label style='float:right'>".$value['Kategori']."</label><br><center><label>".$value['Kolom']."</label></center><center><label>".$value['BN']."</label></center></div>
                </td></tr>";
            }
            else
            {
                $html=$html."
                <td class='col-md-4'>                    
                    <div><center><label style='font-size:33px' ><b>".$value['PD']."</b></label></center>
                    <label style='font-size:0px' id='lbl".$i."' >".$value['ID']."</label>
                    <center><svg id=".'svg'.$i."></svg></center></div>                   
                    <div style='font-size:12px'><label style='float:left'>".$value['Filler']."</label> <label style='float:right'>".$value['Kategori']."</label><br><center><label>".$value['Kolom']."</label></center><center><label>".$value['BN']."</label></center></div>
                </td>";
            }
            $i++;
        }
        echo $html;
    ?>
</table>
</center>
<?php $this->load->view('template/scripthome');?>
<script src="<?php echo base_url();?>assets/js/JsBarcode.all.min.js"></script>
<script>
    var i=1;
    $('table tbody tr td').each(function() {
        $(this).find('label[id^="lbl"]').each(function() {
            var td =$(this).closest('td');
            var idTran=$(this).text();
            var svg=td.find('svg[id^="svg"]');
            $(svg).JsBarcode(idTran,{width: 1.6,height: 75,fontSize: 14});
        });
        i++;
    });
</script>