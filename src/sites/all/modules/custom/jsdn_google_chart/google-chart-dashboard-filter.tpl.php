<?php
$timeoffset = json_decode($_SESSION['MenuJSON'])->locale->offset;
$info = date('Y-m-d H:i:s');
if((arg(1) != 'inventory') && (arg(1) != 'saas') && (arg(1) != 'recommendation') && (arg(1) != 'migration')){
$company_acronym_list = $company_acronym;
if(arg(1) == 'reservation'){
    //Restricting providers to only aws and azure for RI dashboard
    $filters_reservation = array('aws','MicrosoftAzureCsp', 'MicrosoftAzurePayg');
    foreach ($filter_type as $filter){ 
        if(in_array($filter['key'], $filters_reservation)) {
            $filters[] = $filter;
        }
    }
}
else{
    $filters = $filter_type;
}
?>
<?php if(!empty($company_acronym_list)) { ?>
<select id="company_acronym" style="float: left;">
    <?php if(count($company_acronym_list) > 1) {?>
        <?php if((arg(1) != 'reservation')) {?>
        <option value="All"><?php print t('All Customers');?></option>
        <?php } ?>
    <?php } ?>
    <?php  foreach ($company_acronym_list as $acronym_list){ ?>
     <option value="<?php echo $acronym_list['key'];?>"><?php echo $acronym_list['value'];?></option>
    <?php }?>
</select>
<?php } ?>
<div id="loading" style="display:none;" class="loading loadingProvider"></div>
<?php if(arg(1) != 'microsoft-ea') { ?>
<select id="spend_provider">   
    <?php if((arg(1) != 'reservation')) {?>
        <option value="All"><?php print t('All Providers');?></option>
     <?php } ?>
    <?php  foreach ($filters as $providers){ ?>
     <option value="<?php echo $providers['key'];?>"><?php echo $providers['value'];?></option>
    <?php }?>
</select>
<?php }else{ ?>
<select id="spend_provider">           
    <?php  foreach ($filters as $providers){ ?>
    <?php  if($providers['key'] == 'microsoftea') { ?>
     <option value="<?php echo $providers['key'];?>"><?php echo $providers['value'];?></option>
    <?php }}?>
</select>
<?php } ?>
<input id="spend_time" name="dateRange">
<button class="applyBtn btn apply-success" type="button"><?php print t('Apply');?></button>

<script type="text/javascript">
var filters = '<?php echo json_encode($filters); ?>';
var timeoffset = '<?php echo $timeoffset ?>';
var curdate = '<?php echo $info ?>';
var selectedProvider;
var selectedAcronym;

var sessionDate = localStorage.getItem('selectedDate');
    (function( $ ) {
        $( document ).ready(function() { 
            if(sessionDate){
                var selectedDate = sessionDate.split(" - ");
                start = selectedDate[0];
                end =  selectedDate[1];
            }else{
                start = moment.utc(curdate).utcOffset(timeoffset).startOf('month');
                //start = moment().utcOffset(timeoffset).startOf('month'); 
                end = moment.utc(curdate).utcOffset(timeoffset);
                //end = moment().utcOffset(timeoffset);
            }
            var endRange = moment.utc(curdate).utcOffset(timeoffset);
            selectedProvider = localStorage.getItem('selectedProvider');
            selectedAcronym = localStorage.getItem('selectedAcronym');
            $('#spend_provider').val(selectedProvider).attr("selected", "selected");
            $('#company_acronym').val(selectedAcronym).attr("selected", "selected");
            company_acronym = $("#company_acronym").val();
            provider = $("#spend_provider").val();
            function cb(start, end) {
                if(sessionDate){
                    jQuery('#spend_time').html(start + ' - ' + end);
                    startdate = moment(start, "DD-MM-YYYY").format('YYYYMMDD');
                    enddate = moment(end, "DD-MM-YYYY").format('YYYYMMDD');
                }else{
                    jQuery('#spend_time').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    startdate = start.format('YYYYMMDD');
                    enddate = end.format('YYYYMMDD');
                }
            } 
            jQuery('#spend_time').daterangepicker({
                "alwaysShowCalendars": true,
                "opens": "left",
                "showCustomRangeLabel": false,
                "startDate": start,
                "endDate": end,
                "maxDate": endRange,
                "autoApply": true,
                "ranges": {'<?php echo t('Year to date')?>': [ moment.utc(curdate).utcOffset(timeoffset).startOf('year'), endRange] }, 
                "dateLimit": {"days": 91 },
                "locale": {
                    "format": 'DD-MM-YYYY',
                    "applyLabel": "<?php echo t("Select")?>",
                    "cancelLabel": "<?php echo t("Cancel")?>",
                    "fromLabel": "<?php echo t("From")?>",
                    "toLabel": "<?php echo t("To")?>",
                    "customRangeLabel": "<?php echo t("Custom")?>",
                    "weekLabel": "<?php echo t("W")?>",
                    "daysOfWeek": [
                        "<?php echo t("Su")?>",
                        "<?php echo t("Mo")?>",
                        "<?php echo t("Tu")?>",
                        "<?php echo t("We")?>",
                        "<?php echo t("Th")?>",
                        "<?php echo t("Fr")?>",
                        "<?php echo t("Sa")?>",
                    ],
                    "monthNames": [
                        "<?php echo t("Jan")?>",
                        "<?php echo t("Feb")?>",
                        "<?php echo t("Mar")?>",
                        "<?php echo t("Apr")?>",
                        "<?php echo t("May")?>",
                        "<?php echo t("Jun")?>",
                        "<?php echo t("Jul")?>",
                        "<?php echo t("Aug")?>",
                        "<?php echo t("Sep")?>",
                        "<?php echo t("Oct")?>",
                        "<?php echo t("Nov")?>",
                        "<?php echo t("Dec")?>",
                    ],
                },
            }, cb);
    
            cb(start, end);
			
        $( ".applyBtn" ).click(function() {
            product_cost_trend = '';
            vm_count_by_tag_key = '';
            vm_cost_by_tag_key = '';
            tag_cost_trend = '';
            instance_cost_by_tags = '';
            product_cost_by_tags = '';
            tag_cost_trend_tag_value = '';
            instance_cost_tags_by_value = '';
            product_cost_by_tag_value = '';
            tag_cost_trend_tag_value = '';
            instance_cost_tags_by_value = '';
            product_cost_by_tag_value = '';
            provider_val = $("#spend_provider").val();
            company_acronym = $("#company_acronym").val();
            $(".overallCost-Left").hide();
            $( ".executivePercent" ).hide();
            $('.widgetDotMenu').hide();
            reset = true;
            change_chart = true;
            if(pageType != 'migration'){
                localStorage.setItem('selectedDate', $('#spend_time').val());
            }
            localStorage.setItem('selectedProvider', $('#spend_provider').val());
            localStorage.setItem('selectedAcronym', $('#company_acronym').val());
            selectedProvider = localStorage.getItem('selectedProvider');
            selectedAcronym = localStorage.getItem('selectedAcronym');
            
            if (provider_val != '') {
                provider = provider_val;
            }
            else{
                provider = Drupal.settings.jsdn_google_chart.provider;
            }
            var numItems = jQuery('div#homebox div.homebox-column-wrapper').length;
            for(var i=1;i<=numItems;i++){
                $("#spend_provider_selected"+i).val($("#spend_provider_selected"+ i+" option:first").val());
            }
            spend_provider_refresh_all_widget();
        });
        if(pageType === 'microsoft-ea'){
            var acronym = $("#company_acronym").val();
            localStorage.setItem('selectedDate', $('#spend_time').val());
            localStorage.setItem('selectedProvider', $('#spend_provider').val());
            localStorage.setItem('selectedAcronym', $('#company_acronym').val());
            var type = 'iaas-providers';
            var fields = {type : type, company_acronym: acronym};
            jQuery.ajax({  
                type: "POST",  
                url: '/cms/jsdnConnect/chartAPI.php',
                data: fields,
                dataType: 'json',
                beforeSend: function(){
                        $("#spend_provider").hide();
                        $(".applyBtn").hide();
                        $("#spend_time").hide();
                        $("#loading").css('display','block');
                },
                error: function(){
                        $("#spend_provider").hide();
                        $("#spend_time").hide();
                        $(".applyBtn").hide();
                        $("#loading").css('display','block');
                },
                success: function(chart_result) {
                    $("#loading").css('display','none');
                    $('#spend_provider').find('option').remove().end();
                    $("#spend_provider").show();
                    $("#spend_time").show();
                    $(".applyBtn").show();
                    if(pageType != 'microsoft-ea'){
                        $('<option/>', {
                            'value': 'All',
                            'text': '<?php print t("All Providers");?>',
                        }).appendTo('#spend_provider');
                    }
                    if(Object.keys(chart_result).length){
                        if(pageType === 'microsoft-ea'){
                            jQuery.each(chart_result, function(i, item) {
                                if(item.key === 'microsoftea'){
                                    $('<option/>', {
                                        'value': item.key,
                                        'text': item.value
                                    }).appendTo('#spend_provider');
                                }
                            });
                            provider = $("#spend_provider").val();
                            spend_provider_refresh_all_widget();
                        }else{
                            jQuery.each(chart_result, function(i, item) {
                                $('<option/>', {
                                        'value': item.key,
                                        'text': item.value
                                }).appendTo('#spend_provider');
                            });
                        }
                    }
                }
            });
        }
        
        $( "#company_acronym" ).change(function() {
            var acronym = $("#company_acronym").val();
            localStorage.setItem('selectedDate', $('#spend_time').val());
            localStorage.setItem('selectedProvider', $('#spend_provider').val());
            localStorage.setItem('selectedAcronym', $('#company_acronym').val());
            var type = 'iaas-providers';
            var fields = {type : type, company_acronym: acronym};
            jQuery.ajax({  
                type: "POST",  
                url: '/cms/jsdnConnect/chartAPI.php',
                data: fields,
                dataType: 'json',
                beforeSend: function(){
                    $("#spend_provider").hide();
                    $(".applyBtn").hide();
                    $("#spend_time").hide();
                    $("#loading").css('display','block');
                },
                error: function(){
                    $("#spend_provider").hide();
                    $("#spend_time").hide();
                    $(".applyBtn").hide();
                    $("#loading").css('display','block');
                },
                success: function(chart_result) {
                    $("#loading").css('display','none');
                    $('#spend_provider').find('option').remove().end();
                    $("#spend_provider").show();
                    $("#spend_time").show();
                    $(".applyBtn").show();
                    if(pageType != 'microsoft-ea' && pageType != 'reservation'){
                        $('<option/>', {
                            'value': 'All',
                            'text': '<?php print t("All Providers");?>',
                        }).appendTo('#spend_provider');
                    }
                    if(Object.keys(chart_result).length){
                        if(pageType === 'microsoft-ea'){
                            jQuery.each(chart_result, function(i, item) {
                                if(item.key === 'microsoftea'){
                                    $('<option/>', {
                                        'value': item.key,
                                        'text': item.value
                                    }).appendTo('#spend_provider');
                                }
                            });
                        }
                        else if(pageType === 'reservation'){
                            jQuery.each(chart_result, function(i, item) {
                                if((item.key === 'aws') || (item.key === 'MicrosoftAzureCsp') || (item.key === 'MicrosoftAzurePayg')){
                                    $('<option/>', {
                                        'value': item.key,
                                        'text': item.value
                                    }).appendTo('#spend_provider');
                                }
                            });
                        }else{
                            jQuery.each(chart_result, function(i, item) {
                                $('<option/>', {
                                        'value': item.key,
                                        'text': item.value
                                }).appendTo('#spend_provider');
                            });
                        }
                    }
                }
            });
        });
        
    });
})( jQuery );
</script>
<?php
} 
elseif(arg(1) == 'saas'){
$company_acronym_list = $company_acronym;
?>
<?php if(!empty($company_acronym_list)) { ?>
<select id="company_acronym" style="float: left;margin-right: 10px;">
    <?php if(count($company_acronym_list) > 1) {?>
    <option value="All"><?php print t('All Customers');?></option>
    <?php } ?>
    <?php  foreach ($company_acronym_list as $acronym_list){ ?>
     <option value="<?php echo $acronym_list['key'];?>"><?php echo $acronym_list['value'];?></option>
    <?php }?>
</select>
<button class="applyBtn btn apply-success" type="button"><?php print t('Apply');?></button>
<?php } ?>
<script type="text/javascript">
var timeoffset = '<?php echo $timeoffset ?>';
var curdate = '<?php echo $info ?>';

    (function( $ ) {
        $( document ).ready(function() { 
        company_acronym = $("#company_acronym").val();
        $( ".applyBtn" ).click(function() {
            company_acronym = $("#company_acronym").val();
            spend_provider_refresh_all_widget();
        });					
    });
})( jQuery );	
</script>
<?php 
}
elseif(arg(1) == 'migration'){
?>
<script type="text/javascript">
var timeoffset = '<?php echo $timeoffset ?>';
var ldate = '<?php echo $_SESSION['start_date_migration']  ?>';
var curdate = '<?php echo $info ?>';
var lastdate = moment.utc(ldate).utcOffset(timeoffset);
var todayDate = moment.utc(curdate).utcOffset(timeoffset);
startdate = lastdate.format('YYYYMMDD');
enddate = todayDate.format('YYYYMMDD');
</script>
<?php
}
else{ 
$filters = $filter_type;
$region = $regions;
$resources = $resource_group;
$zones = $resource_zones;
print drupal_render(drupal_get_form('inventory_block_search_form', $filters, $region, $resources, $zones));
?> 
<script type="text/javascript">
var timeoffset = '<?php echo $timeoffset ?>';
(function( $ ) {
    $( document ).ready(function() { 
        var inventory_type = $("#edit-inventory-type").val();
        if(inventory_type){
            var type = inventory_type.split(' - ');
            var azure_groups = ['MicrosoftAzureCsp', 'MicrosoftAzurePayg'];
            var azure_index = azure_groups.indexOf(type[0]);
            if((azure_index != -1) && (pageType == 'inventory')){
                 $(".menu-1946").hide();
                 $(".form-item-inventory-resources").show();
                 $(".form-item-inventory-region").hide();
                 $(".form-item-inventory-zones").hide();
            }
            else if(type[0] == 'googlecloud' && pageType == 'inventory'){
                 $(".menu-1946").hide();
                 $(".form-item-inventory-resources").hide();
                 $(".form-item-inventory-region").hide();
                 $(".form-item-inventory-zones").show();
            }
            else if(type[0] == 'ibmsoftlayer' && pageType == 'inventory'){
                 $(".menu-1946").hide();
                 $(".form-item-inventory-resources").hide();
                 $(".form-item-inventory-region").hide();
                 $(".form-item-inventory-zones").hide();
            }
            else if(type[0] == 'aws'){
                 $(".form-item-inventory-resources").hide();
                 $(".form-item-inventory-zones").hide();
                 $(".form-item-inventory-region").show();
            }
            else{
                 $(".form-item-inventory-resources").hide();
                 $(".form-item-inventory-zones").hide();
                 $(".form-item-inventory-region").hide();
            }
        }
        $( "#edit-inventory-type" ).change(function() {
            inventory_type = $("#edit-inventory-type").val();
           
            if(inventory_type){
                type = inventory_type.split(' - ');
                var azure_groups = ['MicrosoftAzureCsp', 'MicrosoftAzurePayg'];
                var azure_index = azure_groups.indexOf(type[0]);
                if(type[0] == 'aws'){
                    $(".menu-1946").show();
                    $("#edit-inventory-region").show();
                    $("#edit-inventory-resources").hide();
                    $("#edit-inventory-zones").hide();
                    $(".form-item-inventory-resources").hide();
                    $(".form-item-inventory-region").show();
                    $(".form-item-inventory-zones").hide();
                    $(".applyInventoryBtn").show();
                }
                else if(type[0] == 'ibmsoftlayer' && pageType == 'inventory'){
                    $(".menu-1946").hide();
                    $("#edit-inventory-region").hide();
                    $("#edit-inventory-resources").hide();
                    $("#edit-inventory-zones").hide();
                    $(".form-item-inventory-resources").hide();
                    $(".form-item-inventory-region").hide();
                    $(".form-item-inventory-zones").hide();
                    $(".applyInventoryBtn").show();
                }
                else if((azure_index != -1) && (pageType == 'inventory')){
                    $("#edit-inventory-resources").show();
                    $("#edit-inventory-zones").hide();
                    $(".form-item-inventory-region").hide();
                    $(".form-item-inventory-zones").hide();
                    $(".menu-1946").hide();
                    var fields = {linkedAccountId: type[1], providerCode : type[0]};
                    jQuery.ajax({  
                        type: "POST",  
                        url: '/cms/jsdnDashboard/azure/data',
                        data: fields,
                        dataType: 'json',
                        beforeSend: function(){
                            $("#edit-inventory-resources").hide();
                            $("#edit-inventory-region").hide();
                            $(".applyInventoryBtn").hide();
                            $(".form-item-inventory-resources").hide();
                            $("#loading").css('display','block');
                        },
                        error: function(){
                            $("#edit-inventory-resources").hide();
                            $("#edit-inventory-region").hide();
                            $(".form-item-inventory-resources").hide();
                            $("#loading").css('display','block');
                        },
                        success: function(chart_result) {
                            $("#loading").css('display','none');
                            if(Object.keys(chart_result).length){
                                $(".form-item-inventory-resources").show();
                                $("#edit-inventory-resources").show();
                                $('#edit-inventory-resources').find('option').remove().end();
                                $(".applyInventoryBtn").show();
                                jQuery.each(chart_result, function(i, item) {
                                    $('<option/>', {
                                        'value': i,
                                        'text': item
                                    }).appendTo('#edit-inventory-resources');
                                });
                            }
                        }
                    });
                }
                else if(type[0] == 'googlecloud' && pageType == 'inventory'){
                    
                    $("#edit-inventory-region").hide();
                    $("#edit-inventory-resources").hide();
                    $("#edit-inventory-zones").show();
                    $(".form-item-inventory-resources").hide();
                    $(".form-item-inventory-region").hide();
                    $(".form-item-inventory-zones").show();
                    $(".menu-1946").hide();
                    var fields = {linkedAccountId: type[1], providerCode : type[0]};
                    jQuery.ajax({  
                        type: "POST",  
                        url: '/cms/jsdnDashboard/googlecloud/data',
                        data: fields,
                        dataType: 'json',
                        beforeSend: function(){
                            $("#loading").css('display','block');
                            $(".form-item-inventory-resources").hide();
                            $(".form-item-inventory-region").hide();
                            $(".form-item-inventory-zones").hide();
                            $(".applyInventoryBtn").hide();
                        },
                        error: function(){
                            $(".form-item-inventory-resources").hide();
                            $(".form-item-inventory-region").hide();
                            $(".form-item-inventory-zones").hide();
                            $(".applyInventoryBtn").hide();
                            $("#loading").css('display','block');
                        },
                        success: function(chart_result) {
                            $("#loading").css('display','none');
                            if(Object.keys(chart_result).length){
                                $(".form-item-inventory-zones").show();
                                $("#edit-inventory-zones").show();
                                $('#edit-inventory-zones').find('option').remove().end();
                                $(".applyInventoryBtn").show();
                                jQuery.each(chart_result, function(i, item) {
                                    $('<option/>', {
                                        'value': i,
                                        'text': item
                                    }).appendTo('#edit-inventory-zones');
                                });
                            }
                        }
                    });

                }
                else{
                    $(".menu-1946").show();
                    $("#edit-inventory-region").hide();
                    $("#edit-inventory-resources").hide();
                    $("#edit-inventory-zones").hide();
                    $(".form-item-inventory-resources").hide();
                    $(".form-item-inventory-region").hide();
                    $(".form-item-inventory-zones").hide();
                    $(".applyInventoryBtn").show();
                }
            }
        });
    });
})( jQuery );
</script>
<?php } ?> 