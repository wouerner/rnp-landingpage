var resources_regions;
var resources_provider;
var currencySymbol;
var provider_account;
var change_chart = true;
var reset = false;
var pageType;
var baseURL;
var empty_message;
var error_message;
var company_acronym;


(function( $ ) {
    Drupal.behaviors.jsdn_resources_summary = {
      attach: function (context, settings) {
        resources_provider = settings.jsdn_resources_summary.provider;
        resources_regions = settings.jsdn_resources_summary.regions;
        currencySymbol = settings.jsdn_resources_summary.currencySymbol;
        pageType = settings.jsdn_resources_summary.pageType;
        baseURL = settings.jsdn_resources_summary.baseUrl;
        empty_message = settings.jsdn_resources_summary.empty_message;
        error_message = settings.jsdn_resources_summary.error_message;	
      }
    };
    $( document ).ready(function() {  
        var regionsResource = localStorage.getItem('resourcesRegions');
        $("#resources_regions").multiselect({header: false,minWidth: "auto",height:"auto",selectedText: '# Regions Selected',noneSelectedText: 'Select Regions'});
        if (IsNullOrEmpty(regionsResource)) {
            $("#resources_regions").multiselect("checkAll");
        }
    });
})( jQuery );

function IsNullOrEmpty(value)
{
    return (value == null || value === "" || value === "null");
}

function chart_widget101(count, chart_type) {
    var widget_id = 'chart_widget101';
    var widget_loader_id = 'loaderDiv101';
    var type = 'resources-instances-by-count';
    change_chart = false;
    var showCurrency = false;
    var chartColor = ['#ff9801', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'plain_html')){
        chart_type = 'plain_html';
    }
    var vAxis = 'Count';
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
    resources_chart_ajax_request(widget_id, widget_loader_id, type, resources_provider , resources_regions, count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget102(count, chart_type) {
    var widget_id = 'chart_widget102';
    var widget_loader_id = 'loaderDiv102';
    var type = 'resources-by-provider';
    change_chart = false;
    var showCurrency = false;
    var chartColor = ['#24a3f4', '#ffb400', '#ff7200', '#ca0467', '#6406bc', '#00847f', '#4f2d00', '#77e59e'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = 'donut';
    }
    var vAxis = 'Count';
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
    resources_chart_ajax_request(widget_id, widget_loader_id, type, resources_provider , resources_regions, count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget103(count, chart_type) {
    var widget_id = 'chart_widget103';
    var widget_loader_id = 'loaderDiv103';
    var type = 'resources-by-region';
    change_chart = false;
    var showCurrency = false;
    var chartColor = ['#258ebe', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = 'column';
    }
    var vAxis = 'Count';
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
    resources_chart_ajax_request(widget_id, widget_loader_id, type, resources_provider , resources_regions, count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}


function resources_chart_ajax_request(widget_id, widget_loader_id, type, provider , regions, count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis) {
    var fields = {provider: resources_provider, regions: regions, count : count, type : type,  reset: reset, company_acronym: company_acronym};
    xhr = jQuery.ajax({  
        type: "POST",  
        url: '/cms/sites/all/modules/custom/jsdn_resources_summary/api/resourcesAPI.php',
        data: fields,
        dataType: 'json',
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery("#"+widget_id).hide();
            jQuery("#"+widget_id).parent().find('.widgetDotMenu').hide();
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
        },
        success: function(chart_result) {
            var portlet = jQuery('#' + widget_id).parents('.homebox-portlet');
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show(); 
            if(chart_result.length > 1){
                jQuery("#"+widget_id).parent().find('.widgetDotMenu').show();
            }
            if((chart_result.length === 2) && ((change_chart === true))){
                chart_type = 'column';
                jQuery("."+widget_id+" li").each(function(index, value){
                    var lival = jQuery(this).find("span.display").html();
                    if(lival !== undefined && lival == 'Column'){
                        jQuery(this).removeClass('unchecked');
                    }
                    else if(lival !== undefined && lival !== 'Column') {
                        jQuery(this).addClass('unchecked');
                    }
                });
                columndrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor);
            }
            else if((chart_result.length > 6) && ((change_chart === true))){
                jQuery("."+widget_id+" li").each(function(index, value){
                    var lival = jQuery(this).find("span.display").html();
                    if(lival !== undefined && lival == 'Table'){
                        jQuery(this).removeClass('unchecked');
                    }
                    else if(lival !== undefined && lival !== 'Table') {
                        jQuery(this).addClass('unchecked');
                    }
                });
                tabledrawChart(JSON.stringify(chart_result), widget_id, showCurrency);
            }
            else if(((chart_result.length <= 32) || (change_chart === false))){
                if(chart_type === 'column'){
                    columndrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor, showLegend, doubleAxis);
                }
                else if(chart_type === 'line'){
                    linedrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor);
                }
                else if(chart_type === 'area'){
                    areadrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor, showLegend);
                }
                else if(chart_type === 'table'){
                    tabledrawChart(JSON.stringify(chart_result), widget_id, showCurrency);
                }
                else if(chart_type === 'donut'){
                    piedrawChart(JSON.stringify(chart_result), widget_id, showCurrency, chartAreaSize, chartColor);
                }
                else if(chart_type === 'stack'){
                    stackeddrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor, isPercent);
                }
                else if(chart_type === 'plain_html'){
                    plainhtmldrawChart(JSON.stringify(chart_result), widget_id, showCurrency, chartAreaSize, chartColor);
                }
                else if(chart_type === 'csv'){
                    var csv_filename = '';
                    csv_filename = jQuery("#" + widget_id).parent().find(".widget_title").html();
                    JSONToCSVConvertor(JSON.stringify(chart_result), csv_filename, showCurrency);
                }
                else{
                    
                }
                jQuery("."+widget_id+" li").each(function(index, value){
                    var lival = jQuery(this).find("span.display").html();
                    if((typeof(lival) !== "undefined") && (typeof(chart_type) !== "undefined") && (chart_type !== "csv") ){
                          if((lival.toUpperCase()) === (chart_type.toUpperCase())){
                            jQuery(this).removeClass('unchecked');
                        }
                        else{
                            jQuery(this).addClass('unchecked');
                        }
                    }
                });
            }
            else{
                chart_type = 'table';
                jQuery("."+widget_id+" li").each(function(index, value){
                var lival = jQuery(this).find("span.display").html();
                    if(lival !== undefined && lival == 'Table'){
                        jQuery(this).removeClass('unchecked');
                    }
                    else if(lival !== undefined && lival !== 'Table') {
                        jQuery(this).addClass('unchecked');
                    }
                });
                tabledrawChart(JSON.stringify(chart_result), widget_id, showCurrency);
            }
        }
    });
}

function plainhtmldrawChart(chart_data , elementId, showCurrency, chartAreaSize, chartColor) {
    var total_count = JSON.parse(chart_data).length;
    if(total_count < 1){
        jQuery("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
    }
    else{
        $jsonData = JSON.parse(chart_data);
        var html = '<div class="rowContainerTab "><div class="resourceSummary_wrapper">';
        for(var i=0;i<total_count;i++){
           var resource_type = $jsonData[i]["class"].toLowerCase();
           html += '<div class="resource_Contentsdiv">';
           html += '<div class="resourceContent floatLeft">';
           html += '<div class="floatLeft '+resource_type+'-image"><span class="paddingLeft-40">'+ $jsonData[i]["key"] +'</span></div>';
           html += '</div>';
           html += '<div class="floatRight resource_val">'+ $jsonData[i]["value"] +'</div>';
           html += '</div>';
        }
        html += '</div></div>';
        jQuery("#"+elementId).html(html);
    }
}

function columndrawChart(chart_data , elementId, vAxis, showCurrency, chartAreaSize, chartColor, showLegend, doubleAxis) {
    var total_count = JSON.parse(chart_data).length;
    var combine_charts = false;
    var data = new google.visualization.arrayToDataTable(JSON.parse(chart_data));
    $jsonData = JSON.parse(chart_data); 
    if(showCurrency){
        var formatter = new google.visualization.NumberFormat({prefix: currencySymbol});
        formatter.format(data, 1);
        if($jsonData[0].length > 2){
            for(var i=2;i<$jsonData[0].length;i++){
                var countWord = $jsonData[0][i].toLowerCase();
                if (countWord.indexOf("count") == -1) {
                    formatter.format(data, i);
                }
                else{
                    combine_charts = true;
                }
            }
        }
    }
    if ((typeof(chartAreaSize) === "undefined") || (chartAreaSize === null)){
        chartAreaSize = {width: '97%', height: '75%',top:15,left:90,right:20,bottom:40};
    }
    if ((typeof(chartColor) === "undefined") || (chartColor === null)){
        chartColor = ['orange', 'blue', '#77e59e', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    
    var options = {
        colors: chartColor,
        fontSize:10,
        chartArea: chartAreaSize,
        animation:{
            "startup": true,
            "duration": 1000,
            "easing": 'out',
        },

        vAxis:{title: vAxis,scaleType:"mirrorLog", minValue:0, maxValue:100, gridlines:{count:5, color: '#e9e9e9'}}
    };
    
    doubleAxis = doubleAxis || false;
    if(doubleAxis){
        options.series = {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
        };
        options.vAxes = {
          // Adds titles to each axis.
          0: {title: $jsonData[0][1]},
          1: {title: $jsonData[0][2]}
        };
    }
    showLegend = showLegend || false;
    if(showLegend){
        options.legend = {alignment:'end',position: 'bottom'};
    }
    else{
        options.legend = {position: 'none'};
    }
    if(showCurrency && (combine_charts == true)){
        options.vAxes[0].format = currencySymbol + '##,###,###,###.00';
    }
    else if(showCurrency && (combine_charts == false)){
        options.vAxis.format = currencySymbol + '##,###,###,###.00';
    }
   
    if(total_count <= 1){
        jQuery("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
    }
    else{
        var chart = new google.visualization.ColumnChart(document.getElementById(elementId));
        chart.draw(data, options);
        jQuery("#"+elementId).parent().find('.widget-info-icon').css({'display':'inline-flex'});
    }
} 

function piedrawChart(chart_data , elementId, showCurrency, chartAreaSize, chartColor) {
    var total_count = JSON.parse(chart_data).length;
    var data = new google.visualization.arrayToDataTable(JSON.parse(chart_data));
    if(showCurrency){
        var formatter = new google.visualization.NumberFormat({prefix: currencySymbol});
        formatter.format(data, 1);
        $jsonData = JSON.parse(chart_data);
        if($jsonData[0].length > 2){
            for(var i=2;i<$jsonData[0].length;i++){
               formatter.format(data, i);
            }
        }
    }
    if ((typeof(chartAreaSize) === "undefined") || (chartAreaSize === null)){
        chartAreaSize = {width: '80%', left:70, top: 5, bottom:15};
    } 
    var options = {
        fontSize:10,
        chartArea: chartAreaSize,
        colors: ['#1899ed','#ffb400','#ff7200','#c322d1','#e41f81','#e41f81','#6406bc'],
        legend:{alignment:'center',position:'right'},
        pieHole: 0.5,
    };    
    if ((typeof(chartColor) != "undefined") || (chartColor != null)){
        options.colors = chartColor;
    }
    if(total_count <= 1){
        jQuery("#"+elementId).html('<div class="noData">'+empty_message+'</div>'); 
    }
    else{
        var chart = new google.visualization.PieChart(document.getElementById(elementId));
        chart.draw(data, options);
        jQuery("#"+elementId).parent().find('.widget-info-icon').css({'display':'inline-flex'});
    }
}