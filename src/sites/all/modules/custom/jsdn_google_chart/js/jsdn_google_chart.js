var provider;
var currencySymbol;
var currencyLocale;
var currencyPattern;
var currencyFraction;
var startdate;
var enddate;
var date_type = '';
var change_chart = true;
var reset = false;
var pageType;
var tagname = '';
var tagvalue = '';
var product;
var baseURL;
var empty_message;
var error_message;
var tag_key_label;
var provider_account;
var company_acronym;
var private_cloud_account;
var public_cloud_account;
var dataCenterValue;
var product_cost_trend = '';
var vm_count_by_tag_key = '';
var vm_cost_by_tag_key = '';
var tag_cost_trend = '';
var instance_cost_by_tags = '';
var product_cost_by_tags = '';
var tag_cost_trend_tag_value = '';
var instance_cost_tags_by_value = '';
var product_cost_by_tag_value = '';
var plainHtmlwithColor = false;


function plainhtmldrawChart(chart_data , elementId, showCurrency, chartAreaSize, chartColor) {
    var total_count = JSON.parse(chart_data).length;
    if(total_count <= 1){
        if(plainHtmlwithColor){
            jQuery("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
        }
        else{
            jQuery("#"+elementId).html('<div class="noData"></div>');
        }
    }
    else{
        $jsonData = JSON.parse(chart_data);
        if(plainHtmlwithColor){
            var html = '<div class="chartHtmlContainer">';
            for(var i=1;i<total_count;i++){
               html += '<div class="clear rowHtml" style="background:'+chartColor[i]+';">';
               html += '<div style="float:left;">'+ $jsonData[i][0] +'</div>';
               if($jsonData[i][0] == 'Total Memory'){
                   html += '<div style="float:right;">'+ $jsonData[i][1] +' GB</div>';
               }
               else{
                   html += '<div style="float:right;">'+ $jsonData[i][1] +'</div>';
               }
               html += '</div>';
            }
            html += '</div>';
            jQuery("#"+elementId).html(html);
            jQuery("#"+elementId).parent().find('.widget-info-icon').css({'display':'inline-flex'});
        }
        else{
            var filters_array = JSON.parse(filters);
            var html = '';
            var provider_val = jQuery("#spend_provider").val();
            var total_amount = 0;
            for(var i=0;i<filters_array.length;i++){
                var set = false;
                html += '<div class="overallCost-Container">';
                var provider_amount = 0;
                for(var j=1;j<total_count;j++){
                    if(filters_array[i]['value'] === $jsonData[j][0]){
                        set = true;
                        html += '<div class="leftDiv">'+ $jsonData[j][0] +':</div>';
                        html += '<div class="rightDiv">' + currencySymbol +''+ $jsonData[j][1].toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction}) +'</div>';
                        provider_amount = $jsonData[j][1].toFixed(currencyFraction);
                    }
                }
                if((set == false) && (provider_val == 'All')){
                    html += '<div class="leftDiv">'+ filters_array[i]['value'] +':</div>';
                    html += '<div class="rightDiv">' + currencySymbol +''+ parseFloat(0).toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction}) +'</div>';
                }
                total_amount += parseFloat(provider_amount) ;
                html += '</div>';
            }
            jQuery( "#curcost" ).show();
			jQuery( "#product-trend-cost .currentcost" ).text(currencySymbol + ""+ total_amount.toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction}) );
            jQuery("#"+elementId).html(html);
        }
    }
}

function stackeddrawChart(chart_data , elementId, vAxis, showCurrency, chartAreaSize, chartColor, isPercent) {
    chart_data = JSON.parse(chart_data);
    var total_count = chart_data.length;
    var data = google.visualization.arrayToDataTable(chart_data);
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
        chartAreaSize = {width: '97%', height: '75%',top:15,left:90,right:20,bottom:60};
    }
    if ((typeof(chartColor) === "undefined") || (chartColor === null)){
        chartColor = ['orange', 'blue'];
    } 
    var options = {
        colors: chartColor,
        isStacked: true,
        legend: {alignment:'end',position: 'bottom'},
        fontSize:12,
        chartArea: chartAreaSize,
        animation:{
            "startup": true,
            "duration": 1000,
            "easing": 'out',
        },
        vAxis:{title: vAxis, gridlines:{count:5, color: '#e9e9e9'}}
    };
    if(showCurrency){
        options.vAxis.format = currencySymbol + currencyPattern;
    }
    if(isPercent){
        options.isStacked = 'percent';
    }
    else{
        options.isStacked = true;
        options.vAxis.scaleType = "mirrorLog";
        options.vAxis.minValue = 0;
        options.vAxis.maxValue = 100;
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

function areadrawChart(chart_data , elementId, vAxis, showCurrency, chartAreaSize, chartColor, showLegend) {
    var total_count = JSON.parse(chart_data).length;
    var data = new google.visualization.arrayToDataTable(JSON.parse(chart_data));
    $jsonData = JSON.parse(chart_data);
    if(showCurrency){
        var formatter = new google.visualization.NumberFormat({prefix: currencySymbol});
        formatter.format(data, 1);
        if($jsonData[0].length > 2){
            for(var i=2;i<$jsonData[0].length;i++){
                formatter.format(data, i);
            }
        }
    }
    if ((typeof(chartAreaSize) === "undefined") || (chartAreaSize === null)){
        chartAreaSize = {top:15,left:90,right:50,bottom:60};
    }
    if ((typeof(chartColor) === "undefined") || (chartColor === null)){
        chartColor = ['#2fcae8', '#1295e1','#16c97f', '#77e59e', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    var options = {
        colors: chartColor,
        chartArea: chartAreaSize,
        fontSize:10,
        animation:{
            "startup": true,
            "duration": 1000,
            "easing": 'out',
        },
        vAxis:{title: vAxis, viewWindow: { min:0 }, gridlines:{color: '#e9e9e9'}},
    };
    
    if(elementId == 'chart_widget54'){
        var doubleAxis = true;
        if(doubleAxis){
            options.series = {
                0: {targetAxisIndex: 0, areaOpacity: 0.1},
                1: {targetAxisIndex: 0, areaOpacity: 0.2},
                2: {targetAxisIndex: 0, areaOpacity: 0.2},
                3: {targetAxisIndex: 1, areaOpacity: 0}
            };
            options.vAxes = {
              // Adds titles to each axis.
              0: {title: Drupal.t('Hours')},
              1: {title: Drupal.t('Coverage Rate'), minValue: 0,  maxValue: 100, format: '#\'%\''},
            };
        }
    }
    showLegend = showLegend || false;
    if(showLegend){
        options.legend = {alignment:'end',position: 'bottom'};
    }
    else{
        options.legend = {position: 'none'};
    }
    if(showCurrency){
        options.vAxis.format = currencySymbol + currencyPattern;
    }
    if(total_count <= 1){
        jQuery("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
    }
    else{
        var chart = new google.visualization.AreaChart(document.getElementById(elementId));
        chart.draw(data, options);
        jQuery("#"+elementId).parent().find('.widget-info-icon').css({'display':'inline-flex'});
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
                if (countWord.indexOf("count") == 0) {
                    combine_charts = true;
                }
                else if (countWord.indexOf("hours") == 0) {
                    combine_charts = true;
                }
                else if (countWord.indexOf("vm count") == 0) {
                    combine_charts = true;
                }
                else{
                    formatter.format(data, i);
                    combine_charts = false;
                }
            }
        }
    }
    if ((typeof(chartAreaSize) === "undefined") || (chartAreaSize === null)){
        chartAreaSize = {width: '97%', height: '75%',top:15,left:90,right:20,bottom:60};
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
    
    
    if(elementId == 'chart_widget54'){
        var doubleAxis = true;
        if(doubleAxis){
            options.series = {
                0: {targetAxisIndex: 0},
                1: {targetAxisIndex: 0},
                2: {targetAxisIndex: 0},
                3: {targetAxisIndex: 1}
            };
            options.vAxes = {
              // Adds titles to each axis.
              0: {title: Drupal.t('Hours')},
              1: {title: Drupal.t('Coverage Rate'), minValue: 0,  maxValue: 100, format: '#\'%\''},
            };
        }
    }else{
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
    }

    showLegend = showLegend || false;
    if(showLegend){
        options.legend = {alignment:'end',position: 'bottom'};
    }
    else{
        options.legend = {position: 'none'};
    }
    if(showCurrency && (combine_charts == true)){
        options.vAxes[0].format = currencySymbol + currencyPattern;
    }
    else if(showCurrency && (combine_charts == false)){
        options.vAxis.format = currencySymbol + currencyPattern;
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

function linedrawChart(chart_data , elementId, vAxis, showCurrency, chartAreaSize, chartColor) {
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
        chartAreaSize = {width: '95%', height: '55%',top:15,left:90};
    }
    if ((typeof(chartColor) === "undefined") || (chartColor === null)){
        chartColor = ['#24e2f3', '#1295e1','#16c97f', '#77e59e', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    var options = {
        colors: chartColor,
        chartArea: chartAreaSize,
        legend: {alignment:'start',position: 'bottom'},
        fontSize:12,
        animation:{
            "startup": true,
            "duration": 1000,
            "easing": 'out',
        },
        vAxis:{title: vAxis, viewWindow: { min:0 }, gridlines:{color: '#e9e9e9'}},
    };
    if(showCurrency){
        options.vAxis.format = currencySymbol + currencyPattern;
    }
    if(total_count <= 1){
        jQuery("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
    }
    else{
        var chart = new google.visualization.LineChart(document.getElementById(elementId));
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
        chartAreaSize = {width: '80%', top: 15, bottom:30};
    } 
    var options = {
        fontSize:10,
        chartArea: chartAreaSize,
        colors: ['#5ee383','#ffb400','#ff7200','#fb461d','#c322d1','#e41f81','#6406bc'],
        legend:{alignment:'center',position:'bottom'},
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

function tabledrawChart(chart_data , elementId, showCurrency, chartAreaSize) {
    var total_count = JSON.parse(chart_data).length;
    var data = google.visualization.arrayToDataTable(JSON.parse(chart_data));
    if(showCurrency){
        var formatter = new google.visualization.NumberFormat({prefix: currencySymbol});
        formatter.format(data, 1);
        $jsonData = JSON.parse(chart_data);
        if($jsonData[0].length > 2){
            for(var i=2;i<$jsonData[0].length;i++){
                var countWord = $jsonData[0][i].toLowerCase();
                if (countWord.indexOf("count") == 0) {
                    combine_charts = true;
                }
                else if (countWord.indexOf("hours") == 0) {
                    combine_charts = true;
                }
                else{
                    formatter.format(data, i);
                    combine_charts = false;
                }
            }
        }
    }
    if ((typeof(chartAreaSize) === "undefined") || (chartAreaSize === null)){
        chartAreaSize = {width: '95%', height: '55%',top:15,left:90,right:50};
    }
    var options = {
        chartArea: chartAreaSize,
        width: '97%',
        pageSize:6,
        page: 'enable',
        cssClassNames: {headerRow: 'chart-th',tableCell: 'chart-cell'}
    };
    if(total_count <= 1){
        jQuery("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
    }
    else{
        var chart = new google.visualization.Table(document.getElementById(elementId));
        chart.draw(data, options);
        jQuery("#"+elementId).parent().find('.widget-info-icon').css({'display':'inline-flex'});
    }
}

function JSONToCSVConvertor(JSONData, fileName, showCurrency) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    var CSV = '';    

    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = '';
        for (var index in arrData[i]) {
            if (row != '') row += ','
            if (showCurrency && (i != 0) && (index != 0)) {
                var countWord = arrData[0][index].toLowerCase();
                if (countWord.indexOf("count") == 0) {
                    row += arrData[i][index];
                }
                else if (countWord.indexOf("hours") == 0) {
                    row += arrData[i][index];
                }
                else{
                    row += currencySymbol+arrData[i][index];
                }
            }
            else{
                row += arrData[i][index];
            }
        }
        CSV += row + '\r\n';
    }
    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   

    // Anything excpet IE works here
    if (undefined === window.navigator.msSaveOrOpenBlob) {
        var e = document.createElement('a');
        var href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(CSV);
        e.setAttribute('href', href);
        e.setAttribute('download', fileName + '.csv');
        document.body.appendChild(e);
        e.click();
        document.body.removeChild(e);
    }
    // IE-specific code
    else {
        var blob = new Blob([CSV], {type: 'text/csv;charset=utf-8;'});
        window.navigator.msSaveOrOpenBlob(blob, fileName + '.csv');
    }
}

function google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis) {
    if((product_cost_trend != '') && (widget_id == 'chart_widget6')){
        product = product_cost_trend;
        jQuery('#product_trend_products').val(product); 
    }
    if((widget_id == 'chart_widget18') || (widget_id == 'chart_widget19') || (widget_id == 'chart_widget20') || (widget_id == 'chart_widget21') || (widget_id == 'chart_widget17')){
        tagname = jQuery('#'+widget_id+'_products').val();
        tagvalue = jQuery('#'+widget_id+'_products_val').val();
    }
    
    var fields = {provider: provider, count : count, type : type, startdate : startdate, enddate: enddate, date_type: date_type, reset: reset,product: product,tagname: tagname, tagvalue: tagvalue, chart_type: chart_type, dataCenterValue: dataCenterValue, company_acronym: company_acronym};
    xhr = jQuery.ajax({  
        type: "POST",  
        url: '/cms/jsdnConnect/chartAPI.php',
        data: fields,
        dataType: 'json',
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery("#"+widget_id).hide();
            jQuery("#"+widget_id).parent().find('.widgetDotMenu').hide();
            jQuery("#"+widget_id).parent().find('.chart_filter_count').hide();
            if((widget_id == 'chart_widget48')){
                jQuery( "#dataCenterCost" ).hide();
            }
            if((widget_id != 'chart_widget48')){
                jQuery("#"+widget_id).parent().find(".chart_filter_type").hide();
            }
            jQuery("#"+widget_id).parent().find(".widget-info-icon").hide(); 
            if(widget_id === "chart_widget44" || widget_id === "chart_widget6" || widget_id === "chart_widget27" || widget_id === "chart_widget44"){
                jQuery( "#curcost" ).hide();
                jQuery( "#estimatedcost" ).hide();
                jQuery( ".curcost" ).hide();
                jQuery( ".estimatedcost" ).hide();
            }
            else if(widget_id === "chart_widget37"){
                jQuery( ".curcostmachine" ).hide();
                jQuery( ".estimatedcostmachine" ).hide();
            }
            
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            if(widget_id !== 'chart_widget4'){
                jQuery("#"+widget_id).html('<div class="noData">'+error_message+'</div>');
            }
        },
        success: function(chart_result) {
            if(widget_id === "chart_widget6"  || widget_id === "chart_widget27" || widget_id === "chart_widget3" ){
                var overallCurrentCost = chart_result[1];
                var overallEstimatedCost = chart_result[0];
                var overallEstimatedCostDR = chart_result[2];
                var overallCurrentCost = overallCurrentCost.overallCurrentCost; 
                var overallEstimatedCost = overallEstimatedCost.overallEstimatedCost;
                var overallEstimatedCostDR = overallEstimatedCostDR.overallEstimatedCostDR;				
                jQuery(".overallCost-Left").show(); 
                if(overallEstimatedCost !== "" && overallEstimatedCost !== null ){
                    jQuery( "#estimatedcost" ).show();
					jQuery( "#product-trend-cost .estcost" ).text( currencySymbol + ""+ parseFloat(overallEstimatedCost.replace(/,/g, '')).toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction}));
                    jQuery(".icon-estimated").bt();
					if(widget_id === "chart_widget6"){ 
                        jQuery(".icon-estimated").bt(overallEstimatedCostDR,{ fill: '#fff',strokeStyle:'#B7B7B7',spikeLength: 10,spikeGirth: 10,padding: 8,cornerRadius: 0,positions: ['bottom'],trigger: 'click',cssStyles:{width:'180px'} });
                    }else{
                        jQuery(".icon-estimated").bt(parseFloat(overallEstimatedCostDR.replace(/,/g, '')).toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction}),{ fill: '#fff',strokeStyle:'#B7B7B7',spikeLength: 10,spikeGirth: 10,padding: 8,cornerRadius: 0,positions: ['bottom'],trigger: 'click',cssStyles:{width:'180px'} });
                    }
                }
                if(overallCurrentCost !== "" && overallCurrentCost !== null && (widget_id != 'chart_widget3')){
                    jQuery( "#curcost" ).show();
					jQuery( "#product-trend-cost .currentcost" ).text(currencySymbol + ""+ parseFloat(overallCurrentCost.replace(/,/g, '')).toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction}) );
                }
                
                if(overallEstimatedCost !== "" && overallEstimatedCost !== null ){
                    jQuery( "#precost" ).show();
					jQuery( "#product-trend-cost .previouscost" ).text(currencySymbol + ""+ parseFloat(overallEstimatedCost.replace(/,/g, '')).toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction}) );
                }
                
                if(overallEstimatedCostDR !== "" && overallEstimatedCostDR !== null ){
                    jQuery( ".executivePercent" ).show();
                    if (overallEstimatedCostDR < 0) {
                        jQuery( ".executivePercent" ).addClass("downarrow");
                    }
                    else{
                        jQuery( ".executivePercent" ).addClass("uparrow");
                    }
						jQuery( "#product-trend-cost .differencecost" ).text(parseFloat(overallEstimatedCostDR.replace(/,/g, '')).toLocaleString(currencyLocale,{minimumFractionDigits: currencyFraction, maximumFractionDigits: currencyFraction})+'%');
                }
                
                chart_result.shift();
                chart_result.shift();
                chart_result.shift();
            }
            else if(widget_id === "chart_widget37" || widget_id === "chart_widget44" ){
                var totalHost = chart_result[1];
                var noCPU = chart_result[0];
                var cloudtotalHost = totalHost.totalHost; 
                var cloudNoCPU = noCPU.noCPU;
                if(cloudNoCPU !== "" && cloudNoCPU !== null && widget_id === "chart_widget44"){
                    jQuery( ".estimatedcost" ).show();
                    jQuery( ".product-trend-cost .estcost" ).text(cloudNoCPU);
                }
                else if(cloudNoCPU !== "" && cloudNoCPU !== null && widget_id === "chart_widget37"){
                    jQuery( ".estimatedcostmachine" ).show();
                    jQuery( ".product-trend-cost .estcostmachine" ).text(cloudNoCPU);
                }
                if(cloudtotalHost !== "" && cloudtotalHost !== null && widget_id === "chart_widget44" ){
                    jQuery( ".curcost" ).show();
                    jQuery( ".product-trend-cost .currentcost" ).text(cloudtotalHost);
                }
                else if(cloudtotalHost !== "" && cloudtotalHost !== null && widget_id === "chart_widget37" ){
                    jQuery( ".curcostmachine" ).show();
                    jQuery( ".product-trend-cost .currentcostmachine" ).text(cloudtotalHost);
                }
                chart_result.shift();
                chart_result.shift();
            }
            else if(widget_id === "chart_widget43"){    
                if (chart_result.length > 1){
                    if(chart_result[1][0] === 'Y'){
                        chart_result[1][0] = Drupal.t('Marked For Migration');
                    }
                }
                if (chart_result.length === 3){
                    if(chart_result[2][0] === 'N'){
                        chart_result[2][0] = Drupal.t('Not Marked For Migration');
                    }
                }
            }
            else if(widget_id === "chart_widget48"){
                var overallCost = chart_result[0];
                var dataCenterCost = overallCost.dataCenterCost;
                if(dataCenterCost !== "" && dataCenterCost !== null ){
                    jQuery( "#dataCenterCost" ).show();
                    jQuery( "#product-trend-cost .dataCenterCost" ).text( currencySymbol + ""+ dataCenterCost);
                }
                chart_result.shift();
            }
             
            var isPercent = false;
            if(widget_id === "chart_widget46" || widget_id === "chart_widget45" ){
                isPercent = true;
            }
            if(chart_result === 'logged_out'){
                window.location.href = baseURL;
                return;
            }
            var portlet = jQuery('#' + widget_id).parents('.homebox-portlet');
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show(); 
            if(chart_result.length > 1){
                jQuery('#' + chart_select_count_id).show();
                jQuery('#' + chart_select_id).show();
                jQuery("#"+widget_id).parent().find('.widgetDotMenu').show();
            }
            
            if((chart_result.length === 2) && ((change_chart === true)) && ((widget_id === "chart_widget3") || (widget_id === "chart_widget6") || (widget_id === "chart_widget26") || (widget_id === "chart_widget20") || (widget_id === "chart_widget22"))){
                chart_type = Drupal.t('column');
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
            else if((chart_result.length > 6) && ((change_chart === true)) && ((widget_id === "chart_widget45") || (widget_id === "chart_widget46"))){
                var chart_select_id = jQuery("#" + widget_id).parent().find(".chart_filter_type").attr("id");
                chart_type = Drupal.t('table');
                jQuery('#' + chart_select_id).val(chart_type);
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
            else if(((chart_result.length <= 32) || (change_chart === false) || (widget_id === 'chart_widget3') || (widget_id === 'chart_widget22') || (widget_id === "chart_widget6") || (widget_id === "chart_widget20") || (widget_id === "chart_widget48"))){
                if(chart_type === Drupal.t('column')){
                    columndrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor, showLegend, doubleAxis);
                }
                else if(chart_type === Drupal.t('line')){
                    linedrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor);
                }
                else if(chart_type === Drupal.t('area')){
                    areadrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor, showLegend);
                }
                else if(chart_type === Drupal.t('table')){
                    tabledrawChart(JSON.stringify(chart_result), widget_id, showCurrency);
                }
                else if(chart_type === Drupal.t('donut')){
                    piedrawChart(JSON.stringify(chart_result), widget_id, showCurrency, chartAreaSize, chartColor);
                }
                else if(chart_type === Drupal.t('stack')){
                    stackeddrawChart(JSON.stringify(chart_result), widget_id, vAxis, showCurrency, chartAreaSize, chartColor, isPercent);
                }
                else if(chart_type === Drupal.t('plain_html')){
                    plainhtmldrawChart(JSON.stringify(chart_result), widget_id, showCurrency, chartAreaSize, chartColor);
                }
                else if(chart_type === Drupal.t('csv')){
                    var csv_filename = '';
                    if((widget_id !== 'chart_widget38') && (widget_id !== 'chart_widget39') && (widget_id !== 'chart_widget40') && (widget_id != 'chart_widget42') && (widget_id !== 'chart_widget43') && (widget_id !== 'chart_widget44') && (widget_id !== 'chart_widget45') && (widget_id !== 'chart_widget46') && (widget_id !== 'chart_widget48') && (widget_id !== 'chart_widget49')){
                        csv_filename = jQuery(portlet).find(".portlet-title").html();
                    }
                    else{
                        csv_filename = jQuery("#" + widget_id).parent().find(".widget_title").html();
                    }
                    JSONToCSVConvertor(JSON.stringify(chart_result), csv_filename, showCurrency);
                }
                else{
                    if(chart_result[0] === null){
                        var saas = 0;
                        var iaas = 0;
                    }
                    else{
                        var saas = typeof chart_result[0]['SAAS'] === "undefined" ? 0: chart_result[0]['SAAS'];
                        var iaas = typeof chart_result[0]['IAAS'] === "undefined" ? 0: chart_result[0]['IAAS'];
                    }
                    var total_cost = parseFloat(saas) + parseFloat(iaas);
                    jQuery( "#saas_cost" ).text( saas.toFixed(2) );
                    jQuery( "#iaas_cost" ).text( iaas.toFixed(2) );
                    jQuery( "#total_cost" ).text( total_cost.toFixed(2));
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
                jQuery("."+widget_id+" li").each(function(index, value){
                    var liresultsval = jQuery(this).find("span.results").html();
                    var resultCount = '';
                    if (count == 5){
                        resultCount = Drupal.t('Top 5');
                    }
                    if (count == 10){
                        resultCount = Drupal.t('Top 10');
                    }
                    if (count == 10000000) {
                        resultCount = Drupal.t('All');
                    }
                    if((typeof(liresultsval) !== "undefined") && (typeof(resultCount) !== "undefined")){
                          if((resultCount.toUpperCase()) === (liresultsval.toUpperCase())){
                            jQuery(this).removeClass('unchecked');
                        }
                        else{
                            jQuery(this).addClass('unchecked');
                        }
                    }
                });
            }
            else{
                chart_type = Drupal.t('table');
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
            if((widget_id != 'chart_widget49') && (widget_id != 'chart_widget38') && (widget_id != 'chart_widget39') && (widget_id != 'chart_widget40') && (widget_id != 'chart_widget42') && (widget_id != 'chart_widget43') && (widget_id != 'chart_widget44') && (widget_id != 'chart_widget45') && (widget_id != 'chart_widget46') && (widget_id != 'chart_widget48')){
                var chart_select_id = jQuery(portlet).find(".chart_filter").attr("id");
                var chart_select_count_id = jQuery(portlet).find(".chart_filter_count").attr("id");
            }
            else if((widget_id != 'chart_widget48')){
                var chart_select_id = jQuery("#" + widget_id).parent().find(".chart_filter_type").attr("id");
            }
            else{
                var chart_select_id = jQuery("#" + widget_id).parent().find(".chart_filter").attr("id");
            }
        }
    });
}

function google_chart_ajax_request_product_trend(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym) {
    var fields = {provider: provider, count : count, type : type, startdate : startdate, enddate: enddate, date_type: date_type, reset: reset, product: product, dataCenterValue: dataCenterValue, company_acronym: company_acronym };
    xhr = jQuery.ajax({  
        type: "POST",  
        url: '/cms/jsdnConnect/chartAPI.php',
        data: fields,
        dataType: 'json',
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery("#"+widget_id).hide();
            jQuery("#"+widget_id).parent().find('.widgetDotMenu').hide();
            jQuery("#"+widget_id).parent().find('.chart_filter_count').hide();
            jQuery("#"+widget_id).parent().find(".chart_filter_type").hide();
            jQuery("#"+widget_id).parent().find(".widget-info-icon").hide(); 
            jQuery('#product_trend_products').remove();
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            jQuery("#"+widget_id).html('<div class="noData">'+error_message+'</div>');
        },
        success: function(chart_result) {
            if(chart_result === 'logged_out'){
                window.location.href = baseURL;
                return;
            }
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            // build drop down 
            if(chart_result.length >= 1){
                jQuery('#product_trend_products').remove();
                if(widget_id === 'chart_widget26'){
                    var op='<select id="product_trend_products" class="chart_filter"  onchange="saasProductFilter(this.value)">';
                }
                else{
                    var op='<select id="product_trend_products" onchange="productFilter(this.value)">';
                }
               
                for (var i in chart_result) {
                    op += '<option value="'+chart_result[i]['value']+'">'+chart_result[i]['key']+'</option>';
                }
                op +="</select>";
                jQuery('#filter_product_trend').append(op);
            }
            else{
                jQuery('#product_trend_products').remove();
            }
            var portlet = jQuery('#' + widget_id).parents('.homebox-portlet');
            var chart_select_id = jQuery(portlet).find(".chart_filter").attr("id");
            var chart_select_count_id = jQuery(portlet).find(".chart_filter_count").attr("id");
            if(chart_select_count_id){
                 jQuery('#' + chart_select_count_id).val(count);
            }
            if(chart_select_id){
                 jQuery('#' + chart_select_id).val(chart_type);
            }
            
            if(widget_id === 'chart_widget26'){
                var type = 'saas-product-trend';
            }
            else{
                var type = 'product-trend';
            }
            
            if(jQuery( "#product_trend_products" ).length && jQuery('#product_trend_products').val()==null){
                product = chart_result[5]['value'];
            }else{
               product = jQuery('#product_trend_products').val();
            }
           google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
        }
    });
}

function google_chart_ajax_request_tag_one_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis) {
    var fields = {provider: provider, count : count, type : type, startdate : startdate, enddate: enddate, date_type: date_type, reset: reset,product: product,tagname: tagname, tagvalue: tagvalue,dataCenterValue: dataCenterValue, company_acronym: company_acronym};
    xhr = jQuery.ajax({  
        type: "POST",  
        url: '/cms/jsdnConnect/chartAPI.php',
        data: fields,
        dataType: 'json',
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery("#"+widget_id).hide();
            jQuery('#'+widget_id+'_products').remove();
            jQuery('#'+widget_id+'_tagkey').remove();
            jQuery("#"+widget_id).parent().find('.widgetDotMenu').hide();
            jQuery("#"+widget_id).parent().find('.chart_filter_count').hide();
            jQuery("#"+widget_id).parent().find(".chart_filter_type").hide();
            jQuery("#"+widget_id).parent().find(".widget-info-icon").hide(); 
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            jQuery("#"+widget_id).html('<div class="noData">'+error_message+'</div>');
        },
        success: function(chart_result) {
            if(chart_result === 'logged_out'){
                window.location.href = baseURL;
                return;
            }
            if(chart_result.length >= 1){
                jQuery('#'+widget_id+'_products').remove();
                jQuery('#'+widget_id+'_tagkey').remove();
                var label = '';
                if(widget_id !== 'chart_widget27'){
                    label = tag_key_label;
                }
                var op='<span id="'+widget_id+'_tagkey" class="tagkey">'+label+'</span><select id="'+widget_id+'_products" class="chart_filter"  onchange="product_'+widget_id+'(this.value)">';
                if(widget_id === 'chart_widget27'){
                    op += '<option value="All">'+Drupal.t("All Providers")+'</option>';
                }
                for (var i in chart_result) {
                    op += '<option value="'+chart_result[i]['value']+'">'+chart_result[i]['key']+'</option>';
                }
                op +="</select>";
                jQuery('#filter_'+ widget_id).append(op);

                var portlet = jQuery('#' + widget_id).parents('.homebox-portlet');
                var chart_select_id = jQuery(portlet).find(".chart_filter").attr("id");
                var chart_select_count_id = jQuery(portlet).find(".chart_filter_count").attr("id");
                if(chart_select_count_id){
                    jQuery('#' + chart_select_count_id).val(count);
                }
                if(chart_select_id){
                    jQuery('#' + chart_select_id).val(chart_type);
                }
                if(widget_id === 'chart_widget18'){
                    var type = 'vm-count-tag-key';
                }
                else if(widget_id === 'chart_widget19'){
                    var type = 'vm-cost-tag-key';
                }
                else if(widget_id === 'chart_widget27'){
                    var data_range = jQuery("#date_range_selected27").val();
                    var currDate=moment();
                    date_type = '';
                    if(data_range=="3month"){
                        var stDate=moment().subtract(90, 'days');
                        startdate = moment(stDate).format('YYYYMMDD');
                        enddate = moment(currDate).format('YYYYMMDD');
                    }else if(data_range=="6month"){
                        var stDate=moment().subtract(180, 'days');
                        startdate = moment(stDate).format('YYYYMMDD');
                        enddate = moment(currDate).format('YYYYMMDD');
                    }
                    else if(data_range=="12month"){
                        var stDate=moment().subtract(365, 'days');
                        startdate = moment(stDate).format('YYYYMMDD');
                        enddate = moment(currDate).format('YYYYMMDD');
                    }
                    else if(data_range=="ytd"){
                        date_type = 'YTD';
                        var stDate='01/01/'+moment().format('YYYY'); 
                        startdate = moment(stDate).format('YYYYMMDD');
                        enddate = moment(currDate).format('YYYYMMDD');
                    }
                    var type = 'saas-daily-trend-provider';
                }

                tagname = jQuery('#'+widget_id+'_products').val();
                google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
            }
            else{
                jQuery("#"+widget_loader_id).hide();
                jQuery("#"+widget_id).show();
                jQuery("#"+widget_id).html('<div class="noData">'+empty_message+'</div>');
            }
        }
    });
}

function google_chart_ajax_request_tag_two_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym) {
    var fields = {provider: provider, count : count, type : type, startdate : startdate, enddate: enddate, date_type: date_type, reset: reset,product: product,tagname: tagname, tagvalue: tagvalue, dataCenterValue : dataCenterValue, company_acronym: company_acronym};
    xhr = jQuery.ajax({  
        type: "POST",  
        url: '/cms/jsdnConnect/chartAPI.php',
        data: fields,
        dataType: 'json',
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery("#"+widget_id).hide();
            jQuery("#"+widget_id).parent().find(".chart_filter_count").hide();
            jQuery("#"+widget_id).parent().find(".chart_filter_type").hide();
            jQuery("#"+widget_id).parent().find(".widget-info-icon").hide(); 
            jQuery('#'+widget_id+'_products').remove();
            jQuery('#'+widget_id+'_products_val').remove();
            jQuery('#'+widget_id+'_tagkey').remove();
            jQuery('#'+widget_id+'_tagvalue').remove();
            jQuery( "#dataCenterCost" ).hide();
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            jQuery("#"+widget_id).html('<div class="noData">'+error_message+'</div>');
        },
        success: function(chart_result) {
            if(chart_result === 'logged_out'){
                window.location.href = baseURL;
                return;
            }
            if(chart_result.length >= 1){
                jQuery('#'+widget_id+'_products').remove();
                jQuery('#'+widget_id+'_products_val').remove();
                jQuery('#'+widget_id+'_tagkey').remove();
                jQuery('#'+widget_id+'_tagvalue').remove();
                var op='<span id="'+widget_id+'_tagkey" class="tagkey">'+tag_key_label+' </span><select id="'+widget_id+'_products" class="chart_filter"  onchange="product_'+widget_id+'(this.value)">';
                for (var i in chart_result) {
                    op += '<option value="'+chart_result[i]['value']+'">'+chart_result[i]['key']+'</option>';
                }
                op +="</select>";
                jQuery('#filter_'+ widget_id).append(op);
                tagname = jQuery('#'+widget_id+'_products').val();
               
                if(widget_id === 'chart_widget48'){
                    var type = 'tag-values-of-tag-name-private';
                }
                else if(widget_id === 'chart_widget50'){
                    var type = 'tag-values-of-tag-name-public';
                }
                else{
                    var type = 'tag-values-of-tag-name';
                }
                
                if((tag_cost_trend != '') && (widget_id == 'chart_widget20')){
                    tagname = tag_cost_trend;
                    jQuery('#chart_widget20_products').val(tag_cost_trend); 
                }
                if((instance_cost_by_tags != '') && (widget_id == 'chart_widget21')){
                    tagname = instance_cost_by_tags;
                    jQuery('#chart_widget21_products').val(instance_cost_by_tags); 
                }
                if((product_cost_by_tags != '') && (widget_id == 'chart_widget17')){
                    tagname = product_cost_by_tags;
                    jQuery('#chart_widget17_products').val(product_cost_by_tags); 
                }
                var fields_new = {provider: provider, count : count, type : type, startdate : startdate, enddate: enddate, date_type: date_type, reset: reset,product: product,tagname: tagname, tagvalue: tagvalue, dataCenterValue : dataCenterValue, company_acronym: company_acronym};
                xhr = jQuery.ajax({  
                    type: "POST",  
                    url: '/cms/jsdnConnect/chartAPI.php',
                    data: fields_new,
                    dataType: 'json',
                    beforeSend: function(){
                        jQuery("#"+widget_loader_id).show();
                        jQuery("#"+widget_id).hide();
                    },
                    error: function(){
                        jQuery("#"+widget_loader_id).hide();
                        jQuery("#"+widget_id).show();
                        jQuery("#"+widget_id).html('<div class="noData">'+error_message+'</div>');
                    },
                    success: function(result) { 
                        if(result === 'logged_out'){
                            window.location.href = baseURL;
                            return;
                        }
                        if(result.length >= 1){
                            jQuery('#'+widget_id+'_products_val').remove();
                            jQuery('#'+widget_id+'_tagvalue').remove();
                            var op1='<span id="'+widget_id+'_tagvalue" class="tagvalue">'+Drupal.t("Tag Value:")+'</span><select id="'+widget_id+'_products_val" class="chart_filter"  onchange="product_keyval_'+widget_id+'(this.value)">';
                            for (var i in result) {
                                op1 += '<option value="'+result[i]['value']+'">'+result[i]['key']+'</option>';
                            }
                            op1 +="</select>";
                            jQuery('#filter_'+ widget_id).append(op1);
                            tagname = jQuery('#'+widget_id+'_products').val();
                            tagvalue = jQuery('#'+widget_id+'_products_val').val();
                            var portlet = jQuery('#' + widget_id).parents('.homebox-portlet');
                            var chart_select_id = jQuery(portlet).find(".chart_filter").attr("id");
                            var chart_select_count_id = jQuery(portlet).find(".chart_filter_count").attr("id");
                            if((widget_id != 'chart_widget48')){
                                if(chart_select_count_id){
                                    jQuery('#' + chart_select_count_id).val(count);
                                }
                                if(chart_select_id){
                                     jQuery('#' + chart_select_id).val(chart_type);
                                }
                            }
                            else{
                                var chart_select_id = jQuery("#" + widget_id).parent().find(".chart_filter_type").attr("id");
                                jQuery('#' + chart_select_id).show();
                                jQuery('#' + chart_select_id).val(chart_type);
                            }
                            if(widget_id === 'chart_widget17'){
                                var type = 'product-associated-to-tags';
                            }
                            else if(widget_id === 'chart_widget20'){
                                var type = 'tag-cost-trend';
                            }
                            else if(widget_id === 'chart_widget21'){
                                var type = 'instance-type-tags';
                            }
                            else if(widget_id === 'chart_widget48'){
                                var type = 'tag-cost-trend-private';
                            }
                            else if(widget_id === 'chart_widget50'){
                                jQuery("#"+widget_loader_id).hide();
                                jQuery("#filter_chart_widget50").show();
                                jQuery( "div#homebox div.homebox-column-wrapper .cloud_insights" ).each(function() {
                                    var widget_name = jQuery( this ).attr("id");
                                    var code = widget_name+"(5)";
                                    eval(code);
                                });
                            }
                            
                            if(widget_id != 'chart_widget50'){
                               google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym); 
                            }
                            
                        }
                        else{
                            jQuery( "div#homebox div.homebox-column-wrapper .loaderDiv" ).each(function() {
                                var widget_name = jQuery( this ).attr("id");
                                jQuery("#"+widget_name).hide();
                            });
                            jQuery( "div#homebox div.homebox-column-wrapper .cloud_insights" ).each(function() {
                                    var widget_name = jQuery( this ).attr("id");
                                    jQuery("#"+widget_name).show();
                                    jQuery("#"+widget_name).html('<div class="noData">'+empty_message+'</div>');
                            });
                        }
                    }
                });
            }
            else{
                jQuery("#"+widget_loader_id).hide();
                jQuery("#"+widget_id).show();
                jQuery("#"+widget_id).html('<div class="noData">'+empty_message+'</div>');
                jQuery( "div#homebox div.homebox-column-wrapper .loaderDiv" ).each(function() {
                    var widget_name = jQuery( this ).attr("id");
                    jQuery("#"+widget_name).hide();
                });
                jQuery( "div#homebox div.homebox-column-wrapper .cloud_insights" ).each(function() {
                        var widget_name = jQuery( this ).attr("id");
                        jQuery("#"+widget_name).show();
                        jQuery("#"+widget_name).html('<div class="noData">'+empty_message+'</div>');
                });
            }
        }
    });
}

function google_chart_ajax_dropdown_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym) {
    var fields = {provider: provider, count : count, type : type, startdate : startdate, enddate: enddate, date_type: date_type, reset: reset,product: product,tagname: tagname, tagvalue: tagvalue, dataCenterValue: dataCenterValue, company_acronym: company_acronym};
    xhr = jQuery.ajax({  
        type: "POST",  
        url: '/cms/jsdnConnect/chartAPI.php',
        data: fields,
        dataType: 'json',
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery("#"+widget_id).hide();
            jQuery('#'+widget_id+'_products_val').remove();
            jQuery('#'+widget_id+'_tagvalue').remove();
            jQuery("#"+widget_id).parent().find('.widgetDotMenu').hide();
            jQuery("#"+widget_id).parent().find('.chart_filter_count').hide();
            jQuery("#"+widget_id).parent().find(".chart_filter_type").hide();
            jQuery("#"+widget_id).parent().find(".widget-info-icon").hide(); 
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            jQuery("#"+widget_id).html('<div class="noData">'+error_message+'</div>');
        },
        success: function(result) { 
            if(result === 'logged_out'){
                window.location.href = baseURL;
                return;
            }
            if(result.length >= 1){
                jQuery('#'+widget_id+'_products_val').remove();
                jQuery('#'+widget_id+'_tagvalue').remove();
                var op='<span id="'+widget_id+'_tagvalue" class="tagvalue">'+Drupal.t("Tag Value:")+'</span><select id="'+widget_id+'_products_val" class="chart_filter"  onchange="product_keyval_'+widget_id+'(this.value)">';
                for (var i in result) {
                    op += '<option value="'+result[i]['value']+'">'+result[i]['key']+'</option>';
                }
                op +="</select>";
                jQuery('#filter_'+ widget_id).append(op);

            tagname = jQuery('#'+widget_id+'_products').val();
            tagvalue = jQuery('#'+widget_id+'_products_val').val();
            var portlet = jQuery('#' + widget_id).parents('.homebox-portlet');
            var chart_select_id = jQuery(portlet).find(".chart_filter").attr("id");
            var chart_select_count_id = jQuery(portlet).find(".chart_filter_count").attr("id");
            if((widget_id != 'chart_widget48')){
                if(chart_select_count_id){
                    jQuery('#' + chart_select_count_id).val(count);
                }
                if(chart_select_id){
                     jQuery('#' + chart_select_id).val(chart_type);
                }
            }
            else{
                var chart_select_id = jQuery("#" + widget_id).parent().find(".chart_filter_type").attr("id");
                jQuery('#' + chart_select_id).show();
                jQuery('#' + chart_select_id).val(chart_type);
            }

            if(widget_id === 'chart_widget17'){
                var type = 'product-associated-to-tags';
            }
            else if(widget_id === 'chart_widget20'){
                var type = 'tag-cost-trend';
            }
            else if(widget_id === 'chart_widget21'){
                var type = 'instance-type-tags';
            }
            else if(widget_id === 'chart_widget48'){
                var type = 'tag-cost-trend-private';
            }
            else if(widget_id === 'chart_widget50'){
                jQuery("#"+widget_loader_id).hide();
                jQuery("#filter_chart_widget50").show();
                jQuery( "div#homebox div.homebox-column-wrapper .cloud_insights" ).each(function() {
                    var widget_name = jQuery( this ).attr("id");
                    var code = widget_name+"(5)";
                    eval(code);
                });
            }
            if(widget_id != 'chart_widget50'){
                google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
            }
        }
        else{
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            jQuery("#"+widget_id).html('<div class="noData">'+empty_message+'</div>');
        }
        }
    });
}

function google_chart_ajax_request_data_center(widget_id, widget_loader_id, type, provider, count, company_acronym) {
    var fields = {provider: provider, count : count, type : type, startdate : startdate, enddate: enddate, company_acronym: company_acronym};
    xhr = jQuery.ajax({  
        type: "POST",  
        url: '/cms/jsdnConnect/chartAPI.php',
        data: fields,
        dataType: 'json',
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery('#'+widget_id+'_products').hide();
            jQuery('#'+widget_id+'_products').remove();
            jQuery('#'+widget_id+'_tagvalue').remove();
            jQuery( "#dataCenterCost" ).hide();
            jQuery("#"+widget_id).parent().find(".widget-info-icon").hide(); 
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
            //jQuery("#"+widget_id).html('<div class="noData">'+error_message+'</div>');
        },
        success: function(chart_result) {
            if(chart_result.length >= 1){
                jQuery('#'+widget_id+'_products').remove();
                jQuery('#'+widget_id+'_tagvalue').remove();
                var label = Drupal.t('Data Center');
                var op='<span id="'+widget_id+'_tagvalue" class="tagvalue">'+ label +': </span><select id="'+widget_id+'_products" class="chart_filter_datacenter"  onchange="product_'+widget_id+'(this.value)">';
                dataCenterValue = chart_result[0]['value'];
                for (var i in chart_result) {
                    op += '<option value="'+chart_result[i]['value']+'">'+chart_result[i]['key']+'</option>';
                }
                op +="</select>";
                jQuery('#'+widget_id).append(op);
                jQuery("#"+widget_loader_id).hide();
                jQuery( "div#homebox div.homebox-column-wrapper .data_center" ).each(function() {
                    var widget_name = jQuery( this ).attr("id");
                    var code = widget_name+"(5)";
                    eval(code);
                });
            }
            else{
                jQuery( "div#homebox div.homebox-column-wrapper .loaderPrivate" ).each(function() {
                    var widget_name = jQuery( this ).attr("id");
                    jQuery("#"+widget_name).hide();
                });
                
                jQuery("#"+widget_loader_id).hide();
                //jQuery("#"+widget_id).hide();
                jQuery( "div#homebox div.homebox-column-wrapper .data_center" ).each(function() {
                    var widget_name = jQuery( this ).attr("id");
                    jQuery("#"+widget_name).html('<div class="noData">'+empty_message+'</div>');
                });
            }
        }
    });
}

function spend_provider_refresh_all_widget() {  
    jQuery( "div#homebox div.homebox-column-wrapper .chart_daily_trend" ).each(function() {
        var widget_name = jQuery( this ).attr("id");
        var code = widget_name+"(5)";
        eval(code);
    });
}

function chart_widget1(count, chart_type) {
    var widget_id = 'chart_widget1';
    var widget_loader_id = 'loaderDiv1';
    var type = 'provider-usage';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'plain_html')){
        chart_type = 'plain_html';
        var chartColor = ['#77e59e', '#ffb400', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget2(count, chart_type) {
    var widget_id = 'chart_widget2';
    var widget_loader_id = 'loaderDiv2';
    var type = 'products-usage';
    var showCurrency = true;
    var chartColor = ['#ff9801', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget3(count, chart_type) {
    var start = moment(startdate,'YYYYMMDD');
    var end = moment(enddate,'YYYYMMDD');
    var diffDays = end.diff(start, 'days');
    var startDateYear = moment().startOf('year').format('YYYYMMDD');
    var todayDate = moment().format('YYYYMMDD');
    var startCurrent = moment(startDateYear,'YYYYMMDD');
    var endCurrent = moment(todayDate,'YYYYMMDD');
    var totalDays = endCurrent.diff(startCurrent, 'days');
    var selectedYear = moment(startdate,'YYYYMMDD').format('YYYY');
    var currentYear = moment.utc(curdate).utcOffset(timeoffset).startOf('year').format('YYYY');
    var currentMonth = moment.utc(curdate).utcOffset(timeoffset).startOf('month').format('M');
    var monthArray = [ 2, 3 ];
    var chartColor = ['#2fcae8', '#10e4b4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var widget_id = 'chart_widget3';
    var widget_loader_id = 'loaderDiv3';
    var type = 'daily-trend';

    var chartAreaSize = null;
    if((selectedYear === currentYear) && (totalDays === diffDays) && (jQuery.inArray(parseInt(currentMonth), monthArray) > -1) && (diffDays != 0)){
        date_type = 'YTD';
        if(change_chart == true){
            chart_type = Drupal.t('area');
            var chartColor = ['#2fcae8', '#10e4b4'];
        }
    }
    else{
         date_type = '';
    }
    if((diffDays === 0) && (typeof(chart_type) === "undefined")){
        chart_type = Drupal.t('area');
        var chartColor = null;
    }
    if((diffDays > 92) && (typeof(chart_type) === "undefined")){
        chart_type = Drupal.t('area');
        var chartColor = ['#2fcae8', '#10e4b4'];
    }
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
        var chartColor = ['#2fcae8', '#ff3c00','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    }
    var chart_select_id = jQuery("#" + widget_id).parent().find(".chart_filter_type").attr("id");
    jQuery('#' + chart_select_id).val(chart_type);
    var vAxis = Drupal.t('Cost');
    var showCurrency = true;
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function chart_widget4(count, chart_type) {
    var widget_id = 'chart_widget4';
    var widget_loader_id = 'loaderDiv4';
    var type = 'cost-summary';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'text')){
        chart_type = 'text';
    }
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget5(count, chart_type) {
    var widget_id = 'chart_widget5';
    var widget_loader_id = 'loaderDiv5';
    var type = 'products-usage';
    var showCurrency = true;
    var chartColor = ['#24e2f3', '#1295e1','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'line')){
        chart_type = Drupal.t('line');
    }
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget6(count, chart_type) {
    var start = moment(startdate,'YYYYMMDD');
    var end = moment(enddate,'YYYYMMDD');
    var diffDays = end.diff(start, 'days');
    var startDateYear = moment().startOf('year').format('YYYYMMDD');
    var todayDate = moment().format('YYYYMMDD');
    var startCurrent = moment(startDateYear,'YYYYMMDD');
    var endCurrent = moment(todayDate,'YYYYMMDD');
    var currentYear = moment.utc(curdate).utcOffset(timeoffset).startOf('year').format('YYYY');
    var currentMonth = moment.utc(curdate).utcOffset(timeoffset).startOf('month').format('M');
    var totalDays = endCurrent.diff(startCurrent, 'days');
    var selectedYear = moment(startdate,'YYYYMMDD').format('YYYY');
            
    var monthArray = [ 2, 3 ];
    
    var widget_id = 'chart_widget6';
    var widget_loader_id = 'loaderDiv6';
    var type = 'products';
    var showCurrency = true;
    var chartColor = ['#42acea', '#10e4b4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if((selectedYear === currentYear) && (totalDays === diffDays) && (jQuery.inArray(parseInt(currentMonth), monthArray) > -1) && (change_chart === true) && (diffDays !== 0)){
        if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
            chart_type = Drupal.t('area');
        }
        date_type = 'YTD';
    }
    else{
        date_type = '';
    }
    if(diffDays > 92){
        if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
            chart_type = Drupal.t('area');
        }
        var chartColor = ['#42acea', '#10e4b4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    }
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
        var chartColor = ['#3abdd5', '#1295e1','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
        
        
    }
    var chartAreaSize = {width: '97%', height: '25%',top:15,left:90,right:20,bottom:80};
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request_product_trend(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function chart_widget7(count, chart_type) {
    var widget_id = 'chart_widget7';
    var widget_loader_id = 'loaderDiv7';
    var type = 'vm-count-by-instance-type';
    var showCurrency = true;
    var chartColor = ['#ff9800', '#5ca0f4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Count');
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    var showLegend = true; 
    var doubleAxis = true; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget8(count, chart_type) {
    var widget_id = 'chart_widget8';
    var widget_loader_id = 'loaderDiv8';
    var type = 'vm-cost-by-instance-type';
    var showCurrency = true;
    var chartColor = ['#23e4c6', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    var chartAreaSize = {width: '95%', height: '55%',top:15,left:90, right:90};

    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function chart_widget9(count, chart_type) {
    var widget_id = 'chart_widget9';
    var widget_loader_id = 'loaderDiv9';
    var type = 'resource-count';
    var showCurrency = true;
    var chartColor = ['#f44e75', '#5cd2f4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Count');
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    var showLegend = true; 
    var doubleAxis = true; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget10(count, chart_type) {
    var widget_id = 'chart_widget10';
    var widget_loader_id = 'loaderDiv10';
    var type = 'resource-cost';
    var showCurrency = true;
    var chartColor = ['#05e5ed', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    var chartAreaSize = {width: '95%', height: '55%',top:15};
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function chart_widget11(count, chart_type) {
    var widget_id = 'chart_widget11';
    var widget_loader_id = 'loaderDiv11';
    var type = 'vm-cost-by-source';
    var showCurrency = true;
    var chartColor = ['#77e59e', '#ffb400', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
    }
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget12(count, chart_type) {
    var widget_id = 'chart_widget12';
    var widget_loader_id = 'loaderDiv12';
    var type = 'vm-count-by-source';
    var showCurrency = true;
    var chartColor = ['#915adc', '#3de0de', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Count');
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    var showLegend = true; 
    var doubleAxis = true; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget13(count, chart_type) {
    var widget_id = 'chart_widget13';
    var widget_loader_id = 'loaderDiv13';
    var type = 'cost-by-iaas-usage';
    var showCurrency = true;
    var chartColor = ['#f44e75', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    var chartAreaSize = null;
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function chart_widget14(count, chart_type) {
    var widget_id = 'chart_widget14';
    var widget_loader_id = 'loaderDiv14';
    var type = 'cost-by-platform';
    var showCurrency = true;
    var chartColor = ['#68d9da', '#c143fb', '#ec3a70', '#3aec64', '#68d9da'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
    }
    var vAxis = Drupal.t('Cost');
    var chartAreaSize = null;
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function chart_widget15(count, chart_type) {
    var widget_id = 'chart_widget15';
    var widget_loader_id = 'loaderDiv15';
    var type = 'cost-resources';
    var showCurrency = true;
    var chartColor = ['#ff6160', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget16(count, chart_type) {
    var widget_id = 'chart_widget16';
    var widget_loader_id = 'loaderDiv16';
    var type = 'cost-by-tags';
    var showCurrency = true;
    var chartColor = ['#ff9800', '#5ca0f4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    var vAxis = Drupal.t('Cost');
    var showLegend = true; 
    var doubleAxis = true; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget17(count, chart_type, widget_change) {
    var widget_id = 'chart_widget17';
    var widget_loader_id = 'loaderDiv17';
    var type = 'tag-keys';
    var showCurrency = true;
    reset = true;
    var chartColor = ['#5ca0f4', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    if ((typeof(widget_change) === "undefined") || (widget_change === null)){
        google_chart_ajax_request_tag_two_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
    else{
        var type = 'product-associated-to-tags';
        google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
}

function chart_widget18(count, chart_type, widget_change) {
    var widget_id = 'chart_widget18';
    var widget_loader_id = 'loaderDiv18';
    var type = 'tag-keys';
    var showCurrency = false;
    var vAxis = Drupal.t('Count');
    reset = true;
    var chartColor = ['#10b5e3', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    if ((typeof(widget_change) === "undefined") || (widget_change === null)){
        google_chart_ajax_request_tag_one_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
    else{
        var type = 'vm-count-tag-key';
        google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
}

function chart_widget19(count, chart_type, widget_change) {
    var widget_id = 'chart_widget19';
    var widget_loader_id = 'loaderDiv19';
    var type = 'tag-keys';
    reset = true;
    var showCurrency = true;
    var chartColor = ['#f44e75', '#5cd2f4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    var showLegend = true; 
    var doubleAxis = true; 
    
    if ((typeof(widget_change) === "undefined") || (widget_change === null)){
        google_chart_ajax_request_tag_one_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
    }
    else{
        var type = 'vm-cost-tag-key';
        google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
    }
}

function chart_widget20(count, chart_type, widget_change) {
    var widget_id = 'chart_widget20';
    var widget_loader_id = 'loaderDiv20';
    var type = 'tag-keys';
    reset = true;
    var  chartColor = ['#3abdd5', '#1295e1','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
    }
    var vAxis = Drupal.t('Cost');
    var chartColor = null;
    var showCurrency = true;
    if ((typeof(widget_change) === "undefined") || (widget_change === null)){
        google_chart_ajax_request_tag_two_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
    else{
        var type = 'tag-cost-trend';
        google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
}

function chart_widget21(count, chart_type, widget_change) {
    var widget_id = 'chart_widget21';
    var widget_loader_id = 'loaderDiv21';
    var type = 'tag-keys';
    var showCurrency = true;
    reset = true;
    var chartColor = ['#3de0de', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Cost');
    if ((typeof(widget_change) === "undefined") || (widget_change === null)){
        google_chart_ajax_request_tag_two_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
    else{
        var type = 'instance-type-tags';
        google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
}

function chart_widget22(count, chart_type) {
    var start = moment(startdate,'YYYYMMDD');
    var end = moment(enddate,'YYYYMMDD');
    var diffDays = end.diff(start, 'days');
    var startDateYear = moment().startOf('year').format('YYYYMMDD');
    var todayDate = moment().format('YYYYMMDD');
    var startCurrent = moment(startDateYear,'YYYYMMDD');
    var endCurrent = moment(todayDate,'YYYYMMDD');
    var totalDays = endCurrent.diff(startCurrent, 'days');
    var selectedYear = moment(startdate,'YYYYMMDD').format('YYYY');
    var currentYear = moment.utc(curdate).utcOffset(timeoffset).startOf('year').format('YYYY');
    var currentMonth = moment.utc(curdate).utcOffset(timeoffset).startOf('month').format('M');
    var monthArray = [ 2, 3 ];
    var chartColor = ['#4f39d9', '#ff8900', '#3dabe8', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var widget_id = 'chart_widget22';
    var widget_loader_id = 'loaderDiv22';
    var type = 'daily-trend-provider';
    if((selectedYear === currentYear) && (totalDays === diffDays) && (jQuery.inArray(parseInt(currentMonth), monthArray) > -1) && (diffDays != 0)){
        date_type = 'YTD';
        if(change_chart == true){
            chart_type = Drupal.t('column');
            var chartColor = ['#4f39d9', '#ff8900', '#3dabe8', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
        }
    }
    else{
         date_type = '';
    }
    if((diffDays === 0) && (typeof(chart_type) === "undefined")){
        chart_type = Drupal.t('area');
        var chartColor = null;
    }
    if((diffDays > 92) && (typeof(chart_type) === "undefined")){
        chart_type = Drupal.t('area');
        var chartColor = ['#4f39d9', '#ff8900', '#3dabe8', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
        var chartColor = ['#4f39d9', '#ff8900', '#3dabe8', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    var chart_select_id = jQuery("#" + widget_id).parent().find(".chart_filter_type").attr("id");
    jQuery('#' + chart_select_id).val(chart_type);
    var chartAreaSize = null;
    var vAxis = Drupal.t('Cost');
    var showCurrency = true;
    var showLegend = true; 
    var doubleAxis = false; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget23(count, chart_type) {
    var widget_id = 'chart_widget23';
    var widget_loader_id = 'loaderDiv23';
    var type = 'orders-at-glance';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
        
    }
    var chartColor = ['#fdbd11', '#ff5a00', '#930000', '#0ba0de', '#b40bde', '#f924f2', '#8dc63f', '#06357a' ];
    var vAxis = Drupal.t('Count');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget24(count, chart_type) {
    var widget_id = 'chart_widget24';
    var widget_loader_id = 'loaderDiv24';
    var type = 'saas-provider-usage';
    var data_range = jQuery("#date_range_selected24").val();
    var currDate=moment();
    date_type = '';
    if(data_range=="3month"){
        var stDate=moment().subtract(90, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }else if(data_range=="6month"){
        var stDate=moment().subtract(180, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="12month"){
        var stDate=moment().subtract(365, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="ytd"){
        date_type = 'YTD';
        var stDate='01/01/'+moment().format('YYYY'); 
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
    }
    var chartColor = ['#fdbd11', '#ff5a00', '#930000', '#0ba0de', '#b40bde', '#f924f2', '#8dc63f', '#06357a' ];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget25(count, chart_type) {
    var widget_id = 'chart_widget25';
    var widget_loader_id = 'loaderDiv25';
    var type = 'saas-products-usage';
    var showCurrency = true;
    var data_range = jQuery("#date_range_selected25").val();
    var currDate=moment();
    date_type = '';
    if(data_range=="3month"){
        var stDate=moment().subtract(90, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }else if(data_range=="6month"){
        var stDate=moment().subtract(180, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="12month"){
        var stDate=moment().subtract(365, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="ytd"){
        date_type = 'YTD';
        var stDate='01/01/'+moment().format('YYYY'); 
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['orange', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}


function chart_widget26(count, chart_type) {
    var widget_id = 'chart_widget26';
    var widget_loader_id = 'loaderDiv26';
    var type = 'saas-products';
    var showCurrency = true;
    var diffDays;
    var data_range = jQuery("#date_range_selected26").val();
    var currDate=moment();
    date_type = '';
    if(data_range=="3month"){
        var stDate=moment().subtract(90, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }else if(data_range=="12month"){
        var stDate=moment().subtract(365, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="curmonth"){
        var stDate='01/'+moment().format('MM')+'/'+moment().format('YYYY');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="ytd"){
        date_type = 'YTD';
        var stDate='01/01/'+moment().format('YYYY'); 
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    var chartColor = ['#24e2f3', '#1295e1','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
    }
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request_product_trend(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget27(count, chart_type, widget_change) {
    var widget_id = 'chart_widget27';
    var widget_loader_id = 'loaderDiv27';
    var type = 'saas-providers';
    reset = true;
    var data_range = jQuery("#date_range_selected27").val();
    var currDate=moment();
    date_type = '';
    if(data_range=="3month"){
        var stDate=moment().subtract(90, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }else if(data_range=="6month"){
        var stDate=moment().subtract(180, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="12month"){
        var stDate=moment().subtract(365, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="ytd"){
        date_type = 'YTD';
        var stDate='01/01/'+moment().format('YYYY'); 
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    var showCurrency = true;
    var chartColor = ['#10b5e3', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
    }
    var vAxis = Drupal.t('Cost');
    var chartAreaSize = {width: '97%', height: '25%',top:15,left:90,right:20,bottom:80};
    if ((typeof(widget_change) === "undefined") || (widget_change === null)){
        provider = 'All';
        google_chart_ajax_request_tag_one_dimensional(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
    }
    else{
        var type = 'saas-daily-trend-provider';
        google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
    }
}

function chart_widget28(count, chart_type) {
    var widget_id = 'chart_widget28';
    var widget_loader_id = 'loaderDiv28';
    var type = 'saas-licence-status';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'stack')){
        chart_type = Drupal.t('stack');
    }
    var chartColor = ['#77e59e', '#ffb400', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Count');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget29(count, chart_type) {
    var widget_id = 'chart_widget29';
    var widget_loader_id = 'loaderDiv29';
    var type = 'storage-usage';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#5cb9f4', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget30(count, chart_type) {
    var widget_id = 'chart_widget30';
    var widget_loader_id = 'loaderDiv30';
    var type = 'cost-by-department';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#3de0de', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget31(count, chart_type) {
    var widget_id = 'chart_widget31';
    var widget_loader_id = 'loaderDiv31';
    var type = 'cost-by-account';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#5ca0f4', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget32(count, chart_type) {
    var widget_id = 'chart_widget32';
    var widget_loader_id = 'loaderDiv32';
    var type = 'cost-by-subscriptions';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#3abdd5', 'blue', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget33(count, chart_type) {
    var widget_id = 'chart_widget33';
    var widget_loader_id = 'loaderDiv33';
    var type = 'top-vm-count-by-tags';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#10b5e3', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Count');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget34(count, chart_type) {
    var widget_id = 'chart_widget34';
    var widget_loader_id = 'loaderDiv34';
    var type = 'top-untagged-resource-by-cost';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#3abdd5', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget35(count, chart_type) {
    var widget_id = 'chart_widget35';
    var widget_loader_id = 'loaderDiv35';
    var type = 'private-resource-summary';
    var showCurrency = false;
    plainHtmlwithColor = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'plain_html')){
        chart_type = 'plain_html';
    }
    var chartColor = ['', '#366adf', '#35c5df', '#36deaa', '#96df36', '#ffaa05', '#fe5105', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var vAxis = '';
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget36(count, chart_type) {
    var widget_id = 'chart_widget36';
    var widget_loader_id = 'loaderDiv36';
    var type = 'public-resource-summary';
    var showCurrency = true;
    plainHtmlwithColor = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'plain_html')){
        chart_type = 'plain_html';
    }
    var chartColor = ['','#366adf', '#35c5df', '#36deaa', '#96df36', '#ffaa05', '#fe5105', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var vAxis = '';
     // remove below line later
    public_cloud_account = jQuery("#spend_provider_public").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, public_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget37(count, chart_type) {
    var widget_id = 'chart_widget37';
    var widget_loader_id = 'loaderDiv37';
    var type = 'physical-memory-count';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#0beda5', '#ffb400', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var vAxis = Drupal.t('Count');
    var chartAreaSize = {width: '97%', height: '25%',top:15,left:90,right:20,bottom:30};
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function chart_widget38(count, chart_type) {
    var widget_id = 'chart_widget38';
    var widget_loader_id = 'loaderDiv38';
    var type = 'vm-count-by-cpu-private';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
    }
    var vAxis = Drupal.t('Count');
    var chartColor = ['#47d9f0', '#ff4900', '#ffa200', '#3a8ee4', '#8ec63f', '#c322d1', '#6406bc'];
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget39(count, chart_type) {
    var widget_id = 'chart_widget39';
    var widget_loader_id = 'loaderDiv39';
    var type = 'vm-count-by-flavors-public';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
        jQuery("#spend_provider_selected39" ).val(chart_type);
    }
    var chartColor = ['#47d9f0', '#ff4900', '#ffa200', '#3a8ee4', '#8ec63f', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Count');
    tagvalue = jQuery("#chart_widget50_products_val" ).val();
    tagname = jQuery("#chart_widget50_products" ).val();
    // remove below line later
    public_cloud_account = jQuery("#spend_provider_public").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, public_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget40(count, chart_type) {
    var widget_id = 'chart_widget40';
    var widget_loader_id = 'loaderDiv40';
    var type = 'vm-distribution-os-public';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
        jQuery("#spend_provider_selected40" ).val(chart_type);
    }
    var chartColor = ['#47d9f0', '#ff4900', '#ffa200', '#3a8ee4', '#8ec63f', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Count');
    tagvalue = jQuery("#chart_widget50_products_val" ).val();
    tagname = jQuery("#chart_widget50_products" ).val();
    // remove below line later
    public_cloud_account = jQuery("#spend_provider_public").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, public_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget41(count, chart_type) {
    var widget_id = 'chart_widget41';
    var widget_loader_id = 'loaderDiv41';
    var type = 'migration-status-public';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#77e59e', '#ffb400', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var vAxis = Drupal.t('Count');
    // remove below line later
    public_cloud_account = jQuery("#spend_provider_public").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, public_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget42(count, chart_type) {
    var widget_id = 'chart_widget42';
    var widget_loader_id = 'loaderDiv42';
    var type = 'vm-distribution-os-private';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
    }
    var chartColor = ['#47d9f0', '#ff4900', '#ffa200', '#3a8ee4', '#8ec63f', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Count');
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget43(count, chart_type) {
    var widget_id = 'chart_widget43';
    var widget_loader_id = 'loaderDiv43';
    var type = 'migration-status-private';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#8ec63f', '#ffb400', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var vAxis = Drupal.t('Count');
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget44(count, chart_type) {
    var widget_id = 'chart_widget44';
    var widget_loader_id = 'loaderDiv44';
    var type = 'virtualized-host-count-cpu';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#18bcdf', '#ffb400', '#ff7200', '#ff0000', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var vAxis = Drupal.t('Count');
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget45(count, chart_type) {
    var widget_id = 'chart_widget45';
    var widget_loader_id = 'loaderDiv45';
    var type = 'virtualized-host-cpu';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'stack')){
        chart_type = Drupal.t('stack');
    }
    var chartColor = ['#8ec63f', '#ffde00', '#ff7200', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Utilization');
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget46(count, chart_type) {
    var widget_id = 'chart_widget46';
    var widget_loader_id = 'loaderDiv46';
    var type = 'virtualized-host-memory';
    var showCurrency = false;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'stack')){
        chart_type = Drupal.t('stack');
    }
    var chartColor = ['#fe0000', '#ff8106', '#ff7200', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Utilization');
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget47(count, chart_type) {
    var widget_id = 'chart_widget47';
    var widget_loader_id = 'loaderDiv47';
    var type = 'data-center-filter';
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request_data_center(widget_id, widget_loader_id, type, private_cloud_account, count, company_acronym);
}

function chart_widget48(count, chart_type, widget_change) {
    var widget_id = 'chart_widget48';
    var widget_loader_id = 'loaderDiv48';
    var type = 'tag-keys-private';
    reset = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
        jQuery("#spend_provider_selected48" ).val(chart_type);
    }
    var  chartColor = ['#24e2f3', '#1295e1','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var chartColor = null;
    var showCurrency = true;
    jQuery( "#dataCenterCost" ).hide();
    tagvalue = jQuery("#chart_widget48_products_val" ).val();
    tagname = jQuery("#chart_widget48_products" ).val();
     // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    if ((typeof(widget_change) === "undefined") || (widget_change === null)){
        google_chart_ajax_request_tag_two_dimensional(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
    else{
        var type = 'tag-cost-trend-private';
        google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
    }
}

function chart_widget49(count, chart_type, widget_change) {
    var widget_id = 'chart_widget49';
    var widget_loader_id = 'loaderDiv49';
    var type = 'tag-cost-trend-public';
    reset = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
    }
    var  chartColor = ['#24e2f3', '#1295e1','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var chartColor = null;
    var showCurrency = true;
    tagvalue = jQuery("#chart_widget50_products_val" ).val();
    tagname = jQuery("#chart_widget50_products" ).val();
     // remove below line later
    public_cloud_account = jQuery("#spend_provider_public").val();    
    google_chart_ajax_request(widget_id, widget_loader_id, type, public_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget50(count, chart_type, widget_change) {
    var widget_id = 'chart_widget50';
    var widget_loader_id = 'loaderDiv50';
    var type = 'tag-keys-public';
    var vAxis = Drupal.t('Cost');
    var chartColor = null;
    var showCurrency = true;
    jQuery( "div#homebox div.homebox-column-wrapper .cloud_insights" ).each(function() {
	var widget_name = jQuery( this ).attr("id");
	var chart_loader_id = jQuery("#" + widget_name).parent().find(".loaderDiv").attr("id");
	jQuery("#"+widget_name).hide();
	jQuery("#"+chart_loader_id).show();
    });
    
    // remove below line later
    public_cloud_account = jQuery("#spend_provider_public").val();
    google_chart_ajax_request_tag_two_dimensional(widget_id, widget_loader_id, type, public_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function chart_widget51(count, chart_type) {
   var widget_id = 'chart_widget51';
    var widget_loader_id = 'loaderDiv51';
    var type = 'instance-type-by-reservation';
    var showCurrency = true;
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var chartColor = ['#5cb9f4', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}


function chart_widget52(count, chart_type) {
    var widget_id = 'chart_widget52';
    var widget_loader_id = 'loaderDiv52';
    var type = 'instance-type-by-ondemand';
    var showCurrency = true;
    var chartColor = ['#f44e75', '#23b9c6', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Count');
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    var showLegend = true; 
    var doubleAxis = true; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget53(count, chart_type) {
    var widget_id = 'chart_widget53';
    var widget_loader_id = 'loaderDiv53';
    var type = 'ri-owned-vs-burned-down';
    var showCurrency = false;
    var chartColor = ['#68dac2', '#23b9c6', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'column')){
        chart_type = Drupal.t('column');
    }
    var vAxis = Drupal.t('Hours');
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    var showLegend = true; 
    var doubleAxis = false; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget54(count, chart_type) {
    var start = moment(startdate,'YYYYMMDD');
    var end = moment(enddate,'YYYYMMDD');
    var diffDays = end.diff(start, 'days');
    var startDateYear = moment().startOf('year').format('YYYYMMDD');
    var todayDate = moment().format('YYYYMMDD');
    var startCurrent = moment(startDateYear,'YYYYMMDD');
    var endCurrent = moment(todayDate,'YYYYMMDD');
    var totalDays = endCurrent.diff(startCurrent, 'days');
    var selectedYear = moment(startdate,'YYYYMMDD').format('YYYY');
    var currentYear = moment.utc(curdate).utcOffset(timeoffset).startOf('year').format('YYYY');
    var currentMonth = moment.utc(curdate).utcOffset(timeoffset).startOf('month').format('M');
    var monthArray = [ 2, 3 ];
    var chartColor = ['#ffde00', '#68dac2', '#259ac6', '#e35635', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    var widget_id = 'chart_widget54';
    var widget_loader_id = 'loaderDiv54';
    var type = 'ondemand-vs-reserved-hours';
    if((selectedYear === currentYear) && (totalDays === diffDays) && (jQuery.inArray(parseInt(currentMonth), monthArray) > -1) && (diffDays != 0)){
        date_type = 'YTD';
        if(change_chart == true){
            chart_type = Drupal.t('column');
            var chartColor = ['#ffde00', '#68dac2', '#259ac6', '#e35635', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
        }
    }
    else{
         date_type = '';
    }
    if((diffDays === 0) && (typeof(chart_type) === "undefined")){
        chart_type = Drupal.t('area');
        var chartColor = null;
    }
    if((diffDays > 92) && (typeof(chart_type) === "undefined")){
        chart_type = Drupal.t('area');
        var chartColor = ['#ffde00', '#68dac2', '#259ac6', '#e35635', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        chart_type = Drupal.t('area');
        var chartColor = ['#ffde00', '#68dac2', '#259ac6', '#e35635', '#ca0467', '#c322d1', '#6406bc', '#a60935', '#134f00', '#00847f'];
    }
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:50,right:50,bottom:60};
    var vAxis = Drupal.t('Hours');
    var showCurrency = false;
    var showLegend = true; 
    var doubleAxis = true; 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function chart_widget55(count, chart_type) {
    var widget_id = 'chart_widget55';
    var widget_loader_id = 'loaderDiv55';
    var type = 'ondemand-vs-reservation-count';
    var showCurrency = false;
    var chartColor = ['#fb438c', '#68dac2', '#ec3a70', '#3aec64', '#68d9da'];
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'donut')){
        chart_type = Drupal.t('donut');
    }
    var vAxis = Drupal.t('Count');
    var chartAreaSize = null;
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

function product_chart_widget47(dataCenter){
    dataCenterValue = dataCenter;
    jQuery( "div#homebox div.homebox-column-wrapper .data_center" ).each(function() {
        var widget_name = jQuery( this ).attr("id");
        var code = widget_name+"(5)";
        eval(code);
    });
}

function product_chart_widget17(tagnameId){
    var widget_id = 'chart_widget17';
    var widget_loader_id = 'loaderDiv17';
    var type = 'tag-values-of-tag-name';
    var showCurrency = true;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#660099', '#EB3C7D', '#FA6423', '#32A04B', '#0066CC', '#888888', '#DDDDDD', '#EEEEEE', '#134f00', '#00847f'];
    var vAxis = Drupal.t('Cost');
    tagname = tagnameId;
    product_cost_by_tags = jQuery('#chart_widget17_products').val();
    var count_products = jQuery("."+widget_id+" li[class='check']").find("span.results").html();
    if (count_products == Drupal.t('Top 5')){
        var count = 5;
    }
    else if (count_products == Drupal.t('Top 10')){
        var count = 10;
    }
    else if (count_products == Drupal.t('All')) {
        var count = 10000000;
    }  
    reset = true;
    google_chart_ajax_dropdown_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_keyval_chart_widget17(tagValId){
    var widget_id = 'chart_widget17';
    var widget_loader_id = 'loaderDiv17';
    var type = 'product-associated-to-tags';
    var showCurrency = true;
    reset = true;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#10b5e3', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    tagvalue = tagValId;
    tagname = jQuery("#chart_widget17_products" ).val();
    var count_products = jQuery("."+widget_id+" li[class='check']").find("span.results").html();
    if (count_products == Drupal.t('Top 5')){
        var count = 5;
    }
    else if (count_products == Drupal.t('Top 10')){
        var count = 10;
    }
    else if (count_products == Drupal.t('All')) {
        var count = 10000000;
    }   
    product_cost_by_tag_value = jQuery("#chart_widget17_products_val" ).val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_chart_widget18(tagnameId){
    var widget_id = 'chart_widget18';
    var widget_loader_id = 'loaderDiv18';
    var type = 'vm-count-tag-key';
    var showCurrency = false;
    tagname = tagnameId;
    vm_count_by_tag_key = jQuery('#chart_widget18_products').val();
    var chart_type = jQuery("#spend_provider_selected18" ).val();
    var chartColor = ['#10b5e3', '#42acea', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Count');
    var count= jQuery("#spend_filter_count_selected18" ).val();
    reset = true;
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_chart_widget19(tagnameId){
    var widget_id = 'chart_widget19';
    var widget_loader_id = 'loaderDiv19';
    var type = 'vm-cost-tag-key';
    var showCurrency = true;
    tagname = tagnameId;
    vm_cost_by_tag_key = jQuery('#chart_widget19_products').val();
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#f44e75', '#5cd2f4', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var count= 5;
    reset = true;
    showLegend = true;
    doubleAxis = true;
    var chartAreaSize = {width: '97%', height: '75%',top:15,left:70,right:60,bottom:60};
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym, showLegend, doubleAxis);
}

function product_chart_widget20(tagnameId){
    var widget_id = 'chart_widget20';
    var widget_loader_id = 'loaderDiv20';
    var type = 'tag-values-of-tag-name';
    change_chart = false;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#24e2f3', '#1295e1','#16c97f', '#ff7200', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var chartColor = null;
    var showCurrency = true;
    reset = true;
    tagname = tagnameId;
    tag_cost_trend = jQuery('#chart_widget20_products').val();
    var count= 5;
    google_chart_ajax_dropdown_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_keyval_chart_widget20(tagValId){
    var widget_id = 'chart_widget20';
    var widget_loader_id = 'loaderDiv20';
    var type = 'tag-cost-trend';
    var showCurrency = true;
    reset = true;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#24e2f3', '#1295e1','#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    tagvalue = tagValId;
    tagname = jQuery("#chart_widget20_products" ).val();
    var count= 5;
    tag_cost_trend_tag_value = jQuery("#chart_widget20_products_val" ).val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_chart_widget21(tagnameId){
    var widget_id = 'chart_widget21';
    var widget_loader_id = 'loaderDiv21';
    var type = 'tag-values-of-tag-name';
    var showCurrency = true;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#3de0de', '#42acea','#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var count_products = jQuery("."+widget_id+" li[class='check']").find("span.results").html();
    if (count_products == Drupal.t('Top 5')){
        var count = 5;
    }
    else if (count_products == Drupal.t('Top 10')){
        var count = 10;
    }
    else if (count_products == Drupal.t('All')) {
        var count = 10000000;
    } 
    tagname = tagnameId;
    instance_cost_by_tags = jQuery('#chart_widget21_products').val();
    reset = true;
    google_chart_ajax_dropdown_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_keyval_chart_widget21(tagValId){
    var widget_id = 'chart_widget21';
    var widget_loader_id = 'loaderDiv21';
    var type = 'instance-type-tags';
    var showCurrency = true;
    reset = true;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#3de0de', '#42acea','#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    tagvalue = tagValId;
    tagname = jQuery("#chart_widget21_products" ).val();
    instance_cost_tags_by_value = jQuery("#chart_widget21_products_val" ).val();
    var count_products = jQuery("."+widget_id+" li[class='check']").find("span.results").html();
    if (count_products == Drupal.t('Top 5')){
        var count = 5;
    }
    else if (count_products == Drupal.t('Top 10')){
        var count = 10;
    }
    else if (count_products == Drupal.t('All')) {
        var count = 10000000;
    } 
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_chart_widget27(providerId){
    var data_range = jQuery("#date_range_selected27").val();
    var currDate=moment();
    date_type = '';
    if(data_range=="3month"){
        var stDate=moment().subtract(90, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }else if(data_range=="6month"){
        var stDate=moment().subtract(180, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="12month"){
        var stDate=moment().subtract(365, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="ytd"){
        date_type = 'YTD';
        var stDate='01/01/'+moment().format('YYYY'); 
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    var widget_id = 'chart_widget27';
    var widget_loader_id = 'loaderDiv27';
    var type = 'saas-daily-trend-provider';
    var showCurrency = false;
    provider = providerId;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#3abdd5', '#42acea' ,'#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var showCurrency = true;
    var count= 5;
    reset = true;
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_chart_widget48(tagnameId){
    var widget_id = 'chart_widget48';
    var widget_loader_id = 'loaderDiv48';
    var type = 'tag-values-of-tag-name-private';
    change_chart = false;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#24e2f3', '#1295e1',  '#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var chartColor = null;
    var showCurrency = true;
    reset = true;
    tagname = tagnameId;
    var count= 5;
     // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_dropdown_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_keyval_chart_widget48(tagValId){
    var widget_id = 'chart_widget48';
    var widget_loader_id = 'loaderDiv48';
    var type = 'tag-cost-trend-private';
    var showCurrency = true;
    reset = true;
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    var chartColor = ['#24e2f3', '#1295e1','#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    tagvalue = tagValId;
    tagname = jQuery("#chart_widget48_products" ).val();
    var count= jQuery("#spend_filter_count_selected48" ).val();
    // remove below line later
    private_cloud_account = jQuery("#spend_provider_private").val();
    google_chart_ajax_request(widget_id, widget_loader_id, type, private_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_chart_widget50(tagnameId){
    var widget_id = 'chart_widget50';
    var widget_loader_id = 'loaderDiv50';
    var type = 'tag-values-of-tag-name-public';
    change_chart = false;
    var chart_type = Drupal.t('area');
    var chartColor = ['#24e2f3', '#1295e1','#16c97f','#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    var vAxis = Drupal.t('Cost');
    var chartColor = null;
    var showCurrency = true;
    reset = true;
    tagname = tagnameId;
    var count= 5;
    // remove below line later
    public_cloud_account = jQuery("#spend_provider_public").val();
    jQuery( "div#homebox div.homebox-column-wrapper .cloud_insights" ).each(function() {
	var widget_name = jQuery( this ).attr("id");
	var chart_loader_id = jQuery("#" + widget_name).parent().find(".loaderDiv").attr("id");
        jQuery("#"+widget_name).parent().find(".chart_filter_type").hide();
	jQuery("#"+widget_name).hide();
	jQuery("#"+chart_loader_id).show();
    });
    google_chart_ajax_dropdown_request(widget_id, widget_loader_id, type, public_cloud_account , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function product_keyval_chart_widget50(tagValId){
    tagvalue = tagValId;
    tagname = jQuery("#chart_widget50_products" ).val();
    jQuery( "div#homebox div.homebox-column-wrapper .cloud_insights" ).each(function() {
        var widget_name = jQuery( this ).attr("id");
        var code = widget_name+"(5)";
        eval(code);
    });
}

function saasProductFilter(productId, chart_type){
    var data_range = jQuery("#date_range_selected26").val();
    var currDate=moment();
    date_type = '';
    if(data_range=="3month"){
        var stDate=moment().subtract(90, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }else if(data_range=="6month"){
        var stDate=moment().subtract(180, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="12month"){
        var stDate=moment().subtract(365, 'days');
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    else if(data_range=="ytd"){
        date_type = 'YTD';
        var stDate='01/01/'+moment().format('YYYY'); 
        startdate = moment(stDate).format('YYYYMMDD');
        enddate = moment(currDate).format('YYYYMMDD');
    }
    
    var start = moment(startdate,'YYYYMMDD');
    var end = moment(enddate,'YYYYMMDD');
    var diffDays = end.diff(start, 'days');
    var startDateYear = moment().startOf('year').format('YYYYMMDD');
    var todayDate = moment().format('YYYYMMDD');
    var startCurrent = moment(startDateYear,'YYYYMMDD');
    var endCurrent = moment(todayDate,'YYYYMMDD');
    var totalDays = endCurrent.diff(startCurrent, 'days');
    var selectedYear = moment(startdate,'YYYYMMDD').format('YYYY');
    var currentYear = moment.utc(curdate).utcOffset(timeoffset).startOf('year').format('YYYY');
    var currentMonth = moment.utc(curdate).utcOffset(timeoffset).startOf('month').format('M');
    var monthArray = [ 2, 3 ];
        
    var widget_id = 'chart_widget26';
    var widget_loader_id = 'loaderDiv26';
    var type = 'saas-product-trend';
    product = productId;
    var count= 5;
    change_chart = false;
    var showCurrency = true;
    var vAxis = Drupal.t('Cost');
    if((selectedYear === currentYear) && (totalDays === diffDays) && (jQuery.inArray(parseInt(currentMonth), monthArray) > -1) && (diffDays != 0)){
        chart_type = Drupal.t('area');
        date_type = 'YTD';
        var chartColor = ['#42acea', '#10e4b4', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    }
    else{
         date_type = '';
    }
    if((diffDays > 92) && (typeof(chart_type) === "undefined")){
        var chart_type = Drupal.t('area');
        var chartColor = ['#42acea', '#10e4b4'];
    }
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        var chart_type = Drupal.t('area');
        var chartColor = ['#24e2f3', '#1295e1','#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    }
    if((chart_type != null)){
        reset = true;
    }
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, null, chartColor, vAxis, company_acronym);
}

function productFilter(productId, chart_type){
    var start = moment(startdate,'YYYYMMDD');
    var end = moment(enddate,'YYYYMMDD');
    var diffDays = end.diff(start, 'days');
    var startDateYear = moment().startOf('year').format('YYYYMMDD');
    var todayDate = moment().format('YYYYMMDD');
    var startCurrent = moment(startDateYear,'YYYYMMDD');
    var endCurrent = moment(todayDate,'YYYYMMDD');
    var totalDays = endCurrent.diff(startCurrent, 'days');
    var selectedYear = moment(startdate,'YYYYMMDD').format('YYYY');
    var currentYear = moment.utc(curdate).utcOffset(timeoffset).startOf('year').format('YYYY');
    var currentMonth = moment.utc(curdate).utcOffset(timeoffset).startOf('month').format('M');
    var monthArray = [ 2, 3 ];
    var widget_id = 'chart_widget6';
    var widget_loader_id = 'loaderDiv6';
    var type = 'product-trend';
    product = productId;
    var count= 5;
    change_chart = false;
    var showCurrency = true;
    var vAxis = Drupal.t('Cost');
    if((selectedYear === currentYear) && (totalDays === diffDays) && (jQuery.inArray(parseInt(currentMonth), monthArray) > -1) && (diffDays != 0)){
        chart_type = Drupal.t('area');
        date_type = 'YTD';
        var chartColor = ['#42acea', '#10e4b4', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    }
    else{
         date_type = '';
    }
    if((diffDays > 92) && (typeof(chart_type) === "undefined")){
        var chart_type = Drupal.t('area');
        var chartColor = ['#42acea', '#10e4b4', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    }
    var chart_type = jQuery("."+widget_id+" li[class='check']").find("span.display").html().toLowerCase();
    product_cost_trend = jQuery('#product_trend_products').val();
    if ((typeof(chart_type) === "undefined") || (chart_type === null) || (chart_type === 'area')){
        var chart_type = Drupal.t('area');
        var chartColor = ['#24e2f3', '#1295e1','#16c97f', '#e41f81', '#fb461d', '#c322d1', '#6406bc'];
    }
    jQuery("."+widget_id+" li").each(function(index, value){
        var lival = jQuery(this).find("span.display").html();
        if((typeof(lival) !== "undefined")){
            if((lival.toUpperCase()) === (chart_type.toUpperCase())){
                jQuery(this).removeClass('unchecked');
            }
            else{
                jQuery(this).addClass('unchecked');
            }
        }
    });
    if((chart_type != null)){
        reset = true;
    }
    var chartAreaSize = {width: '97%', height: '25%',top:15,left:90,right:20,bottom:80};
    google_chart_ajax_request(widget_id, widget_loader_id, type, provider , count, chart_type, showCurrency, chartAreaSize, chartColor, vAxis, company_acronym);
}

(function( $ ) {
    Drupal.behaviors.jsdn_google_chart = {
        attach: function (context, settings) {
          provider = settings.jsdn_google_chart.provider;
          currencySymbol = settings.jsdn_google_chart.currencySymbol;
		  currencyLocale = settings.jsdn_google_chart.currencyLocale;
		  currencyPattern = settings.jsdn_google_chart.currencyPattern;
		  currencyFraction = settings.jsdn_google_chart.currencyFraction;
          pageType = settings.jsdn_google_chart.pageType;
          baseURL = settings.jsdn_google_chart.baseUrl;
          empty_message = settings.jsdn_google_chart.empty_message;
          error_message = settings.jsdn_google_chart.error_message;
          tag_key_label = settings.jsdn_google_chart.tag_key_label;
          provider_account = settings.jsdn_google_chart.provider_account;
          private_cloud_account = settings.jsdn_google_chart.private_cloud;
          public_cloud_account = settings.jsdn_google_chart.public_cloud;
        }
    };
    $( document ).ready(function() {
        $(".migrationPage .portlet-title").unbind("dblclick");
        company_acronym = $("#company_acronym").val();
        reset = true;
        $( "#spend_provider_selected1" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(this).val();
            chart_widget1(5, chart_type);
        });
         $( "#spend_provider_selected6" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(this).val();
            productFilter(product, chart_type);
        });
        $( "#spend_provider_selected7" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected7" ).val();
            var count_products = $("#spend_filter_count_selected7").val();
            chart_widget7(count_products, chart_type);
        });
        $( "#spend_filter_count_selected7" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected7" ).val();
            var count_products = $("#spend_filter_count_selected7").val();
            chart_widget7(count_products, chart_type);
        });
        $( "#spend_provider_selected8" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected8" ).val();
            var count_products = $("#spend_filter_count_selected8").val();
            chart_widget8(count_products, chart_type);
        });
        $( "#spend_filter_count_selected8" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected8" ).val();
            var count_products = $("#spend_filter_count_selected8").val();
            chart_widget8(count_products, chart_type);
        });
        $( "#spend_provider_selected9" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected9" ).val();
            var count_products = $("#spend_filter_count_selected9").val();
            chart_widget9(count_products, chart_type);
        });
        $( "#spend_filter_count_selected9" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected9" ).val();
            var count_products = $("#spend_filter_count_selected9").val();
            chart_widget9(count_products, chart_type);
        });
        $( "#spend_provider_selected10" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected10" ).val();
            var count_products = $("#spend_filter_count_selected10").val();
            chart_widget10(count_products, chart_type);
        });
        $( "#spend_filter_count_selected10" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected10" ).val();
            var count_products = $("#spend_filter_count_selected10").val();
            chart_widget10(count_products, chart_type);
        });
        $( "#spend_provider_selected11" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(this).val();
            chart_widget11(5, chart_type);
        });
        $( "#spend_provider_selected12" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(this).val();
            chart_widget12(5, chart_type);
        });
        $( "#spend_provider_selected13" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected13" ).val();
            var count_products = $("#spend_filter_count_selected13").val();
            chart_widget13(count_products, chart_type);
        });
        $( "#spend_filter_count_selected13" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected13" ).val();
            var count_products = $("#spend_filter_count_selected13").val();
            chart_widget13(count_products, chart_type);
        });
        $( "#spend_provider_selected14" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected14" ).val();
            var count_products = $("#spend_filter_count_selected14").val();
            chart_widget14(count_products, chart_type);
        });
        $( "#spend_filter_count_selected14" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected14" ).val();
            var count_products = $("#spend_filter_count_selected14").val();
            chart_widget14(count_products, chart_type);
        });
        $( "#spend_provider_selected16" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected16" ).val();
            var count_products = $("#spend_filter_count_selected16").val();
            chart_widget16(count_products, chart_type);
        });
        $( "#spend_filter_count_selected16" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected16" ).val();
            var count_products = $("#spend_filter_count_selected16").val();
            chart_widget16(count_products, chart_type);
        });
        $( "#spend_provider_selected17" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected17" ).val();
            var count_products = $("#spend_filter_count_selected17").val();
            chart_widget17(count_products, chart_type, widget_change);
        });
        $( "#spend_filter_count_selected17" ).change(function() {
            reset = true;
            change_chart = true;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected17" ).val();
            var count_products = $("#spend_filter_count_selected17").val();
            chart_widget17(count_products, chart_type, widget_change);
        });
        $( "#spend_provider_selected18" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected18" ).val();
            var count_products = $("#spend_filter_count_selected18").val();
            chart_widget18(count_products, chart_type, widget_change);
        });
        $( "#spend_filter_count_selected18" ).change(function() {
            reset = true;
            change_chart = true;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected18" ).val();
            var count_products = $("#spend_filter_count_selected18").val();
            chart_widget18(count_products, chart_type, widget_change);
        });
        $( "#spend_provider_selected19" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected19" ).val();
            var count_products = $("#spend_filter_count_selected19").val();
            chart_widget19(count_products, chart_type, widget_change);
        });
        $( "#spend_filter_count_selected19" ).change(function() {
            reset = true;
            change_chart = true;            
            var widget_change = true;
            var chart_type = $("#spend_provider_selected19" ).val();
            var count_products = $("#spend_filter_count_selected19").val();
            chart_widget19(count_products, chart_type, widget_change);
        });
        $( "#spend_provider_selected20" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected20" ).val();
            var count_products = $("#spend_filter_count_selected20").val();
            chart_widget20(count_products, chart_type, widget_change);
        });
        $( "#spend_provider_selected21" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected21" ).val();
            var count_products = $("#spend_filter_count_selected21").val();
            chart_widget21(count_products, chart_type, widget_change);
        });
        $( "#spend_filter_count_selected21" ).change(function() {
            reset = true;
            change_chart = true;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected21" ).val();
            var count_products = $("#spend_filter_count_selected21").val();
            chart_widget21(count_products, chart_type, widget_change);
        });
        $( "#spend_provider_selected23" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(this).val();
            chart_widget23(5, chart_type);
        });
        
        $( "#spend_provider_selected24" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected24" ).val();
            var data_range = $("#date_range_selected24").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget24(5, chart_type);
        });
        
        $( "#spend_provider_selected25" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(".chart_widget25 li[class='check']").find("span.display").html().toLowerCase();
            var count_products = $("#spend_filter_count_selected25").val();
            var data_range = $("#date_range_selected25").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget25(count_products, chart_type);
        });
        
        $( "#spend_filter_count_selected25" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $(".chart_widget25 li[class='check']").find("span.display").html().toLowerCase();
            var count_products = $("#spend_filter_count_selected25").val();
            var data_range = $("#date_range_selected25").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            
            chart_widget25(count_products, chart_type);
        });
        
        $( "#spend_provider_selected26" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(".chart_widget26 li[class='check']").find("span.display").html().toLowerCase();
            product = jQuery('#product_trend_products').val();
            var data_range = $("#date_range_selected26").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget26(5, chart_type);
        });
        
        $( "#spend_provider_selected27" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $(".chart_widget27 li[class='check']").find("span.display").html().toLowerCase();
            tagname = $("#chart_widget27_products" ).val();
            var data_range = $("#date_range_selected27").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget27(5, chart_type, widget_change);
        });
        
        $( "#date_range_selected24" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(".chart_widget24 li[class='check']").find("span.display").html().toLowerCase();
            var data_range = $("#date_range_selected24").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget24(5, chart_type);
        });

        $( "#date_range_selected25" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(".chart_widget25 li[class='check']").find("span.display").html().toLowerCase();
            var count_products = $(".chart_widget25 li[class='check']").find("span.results").html();
            if (count_products == Drupal.t('Top 5')){
                count_products = '5';
            }
            else if (count_products == Drupal.t('Top 10')){
                count_products = '10';
            }
            else if (count_products == Drupal.t('All')) {
                count_products = '10000000';
            }                             
            var data_range = $("#date_range_selected25").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget25(count_products, chart_type);
        });

        $( "#date_range_selected26" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(".chart_widget26 li[class='check']").find("span.display").html().toLowerCase();
            product = jQuery('#product_trend_products').val();
            var data_range = $("#date_range_selected26").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget26(5, chart_type);
        });

        $( "#date_range_selected27" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(".chart_widget27 li[class='check']").find("span.display").html().toLowerCase();
            var data_range = $("#date_range_selected27").val();
            var currDate=moment();
            date_type = '';
            if(data_range=="3month"){
                var stDate=moment().subtract(90, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }else if(data_range=="6month"){
                var stDate=moment().subtract(180, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="12month"){
                var stDate=moment().subtract(365, 'days');
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            else if(data_range=="ytd"){
                date_type = 'YTD';
                var stDate='01/01/'+moment().format('YYYY'); 
                startdate = moment(stDate).format('YYYYMMDD');
                enddate = moment(currDate).format('YYYYMMDD');
            }
            chart_widget27(5, chart_type);
        });
        
        $( "#spend_provider_selected28" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $(this).val();
            if (chart_type === 'column'){   
                is_stacked = true;
            }
            else{
                is_stacked = false;
            }
            chart_widget28(5, chart_type);
        });
        $( "#spend_provider_selected30" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected30" ).val();
            var count_products = $("#spend_filter_count_selected30").val();
            chart_widget30(count_products, chart_type);
        });
        $( "#spend_filter_count_selected30" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected30" ).val();
            var count_products = $("#spend_filter_count_selected30").val();
            chart_widget30(count_products, chart_type);
        });
        
        $( "#spend_provider_selected31" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected31" ).val();
            var count_products = $("#spend_filter_count_selected31").val();
            chart_widget31(count_products, chart_type);
        });
        $( "#spend_filter_count_selected31" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected31" ).val();
            var count_products = $("#spend_filter_count_selected31").val();
            chart_widget31(count_products, chart_type);
        });
        
        $( "#spend_provider_selected32" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected32" ).val();
            var count_products = $("#spend_filter_count_selected32").val();
            chart_widget32(count_products, chart_type);
        });
        $( "#spend_filter_count_selected32" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected32" ).val();
            var count_products = $("#spend_filter_count_selected32").val();
            chart_widget32(count_products, chart_type);
        });
        $( "#spend_provider_selected33" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected33" ).val();
            var count_products = $("#spend_filter_count_selected33").val();
            chart_widget33(count_products, chart_type);
        });
        $( "#spend_filter_count_selected33" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected33" ).val();
            var count_products = $("#spend_filter_count_selected33").val();
            chart_widget33(count_products, chart_type);
        });
        $( "#spend_provider_selected34" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected34" ).val();
            var count_products = $("#spend_filter_count_selected34").val();
            chart_widget34(count_products, chart_type);
        });
        $( "#spend_filter_count_selected34" ).change(function() {
            reset = true;
            change_chart = true;
            var chart_type = $("#spend_provider_selected34" ).val();
            var count_products = $("#spend_filter_count_selected34").val();
            chart_widget34(count_products, chart_type);
        });
        $( "#spend_provider_selected37" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected37" ).val();
            var count_products = 5;
            chart_widget37(count_products, chart_type);
        });
	$( "#spend_provider_selected38" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected38" ).val();
            var count_products = 5;
            chart_widget38(count_products, chart_type);
        });
        $( "#spend_provider_selected39" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected39" ).val();
            var count_products = 5;
            chart_widget39(count_products, chart_type);
        });
        $( "#spend_provider_selected40" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected40" ).val();
            var count_products = 5;
            chart_widget40(count_products, chart_type);
        });
        $( "#spend_provider_selected42" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected42" ).val();
            var count_products = 5;
            chart_widget42(count_products, chart_type);
        });
        $( "#spend_provider_selected43" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected43" ).val();
            var count_products = 5;
            chart_widget43(count_products, chart_type);
        });
        $( "#spend_provider_selected44" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected44" ).val();
            var count_products = 5;
            chart_widget44(count_products, chart_type);
        });
        $( "#spend_provider_selected45" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected45" ).val();
            var count_products = 5;
            chart_widget45(count_products, chart_type);
        });
        $( "#spend_provider_selected46" ).change(function() {
            reset = true;
            change_chart = false;
            var chart_type = $("#spend_provider_selected46" ).val();
            var count_products = 5;
            chart_widget46(count_products, chart_type);
        });
        $( "#spend_provider_selected48" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected48" ).val();
            var count_products = 5;
            chart_widget48(count_products, chart_type, widget_change);
        });
        $( "#spend_provider_selected49" ).change(function() {
            reset = true;
            change_chart = false;
            var widget_change = true;
            var chart_type = $("#spend_provider_selected49" ).val();
            var count_products = 5;
            chart_widget49(count_products, chart_type, widget_change);
        });
        $('.widget-info-icon').bt({ fill: '#fff',strokeStyle:'#B7B7B7',spikeLength: 10,spikeGirth: 10,padding: 8,cornerRadius: 0,positions: ['left','bottom','top'],trigger: 'click',cssStyles:{width:'500px'},closeWhenOthersOpen:true});
    });
})( jQuery );
