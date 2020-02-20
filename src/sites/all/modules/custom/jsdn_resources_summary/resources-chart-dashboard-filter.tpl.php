<?php
if((arg(0) == 'resource-summary')){
?>
<select id="resources_provider">           
    <option value="All"><?php print t('All Providers');?></option>
    <?php  foreach ($provider_type as $providers){ ?>
     <option value="<?php echo $providers['key'];?>"><?php echo $providers['datafeedData'][0]['key']." - ".$providers['datafeedData'][0]['value'];?></option>
    <?php }?>
</select>
<div id="loading" style="display:none;" class="loading loaderDiv"></div>
<?php if(!empty($resources_regions)) { ?>
<select id="resources_regions" class="formMediumTxtBox actionDropDown" multiple="true">
    <?php if(count($resources_regions) > 1) {?>
    <?php } ?>
    <?php  foreach ($resources_regions as $key=>$acronym_list){ ?>
     <option value="<?php echo $acronym_list['datafeedData'][0]['key'];?>"><?php echo $acronym_list['datafeedData'][0]['value'];?></option>
    <?php }?>
</select>
<?php } ?>
<button class="applyBtn btn apply-success" type="button"><?php print t('Apply');?></button>
<script type="text/javascript">
    var filters = '<?php echo json_encode($provider_type); ?>';
    var resourcesProvider;
    var resourcesRegions;
    (function( $ ) {
        $( document ).ready(function() {
            resourcesProvider = localStorage.getItem('resourcesProvider');
            resourcesRegions = localStorage.getItem('resourcesRegions');
            $('#resources_provider').val(resourcesProvider).attr("selected", "selected");
            if(resourcesRegions){
                var selectedOptions = resourcesRegions.split(",");
                for(var i in selectedOptions) {
                    var optionVal = selectedOptions[i];
                    $("#resources_regions").multiselect("widget").find(":checkbox[value='"+optionVal+"']").attr("checked","checked");
                    $("#resources_regions option[value='" + optionVal + "']").attr("selected", 1);
                    $("#resources_regions").multiselect("refresh");
                }
            }
            
        $( ".applyBtn" ).click(function() {
            location.reload();
            localStorage.setItem('resourcesProvider', $('#resources_provider').val());
            localStorage.setItem('resourcesRegions', $('#resources_regions').val());
            resourcesProvider = localStorage.getItem('resourcesProvider');
            resourcesRegions = localStorage.getItem('resourcesRegions');
            
            resources_regions_val = localStorage.getItem('resourcesRegions');
            resources_provider_val = localStorage.getItem('resourcesProvider');
            if (resources_provider_val != '') {
                resources_provider = resources_provider_val;
            }
            else{
                resources_provider = Drupal.settings.jsdn_resources_chart.provider;
            }
            
            if (resources_regions_val != null) {
                resources_regions = resources_regions_val.join("&");
            }
            else{
                resources_regions = Drupal.settings.jsdn_resources_chart.regions;
            }

        }); 
        
        $( "#resources_provider" ).change(function() {
            resources_provider = $("#resources_provider").val();
            var type = 'resources-regions';
            var fields = {type : type, provider: resources_provider};
            jQuery.ajax({  
                    type: "POST",  
                    url: '/cms/sites/all/modules/custom/jsdn_resources_summary/api/resourcesAPI.php',
                    data: fields,
                    dataType: 'json',
                    beforeSend: function(){
                        $("#loading").css('display','block');
                        $('#resources_provider').addClass('onloading');
                        $(".ui-multiselect").hide();
                        $(".applyBtn").hide();
                    },
                    error: function(){
                        $(".ui-multiselect").hide();
                        $(".applyBtn").hide();
                        $("#loading").css('display','block');
                    },
                    success: function(chart_result) {
                        $("#loading").css('display','none');
                        $('#resources_provider').removeClass('onloading');
                        localStorage.setItem('resourcesProvider', $('#resources_provider').val());
                        localStorage.setItem('resourcesRegions', '');
                        if(Object.keys(chart_result).length){
                            $(".ui-multiselect").show();
                            $('#resources_regions').find('option').remove().end();
                            $(".applyBtn").show();
                            jQuery.each(chart_result, function(i, item) {
                                $('<option/>', {
                                    'value': item.key,
                                    'text': item.value
                                }).appendTo('#resources_regions');
                            });
                        }
                        $("#resources_regions").multiselect('destroy');
                        $('#resources_regions').multiselect(this.options);
                        $("#resources_regions").multiselect({header: false,minWidth: "auto",height:"auto",selectedText: '# Regions Selected',noneSelectedText: 'Select Regions'});
                    }
                 });
        });
    });
})( jQuery );
</script>
<?php } ?> 