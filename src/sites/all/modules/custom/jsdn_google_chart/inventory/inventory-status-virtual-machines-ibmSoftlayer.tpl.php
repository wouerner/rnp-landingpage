<script type="text/javascript">
    (function( $ ) {
        $(document).ready(function(){  
            $(".jc_instance").click(function(){
            $('.loadingTr').remove();
             $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
             var InsID=$(this).attr('insID');
             if($('#data_tr_'+InsID).is(':visible')){ 
                $('#data_tr_'+InsID).remove();
                setTimeout(function(){  }, 3000);
             }else{ 
            $('.inventory_app').remove();
                $(this).html('<img src="/cms/sites/default/files/icons/table-open.gif">');
                $('.'+InsID).after('<tr class="loadingTr"><td colspan="9"><div style="text-align:center"><img src="/cms/sites/default/files/loading.gif" /></div></td></tr>');
                $.post("/cms/sites/all/modules/custom/jsdn_google_chart/inventory/inventory-vm-ibmSoftlayer-resources.php",
                    {
                        instanceID: InsID
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

<div id="inventory_widget10" class="inventory_widget10 widget-container" align='center'>
  <?php
if((count($_SESSION['ibm_softlayer_instances']) == 0) || ($_SESSION['ibm_softlayer_instances'] == null)){
?>  
    <div class="noData" style="height:80px;"><br><br><?php print t('No data available for the selected criteria');?></div>
    <?php
}else {
?>
    <table class="inventoy_table" id="inventoy_table">
        <thead>
            <tr>
                <th colspan="6" class="filter-head">
                <div class="searchInputDiv search-bar">
                    <input name="searchinput" id="searchinput" type="text" placeholder="Search Keyword" class="searchbox floatLeft" size="20" />
                </div>
                <div class="instanceTypeDiv search-bar">
                    <select id="tab_sel"> </select>
                </div>
                <div class="StatusDiv search-bar">
                    <select id="tab_sel"></select>
                </div>
                </th>
            </tr>
            <tr>
                <th id="inven_th1"><?php echo t('Instance Name');?> </th>
                <th id="inven_th"><?php echo t('Instance ID');?> </th>
                <th id="inven_th"><?php echo t('UUID');?> </th>
                <th id="inven_th"><?php echo t('Domain');?> </th>
                <th id="inven_th"><?php echo t('Launched Date & Time');?> </th>
                <th id="inven_th"><?php echo t('Status');?> </th>
            </tr>
        </thead>
                <tbody>
            <?php 
            foreach($_SESSION['ibm_softlayer_instances'] as $k=>$instance){  
                    $instanceName = $instance->fullyQualifiedDomainName;
                ?>
            <tr class="border_bottom <?php echo $instance->id;?>">
                <td> 
                    <span class="jc_instance" ref="<?php echo $instance->id?>" insID="<?php echo $instance->id?>">
                        <img id="jc_instances" src="/cms/sites/default/files/icons/table-close.gif">
                    </span>
                    <span title="<?php echo $instanceName;?>"><?php echo mb_strimwidth( $instanceName, 0, 25 ,"...");?></span>
                </td>
                <td><?php echo $instance->id;?></td>
                <td><?php echo $instance->uuid;?></td>
                <td> <?php echo $instance->domain;?></td>
                <td><script>document.write(moment.utc('<?php echo $instance->createDate;?>').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss'));</script></td>
                <td> <div <?php if($instance->status->keyName=="ACTIVE"){?>class="running_div"<?php }else if($instance->status->keyName=="DISCONNECTED"){?>class="stop_div"<?php }else{?>class="stop_div"<?php }?>> <span class="running_content"> <?php if($instance->status->keyName=="DISCONNECTED"){ echo t('Stopped'); } else{ echo ucfirst(strtolower($instance->status->keyName));}?> </span></div></td> 
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
                col_2: "none",
                col_3:"select",
                col_4: "none",
                col_5: "select",
                display_all_text: '<?php echo t('All');?>',
                sort_select: true,
                paging: true,  
                paging_length: 10,  
                stylesheet: '',
                paging_target_id: 'paginationDiv', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
    var tf2 = setFilterGrid("inventoy_table", Props); 
     $('.instanceTypeDiv select').html($('#flt3_inventoy_table').html());
     $('.StatusDiv select').html($('#flt5_inventoy_table').html());
     $('.instanceTypeDiv select option[value=""]').text("<?php print t('All Domains');?>");
     $('.StatusDiv select option[value=""]').text("<?php print t('All Status');?>");
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
        $('#flt3_inventoy_table').val($(this).val()).change();
    })
    $('.StatusDiv select').change(function(){
        $('.inventory_app').remove();
        $('.loadingTr').remove();
         $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt5_inventoy_table').val($(this).val()).change();
    })
})( jQuery );
</script>