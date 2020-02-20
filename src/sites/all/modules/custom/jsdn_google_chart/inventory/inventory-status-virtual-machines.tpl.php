<script type="text/javascript">
    (function( $ ) {
        $(document).ready(function(){  
            $(".jc_instance").click(function(){
             $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
             var InsID=$(this).attr('insID'); 
             if($('#data_tr_'+InsID).is(':visible')){ 
                $('#data_tr_'+InsID).remove();
                setTimeout(function(){  }, 3000);
             }else{
                $(this).html('<img src="/cms/sites/default/files/icons/table-open.gif">');
                $('.'+InsID).after('<tr class="loadingTr"><td colspan="9"><div style="text-align:center"><img src="/cms/sites/default/files/loading.gif" /></div></td></tr>');
                $.post("/cms/sites/all/modules/custom/jsdn_google_chart/inventory/inventory-vm-resources.php",
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
                    setTimeout(function(){  }, 3000); 
                });
             }              
            }); 
        });  
    })( jQuery );
</script>

<div id="inventory_widget2" class="inventory_widget2 widget-container" align='center'>
  <?php
if((count($_SESSION['instances']) == 0) || ($_SESSION['instances'] == null)){
?>  
    <div class="noData" style="height:80px;"><br><br><?php print t('No data available for the selected criteria');?></div>
    <?php
}else {
?>
    <table class="inventoy_table" id="inventoy_table">
        <thead>
            <tr>
                <th colspan="9" class="filter-head">
                <div class="searchInputDiv search-bar">
                    <input name="searchinput" id="searchinput" type="text" placeholder="<?php print t('Search Instance Name');?>" class="searchbox floatLeft" size="20" />
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
                <th id="inven_th"><?php print t('Launched Date & Time');?> </th>
                <th id="inven_th"><?php print t('Availability Zone');?> </th>
                <th id="inven_th"><?php print t('Key Name');?></th>
                <th id="inven_th"><?php print t('Security Group');?> </th>
                <th id="inven_th"><?php print t('Status');?> </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($_SESSION['instances'] as $k=>$instances){  
                foreach ($instances['Instances'] as $instance) {
                    $instanceName = ''; 
                    foreach ($instance['Tags'] as $tag) {
                        if ($tag['Key'] == 'Name') {
                            $instanceName = $tag['Value'];
                        }
                    } ?>
            <tr class="border_bottom <?php echo $instance['InstanceId'];?>">
                <td> 
                    <span class="jc_instance" ref="<?php echo $instance['InstanceId']?>" insID="<?php echo $instance['InstanceId']?>">
                        <img id="jc_instances" src="/cms/sites/default/files/icons/table-close.gif">
                    </span>
                    <span title="<?php echo $instanceName;?>"><?php echo mb_strimwidth( $instanceName, 0, 25 ,"...");?></span>
                </td>
                <td><?php echo $instance['InstanceId']?></td>
                <td> <?php echo $instance['Platform'] ? $instance['Platform'] : '-'?></td>
                <td><?php echo $instance['InstanceType']?></td>
                <td><script>document.write(moment.utc('<?php echo $instance['LaunchTime'];?>').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss'));</script></td>
                <td><?php echo $instance['Placement']['AvailabilityZone']?></td>
                <td><span title="<?php echo $instance['KeyName']?>"><?php echo mb_strimwidth( $instance['KeyName'], 0, 10 ,"...");?></span></td>
                <td><span title="<?php echo $instance['SecurityGroups'][0]['GroupName'] ?>"><?php echo mb_strimwidth( $instance['SecurityGroups'][0]['GroupName'], 0, 20, "...") ?></span></td>
                <td> <div <?php if($instance['State']['Name']=="running"){?>class="running_div"<?php }else if($instance['State']['Name']=="terminated"){?>class="terminated_div"<?php }else{?>class="stop_div"<?php }?>> <span class="running_content"> <?php echo $instance['State']['Name']?> </span></div></td> 
            </tr> 
            <?php }}?> 
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
                col_5:"select",
                col_6:"none",
                col_7:"none",
                col_8:"select",
                display_all_text: "<?php print t('All');?>",
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
     $('.ZoneDiv select').html($('#flt5_inventoy_table').html());
     $('.StatusDiv select').html($('#flt8_inventoy_table').html());
     $('.instanceTypeDiv select option[value=""]').text("<?php print t('All Instances');?>");
     $('.ZoneDiv select option[value=""]').text("<?php print t('All Zones');?>");
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
    $('.ZoneDiv select').change(function(){
        $('.inventory_app').remove();
        $('.loadingTr').remove();
         $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt5_inventoy_table').val($(this).val()).change();
    })
    $('.StatusDiv select').change(function(){
        $('.inventory_app').remove();
        $('.loadingTr').remove();
         $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt8_inventoy_table').val($(this).val()).change();
    })
})( jQuery );
</script>