<script type="text/javascript">
    (function( $ ) {
        $(document).ready(function(){  
            $(".jc_instance").click(function(){
            $('.loadingTr').remove();
             $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
             var InsID=$(this).attr('insID');
             var network_ip=$(this).attr('network_ip');
             if($('#data_tr_'+InsID).is(':visible')){ 
                $('#data_tr_'+InsID).remove();
                setTimeout(function(){  }, 3000);
             }else{ 
            $('.inventory_app').remove();
                $(this).html('<img src="/cms/sites/default/files/icons/table-open.gif">');
                $('.'+InsID).after('<tr class="loadingTr"><td colspan="9"><div style="text-align:center"><img src="/cms/sites/default/files/loading.gif" /></div></td></tr>');
                $.post("/cms/sites/all/modules/custom/jsdn_google_chart/inventory/inventory-vm-azure-resources.php",
                    {
                        instanceID: InsID,
                        network_ip: network_ip
                    },
                function(data, status){ 
                    $('.inventory_app').remove();
                    $('.loadingTr').remove();
                    if($('#data_tr_'+InsID).is(':visible')){
                        $('#data_tr_'+InsID).css({'display':'none'});
                    }else{
                        $('tr.'+InsID).after(data);
                    } 
                });
                setTimeout(function(){  }, 3000); 
             }              
            }); 
        });  
    })( jQuery );
</script>

<div id="inventory_widget5" class="inventory_widget5 widget-container" align='center'>
  <?php
if(count($_SESSION['inventory_azure_resources']) == 0){
?>  
    <div class="noData" style="height:80px;"><br><br><?php print t('No data available for the selected criteria');?></div>
    <?php
}else {
?>
    <table class="inventoy_table" id="inventoy_table">
        <thead>
            <tr>
                <th colspan="5" class="filter-head">
                <div class="searchInputDiv search-bar">
                    <input name="searchinput" id="searchinput" type="text" placeholder="Search Keyword" class="searchbox floatLeft" size="20" />
                </div>
                <div class="instanceTypeDiv search-bar">
                    <select id="tab_sel"> </select>
                </div>
                <div class="ZoneDiv search-bar">
                    <select id="tab_sel"></select>
                </div>
                <div class="StatusDiv search-bar">
                    <select id="tab_sel"></select>
                </div>
                </th>
            </tr>
            <tr>
                <th id="inven_th1"><?php print t('Instance Name');?> </th>
                <th id="inven_th"><?php print t('Instance ID');?> </th>
                <th id="inven_th"><?php print t('Platform');?> </th>
                <th id="inven_th"><?php print t('Instance Type');?> </th>
                <th id="inven_th"><?php print t('Location');?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($_SESSION['inventory_azure_resources'] as $k=>$instances){ 
                    $network_ip = $instances['properties']['networkProfile']['networkInterfaces'][0]['id'];
                    $instanceName = $instances['name']; 
                    $vmId = $instances['properties']['vmId'];
            ?>
            <tr class="border_bottom <?php echo $instanceName;?>">
                <td> 
                    <span class="jc_instance" ref="<?php echo $instanceName?>" insID="<?php echo $instanceName?>" network_ip="<?php echo $network_ip?>">
                        <img id="jc_instances" src="/cms/sites/default/files/icons/table-close.gif">
                    </span>
                    <span title="<?php echo $instanceName;?>"><?php echo mb_strimwidth( $instanceName, 0, 25 ,"...");?></span>
                </td>
                <td><?php echo $vmId?></td>
                <td><?php echo $instances['properties']['storageProfile']['osDisk']['osType'] ? $instances['properties']['storageProfile']['osDisk']['osType'] : '-'?></td>
                <td><?php echo $instances['properties']['hardwareProfile']['vmSize'];?></td>
                <td><?php echo $instances['location'];?></td>
            </tr> 
            <?php }?> 
        </tbody>
    </table> 
    <div id="paginationDiv"></div>
</div>
    <?php
}
?>
<script type="text/javascript">
(function( $ ) {
    var Props = {
                col_1: "none",
                col_2: "select",
                col_3:"select",
                col_4: "select",
                col_5:"none",
                display_all_text: Drupal.t("All"),
                sort_select: true,
                paging: true,  
                paging_length: 10,  
                stylesheet: '',
                paging_target_id: 'paginationDiv', 
                filters_row_index: 2, 
                on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ },
                };  
    var tf2 = setFilterGrid("inventoy_table", Props); 
     $('.instanceTypeDiv select').html($('#flt2_inventoy_table').html()); 
     $('.ZoneDiv select').html($('#flt3_inventoy_table').html());
     $('.StatusDiv select').html($('#flt4_inventoy_table').html());
     $('.instanceTypeDiv select option[value=""]').text(Drupal.t('All Platform'));
     $('.ZoneDiv select option[value=""]').text(Drupal.t('All Instances'));
     $('.StatusDiv select option[value=""]').text(Drupal.t('All Location'));
    $('#searchinput').change(function(){
        $('#flt0_inventoy_table').val($(this).val());
        $('.inventory_app').remove();
        $('.loadingTr').remove();
        $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt0_inventoy_table').keyup();
    })
    $('.instanceTypeDiv select').change(function(){
        $('.inventory_app').remove();
        $('.loadingTr').remove();
         $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt2_inventoy_table').val($(this).val()).change();
    })
    $('.ZoneDiv select').change(function(){
        $('.inventory_app').remove();
        $('.loadingTr').remove();
         $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt3_inventoy_table').val($(this).val()).change();
    })
    $('.StatusDiv select').change(function(){
        $('.inventory_app').remove();
        $('.loadingTr').remove();
         $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt4_inventoy_table').val($(this).val()).change();
    })
})( jQuery );
</script>