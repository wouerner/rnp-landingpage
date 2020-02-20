<script type="text/javascript">
    (function( $ ) {
        $(document).ready(function(){
            $( ".menu-1941" ).parent("li").addClass( "active" );
            $(".jc_instance").click(function(){ 
            var ref=$(this).attr('ref');
            $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
            $(this).html(''); 
            $('.row_'+ref).after('<tr class="loadingTr"><td colspan="9"><div style="text-align:center"><img src="/cms/sites/default/files/loading.gif" /></div></td></tr>');
            if($('.detail_row_'+ref+'').length > 0){ 
                $('.detail_row_'+ref+'').remove(); 
                $('.loadingTr').remove();
                $(this).append('<img src="/cms/sites/default/files/icons/table-close.gif">');
            }else{ 
                $('tr[class^="detail_row_"]').remove();
                $(this).append('<img src="/cms/sites/default/files/icons/table-open.gif">');
                $('.loadingTr').remove();
                $('.row_'+ref).after('<tr class="detail_row_'+ref+' border_bottom"><td colspan="9">'+$('.instance_detail_0').html()+'</td></tr>'); 
            }
            setTimeout(function(){  }, 3000); 
            }); 
        });
    })( jQuery );
    </script> 

<div id="inventory_widget3" class="inventory_widget widget-container" align='center'>
<?php
if(($_SESSION['accessKey'] != '') && ($_SESSION['secretKey'] != '') && ($_SESSION['inventory_region'] != '')){
    if(empty($_SESSION['reservations'])){
        $path = drupal_get_path('module', 'jsdn_google_chart'). '/lib/aws/config.php';
        include ($path);
			    try{
        $result = $ec2Client->DescribeReservedInstances(array());
    } catch (Exception $ex) {
		?>
        <script type="text/javascript">
        jQuery("#inventory_widget3").html('<div class="noData"><?php print t('Not able to get the data currently. Please contact support.');?></div>');
        </script>
    <?php
		watchdog('jsdn_inventory', 'Reservation Response %exception.', array('%exception' => json_encode($ex)));
        return;
    }
        $reservations = $result['ReservedInstances'];
        $_SESSION['reservations']=$reservations;
    }

if(count($_SESSION['reservations']) == 0){
?>  
    <div class="noData" style="height:80px;"><br><br><?php print t('No data available for the selected criteria');?></div>
    <?php
}else {
?>
    <table class="inventoy_table" id="inventoy_table">
        <thead>
            <tr>
                <th colspan="9" class="filter-head"> 
                    <div class="instanceTypeDiv search-bar">
                        <select id="tab_sel"> </select>
                    </div>
                    <div class="ZoneDiv search-bar">
                        <select id="tab_sel"></select>
                    </div>
                    <div class="PlatformDiv search-bar">
                        <select id="tab_sel"></select>
                    </div>
                </th>
            </tr>
            <tr>
                <th id="inven_th1"><?php print t('Instance Type');?> </th>
                <th id="inven_th"><?php print t('Availability Zone');?></th>
                <th id="inven_th"><?php print t('Start Date & Time');?> </th>
                <th id="inven_th"><?php print t('End Date & Time');?></th>
                <th id="inven_th"><?php print t('Term');?> </th>
                <th id="inven_th"><?php print t('Instance Count');?></th>
                <th id="inven_th"><?php print t('Recurring Charge');?></th>
                <th id="inven_th"><?php print t('Platform');?></th>
                <th id="inven_th"><?php print t('Status');?> </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($_SESSION['reservations'] as $k=>$reservations){  
                ?>
            <tr class="border_bottom row_<?php echo $k?>">
                <td> 
                    <span class="jc_instance" ref="<?php echo $k?>" insID="<?php echo $reservations['ReservedInstancesId']?>">
                        <img id="jc_instances" src="/cms/sites/default/files/icons/table-close.gif">
                    </span>
                    <?php echo $reservations['InstanceType']?>
                </td>
                <td><?php echo $reservations['AvailabilityZone']?></td>
                <td><script>document.write(moment.utc('<?php echo $reservations['Start'];?>').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss'));</script></td>
                <td><script>document.write(moment.utc('<?php echo $reservations['End']?>').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss'));</script></td>
                <td><?php echo $reservations['Duration'] ? floor($reservations['Duration']/2592000).' Months' : '';?></td>
                <td><?php echo $reservations['InstanceCount']?></td>
                <td><?php echo $reservations['RecurringCharges'][0]['Frequency'] .': '. $reservations['CurrencyCode']. ' ' . $reservations['RecurringCharges'][0]['Amount']?></td>
                <td><?php echo $reservations['ProductDescription']?></td>
                <td> <div <?php if($reservations['State']=="active"){?>class="running_div"<?php }else if($reservations['State']=="terminated"){?>class="terminated_div"<?php }else{?>class="stop_div"<?php }?>> <span class="running_content"> <?php echo $reservations['State']?> </span></div>

                    <div class="instance_detail_<?php echo $k?>" style="display: none;">
                    <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Reserved Instance ID');?>:</span> <?php echo $reservations['ReservedInstancesId']?></p>
                    <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Payment Option');?>:</span> <?php echo $reservations['OfferingType']?></p>
                    <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Usage Price');?>:</span> <?php echo $reservations['UsagePrice']?></p>
                    <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Offering Class');?>:</span> <?php echo $reservations['OfferingClass']?></p>
                    <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Tenancy');?>:</span> <?php echo $reservations['InstanceTenancy']?></p>
                    </div>
                </td> 
               
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
                col_0: "select",
                col_1: "select",
                col_2: "none",
                col_3:"none",
                col_4: "none",
                col_5:"none",
                col_6:"none",
                col_7:"select",
                col_8:"none",
                display_all_text: Drupal.t("All"),
                sort_select: true,
                paging: true,  
                paging_length: 10, 
                filters_row_index: 2,
                stylesheet: '',
                paging_target_id: 'paginationDiv', 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }				
            };  
    var tf2 = setFilterGrid("inventoy_table", Props); 
     $('.instanceTypeDiv select').html($('#flt0_inventoy_table').html());
     $('.ZoneDiv select').html($('#flt1_inventoy_table').html());
     $('.PlatformDiv select').html($('#flt7_inventoy_table').html());
     $('.instanceTypeDiv select option[value=""]').text(Drupal.t("All Instances"));
     $('.ZoneDiv select option[value=""]').text(Drupal.t("All Zones"));
     $('.PlatformDiv select option[value=""]').text(Drupal.t("All Pllatforms"));
    
    $('.instanceTypeDiv select').change(function(){
        $('tr[class^="detail_row_"]').remove();
        $('.loadingTr').remove();
        $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt0_inventoy_table').val($(this).val()).change();
    })
    $('.ZoneDiv select').change(function(){
        $('tr[class^="detail_row_"]').remove();
        $('.loadingTr').remove();
        $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt1_inventoy_table').val($(this).val()).change();
    })
    $('.PlatformDiv select').change(function(){
        $('tr[class^="detail_row_"]').remove();
        $('.loadingTr').remove();
        $(".jc_instance img").attr({'src':'/cms/sites/default/files/icons/table-close.gif'});
        $('#flt7_inventoy_table').val($(this).val()).change();
    })
})( jQuery );	
</script>