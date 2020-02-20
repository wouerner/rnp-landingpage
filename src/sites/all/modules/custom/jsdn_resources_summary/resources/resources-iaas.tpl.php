<?php 
$timeZoneText = json_decode($_SESSION['MenuJSON'])->locale->timezone;
?>
<script>
var table;
var actionType = null;
(function( $ ) {
    $( document ).ready(function() {  
        chart_widget104(5); 
        jQuery('#jctable-load-more').click(function(){  
           table.page.loadMore();
        });
    });

})( jQuery );

function resource_viewDetails(isv_server_id, action_url, type){
    if(type === 'url'){
        jQuery('#serverId').val(isv_server_id);
        jQuery('#instanceForm').attr("action",jsdnURL+"/jsdn/"+action_url);
        jQuery('#instanceForm').submit();	
    }
}

function resource_viewDetailsCMS(provider_code, resource_type_code, resources_url, type){ 
    jQuery('#resourceUrl').val(resources_url);
    jQuery('#resourceProviderCode').val(provider_code);
    jQuery('#resourceTypeCode').val(resource_type_code);
    jQuery('#resourceDetailsForm').attr("action","/cms/resource/details");
    jQuery('#resourceDetailsForm').submit();  
}

function chart_widget104(){
    var tableType = 'iaas-resources';
    var storageResource = localStorage.getItem('resourcesProvider');
    var regionsResource = localStorage.getItem('resourcesRegions');
    if (!IsNullOrEmpty(storageResource)) {
        resources_provider = localStorage.getItem('resourcesProvider')
    }
    else{
        resources_provider = Drupal.settings.jsdn_resources_summary.provider;
    }
    
    if (!IsNullOrEmpty(regionsResource)) {
        resources_regions = localStorage.getItem('resourcesRegions');
    }
    else{
        resources_regions = Drupal.settings.jsdn_resources_summary.regions;
    }
    var fields = {provider: resources_provider, regions: resources_regions, tableType : tableType};
    table = jQuery('#example').DataTable({
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search here",
            sInfo:"Showing _START_ to _END_ of _TOTAL_ results"
        },
        dom: 'frti',
        "serverSide": true,
        "processing": true,
        "bFilter": true,
        ajax:jQuery.fn.dataTable.pageLoadMore({
            url: '/cms/sites/all/modules/custom/jsdn_resources_summary/api/resourcesTableAPI.php',
            type: "POST",
            data: fields,
        }),
        "columns": [
            {   "data": "name",
                "render": function(data, type, row, meta){
                    var isv_server_id = '';
                    var provider_code = '';
                    var resource_type_code = '';
                    if(row.actions){
                        var action_type = row.actions[0]["action-type"];
                        var action_url = row.actions[0]["action-url"];
                        if(action_type === 'url'){
                            isv_server_id = row.actions[0]["action-parameters"].isv_server_id;
                            data = '<a href="JavaScript:Void(0);" onclick=resource_viewDetails("'+isv_server_id+'","'+action_url+'","'+action_type+'");>' + data + '</a>';
                        }
                        else{
                            provider_code = row["provider-code"];
                            resource_type_code = row["resource-type-code"];
                            data = '<a href="JavaScript:Void(0);" onclick=resource_viewDetailsCMS("'+provider_code+'","'+resource_type_code+'","'+action_url+'","'+action_type+'");>' + data + '</a>';
                        }   
                    }
                    return data;
                }    
            }, 
            { "data": "provider-name" }, 
            { "data": "region" }, 
            { "data": "creation-date"}, 
            { "data": "created-by" }, 
            { "data": "resource-type-label" },
            { "data": "updated-by" },
            { "data": "updation-date" },
            { "data": "empty" }, 	  
        ],
        responsive: {
            details: {
                type: 'column',
                target: -1
            }
        },
        columnDefs: [
        {
            className: 'control',
            orderable: false,
            targets:   -1,
        },
        {
            "targets"  : 'no-sort',
            "orderable": false,
        }],
        "order": [[ 7, "desc" ]],
        drawCallback: function(){
            actionType = null;
            if(jQuery('#jctable-load-more').is(':visible')){
               jQuery('html, body').animate({
                  scrollTop: jQuery('#jctable-load-more').offset().top
                }, 1000);
            }
            jQuery('#jctable-load-more').toggle(this.api().page.hasMore());	
        },
        initComplete: function (settings, json) {
            jQuery('#loaderDiv104').hide();
            jQuery('.block-jsdn_resources_summary .portlet-content').css({'height':'auto'});
            this.api().columns('.select-filter').every( function (pos) {
                var column = this; 	
                // columnsource will get the data for this column
                var columnsource = table.column( this.index() ).dataSrc();
                // This will get the filter array for this column
                // create the filter icon and show in the column
                var select = jQuery('<div class="dropdown"><img class="filter" src="/cms/sites/all/modules/custom/jsdn_resources_summary/images/filter.png" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></img><ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><a class="filterApply" filterby="'+columnsource+'">Apply</a></ul></div>')
                .appendTo( jQuery(column.header()))
                // Generate Column Filter Values and prepend to the above filter dropdown. Need to handle no result case
                if(json.filters[columnsource]){
                    for(var i=0;i<json.filters[columnsource].length;i++){
                        if(json.filters[columnsource][i]){
                            var val = json.filters[columnsource][i].val;
                            var label = json.filters[columnsource][i].label;
                            select.find('ul').prepend( '<li><span><input name="filterCheckbox" type="checkbox" value='+val+'></span><span>'+label+'</span></div></li>' )
                        }
                    }  
                }else{
                    for(var i=0;i<json.filters[0][columnsource].length;i++){
                        if(json.filters[0][columnsource][i]){
                            var val = json.filters[0][columnsource][i].val;
                            var label = json.filters[0][columnsource][i].label;
                            select.find('ul').prepend( '<li><span><input name="filterCheckbox" type="checkbox" value='+val+'></span><span>'+label+'</span></div></li>' )
                        }
                    }    
                }            	
                jQuery('.dropdown-menu input').on('click',function(e){
                    e.stopImmediatePropagation();
                    var container = jQuery(".dropdown-menu");
                    if (!container.is(e.target) && container.has(e.target).length === 0){
                        container.hide();
                    }
                })
                // Below should take care when click on apply pass all the filter values to the backend. Need to work on
                jQuery('.filterApply').on( 'click', function (event) { 
                    event.stopImmediatePropagation();
                    jQuery(this).parents('.dropdown').removeClass('open');
                    var selfilters = [];
                    var items =[];
                    var filterType = jQuery(this).attr('filterby');
                    jQuery.each(jQuery(this).parent('ul').find("input:checked"), function(){        
                        selfilters.push('"'+jQuery(this).val()+'"');
                    });
                    var val = jQuery.fn.dataTable.util.escapeRegex(
                        selfilters.join(", ")
                    );
                    actionType = "filter";
                    var items = '['+selfilters+']';
                        column
                        .search( items ? ''+items+'' : '', true, false )
                        .page.len('10')
                        .draw();
                    });
            });
        }	  
    });
    // Handle search on enter key press
    jQuery('#example_filter input').unbind();
    jQuery('#example_filter input').bind('keyup', function(e) {
        if(e.keyCode == 13) {
            actionType = "search";
            table.search(this.value).page.len('10').draw();	
        }
    });
}
</script>

<div id="chart_widget104" class="chart_daily_trend">
  <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
      <tr>
        <tr>
        <th class="all"><?php print t('Name'); ?></th>
        <th><?php print t('Provider'); ?></th>
        <th><?php print t('Region'); ?></th>
        <th><?php print t('Created On'); ?></th>
        <th><?php print t('Created By'); ?></th>
        <th class="select-filter no-sort" type="Resource Type"><?php print t('Resource Type'); ?></th>
        <th><?php print t('Modified By'); ?></th>
        <th><?php print t('Modified On'); ?></th>
        <th></th>
      </tr>
    </thead>
  </table>
  <div class="dt-more-container"> <a id="jctable-load-more" style="display:none"><?php print t('Load More'); ?></a> </div>
</div>
<div class="timezone"><?php print t('^ All dates and times are in '); ?><?php print $timeZoneText;?></div>
<form id="instanceForm"  name="instanceForm" action="" method="post" style="display: none">
    <input type="hidden" name="isv_server_id" value="" id="serverId"/>
</form>

<form id="resourceDetailsForm"  name="resourceDetailsForm" action="" method="post" style="display: none">
    <input type="hidden" name="resourceUrl" value="" id="resourceUrl"/>
    <input type="hidden" name="resourceProviderCode" value="" id="resourceProviderCode"/>
    <input type="hidden" name="resourceTypeCode" value="" id="resourceTypeCode"/>
</form>