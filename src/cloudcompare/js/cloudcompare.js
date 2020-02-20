$(document).ready(function(){           
    $('#increase_vcpu').click(function(e){
        e.preventDefault();
        var currentVal = parseInt($('#cpuval').val());
        if (!isNaN(currentVal)) {
          if(currentVal<264){
                $('#cpuval').val(currentVal + 1);
                $("#cpuval").trigger("change");
            }
        } else {
                $('#cpuval').val(1);
        }
    });
   
    $("#decrease_vcpu").click(function(e) {
        e.preventDefault();  
        var currentVal = parseInt($('#cpuval').val());
     
        if (!isNaN(currentVal) && currentVal > 1) {      
            $('#cpuval').val(currentVal - 1);
            $("#cpuval").trigger("change");
        } else {
            $('#cpuval').val(1);
        }
    });
	
    $('#increase_memory').click(function(e){
        e.preventDefault();
        var  currentVal = parseInt($("#memval").val());
        if (!isNaN(currentVal)) {
            if(currentVal<3904){
                $("#memval").val(currentVal + 1);
                $("#memval").trigger("change");
            }
        } else {
                $("#memval").val(0);
        }
    });
   
    $("#decrease_memory").click(function(e) {
        e.preventDefault();
        var currentVal = parseInt($('#memval').val());
        
        if (!isNaN(currentVal) && currentVal > 1) {
            $('#memval').val(currentVal - 1);
            $("#memval").trigger("change");
        } else {
            $('#memval').val(1);
        }
    });
	
    $('#increase_disc').click(function(e){
        e.preventDefault();
        var  currentVal = parseInt($('#discval').val());
        if (!isNaN(currentVal)) {
            if(currentVal<10000){
                $('#discval').val(currentVal + 1);
                $("#discval").trigger("change");
            }
        } else {
            $('#discval').val(1);
        }
    });
   
    $("#decrease_disc").click(function(e) {
        e.preventDefault();
        var currentVal = parseInt($('#discval').val());
        
        if (!isNaN(currentVal) && currentVal > 1) {
            $('#discval').val(currentVal - 1);
            $("#discval").trigger("change");
        } else { 
            $('#discval').val(1);
        }
    });
    
    $('#increase_storage').click(function(e){
        e.preventDefault();
        var currentVal = parseInt($('#storageval').val());
        if (!isNaN(currentVal)) {
          if(currentVal<1000000){
                $('#storageval').val(currentVal + 1);
                $("#storageval").trigger("change");
            }
        } else {
                $('#storageval').val(1);
        }
    });
   
    $("#decrease_storage").click(function(e) {
        e.preventDefault();  
        var currentVal = parseInt($('#storageval').val());
     
        if (!isNaN(currentVal) && currentVal > 1) {      
            $('#storageval').val(currentVal - 1);
            $("#storageval").trigger("change");
        } else {
            $('#storageval').val(1);
        }
    });
    
    $('#increase_transfer').click(function(e){
        e.preventDefault();
        var currentVal = parseInt($('#transferval').val());
        if (!isNaN(currentVal)) {
          if(currentVal<1000000){
                $('#transferval').val(currentVal + 1);
                $("#transferval").trigger("change");
            }
        } else {
                $('#transferval').val(1);
        }
    });
   
    $("#decrease_transfer").click(function(e) {
        e.preventDefault();  
        var currentVal = parseInt($('#transferval').val());
     
        if (!isNaN(currentVal) && currentVal > 1) {      
            $('#transferval').val(currentVal - 1);
            $("#transferval").trigger("change");
        } else {
            $('#transferval').val(1);
        }
    });
    
    $('#increase_get').click(function(e){
        e.preventDefault();
        var currentVal = parseInt($('#getval').val());
        if (!isNaN(currentVal)) {
          if(currentVal<10000000){
                $('#getval').val(currentVal + 10000);
                $("#getval").trigger("change");
            }
        } else {
                $('#getval').val(10000);
        }
    });
   
    $("#decrease_get").click(function(e) {
        e.preventDefault();  
        var currentVal = parseInt($('#getval').val());
     
        if (!isNaN(currentVal) && currentVal > 10000) {      
            $('#getval').val(currentVal - 10000);
            $("#getval").trigger("change");
        } else {
            $('#getval').val(10000);
        }
    });
    
    $('#increase_put').click(function(e){
        e.preventDefault();
        var currentVal = parseInt($('#putval').val());
        if (!isNaN(currentVal)) {
          if(currentVal<10000000){
                $('#putval').val(currentVal + 1000);
                $("#putval").trigger("change");
            }
        } else {
                $('#putval').val(1000);
        }
    });
   
    $("#decrease_put").click(function(e) {
        e.preventDefault();  
        var currentVal = parseInt($('#putval').val());
     
        if (!isNaN(currentVal) && currentVal > 1000) {      
            $('#putval').val(currentVal - 1000);
            $("#putval").trigger("change");
        } else {
            $('#putval').val(1000);
        }
    });
	
    $("#cpuval,#memval,#discval").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
   
    $('body').on('click', '.opentierwindow', function(){
        var planDetailsDiv=$(this).attr('plandiv');		
        $('#'+planDetailsDiv+'').dialog({
                modal: true,
                title: 'View Reserved Price',
                width : '800',
                resizable : 'FALSE',
                position:'center',
                draggable : 'FALSE',
                dialogClass : 'reservedPrice',
                buttons: {
                        Close: function() { $(this).dialog( "close" ); },
                }
        });
    });
}); 


$( document ).ready(function() { 
    var widget_id = 'chart_widget1';
    var widget_loader_id = 'loaderDiv1';
    var region = $("#region" ).val();
    var os_type = $("#os" ).val() ? $("#os" ).val() : '';
    var db_type = $("#db" ).val() ? $("#db" ).val() : '';
    var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
    var cpu_type = parseInt($('#cpuval').val());
    var memory_type =  parseInt($("#memval").val());
    var disc_type = parseInt($('#discval').val());
    var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
    var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
    var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
    var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
    var uri = window.location.href;
    
    $.urlParam = $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null){
           return null;
        }
        else{
           return decodeURI(results[1]) || 0;
        }
    }
    var page_type = $.urlParam('q') ? $.urlParam('q'): 'vm';
    
    price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
    
    $( "#region" ).change(function() {
            var widget_id = 'chart_widget1';
            var widget_loader_id = 'loaderDiv1';
            var region = $("#region" ).val();
            var os_type = $("#os" ).val() ? $("#os" ).val() : '';
            var db_type = $("#db" ).val() ? $("#db" ).val() : '';
            var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
            var cpu_type = parseInt($('#cpuval').val());
            var memory_type =  parseInt($("#memval").val());
            var disc_type = parseInt($('#discval').val());
            var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
            var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
            var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
            var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';

            price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
    });

    $( "#os" ).change(function() {
            var widget_id = 'chart_widget1';
            var widget_loader_id = 'loaderDiv1';
            var region = $("#region" ).val();
            var os_type = $("#os" ).val() ? $("#os" ).val() : '';
            var db_type = $("#db" ).val() ? $("#db" ).val() : '';
            var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
            var cpu_type = parseInt($('#cpuval').val());
            var memory_type =  parseInt($("#memval").val());
            var disc_type = parseInt($('#discval').val());
            var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
            var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
            var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
            var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';

            price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
    });
    
    $( "#db" ).change(function() {
            var widget_id = 'chart_widget1';
            var widget_loader_id = 'loaderDiv1';
            var region = $("#region" ).val();
            var os_type = $("#os" ).val() ? $("#os" ).val() : '';
            var db_type = $("#db" ).val() ? $("#db" ).val() : '';
            var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
            var cpu_type = parseInt($('#cpuval').val());
            var memory_type =  parseInt($("#memval").val());
            var disc_type = parseInt($('#discval').val());
            var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
            var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
            var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
            var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';

            price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
    });
    
     $( "#lb" ).change(function() {
            var widget_id = 'chart_widget1';
            var widget_loader_id = 'loaderDiv1';
            var region = $("#region" ).val();
            var os_type = $("#os" ).val() ? $("#os" ).val() : '';
            var db_type = $("#db" ).val() ? $("#db" ).val() : '';
            var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
            var cpu_type = '';
            var memory_type =  '';
            var disc_type ='';
            var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
            var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
            var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
            var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';

            price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
    });

    $('#cpuval').change(function () {
            var widget_id = 'chart_widget1';
            var widget_loader_id = 'loaderDiv1';
            var region = $("#region" ).val();
            var os_type = $("#os" ).val() ? $("#os" ).val() : '';
            var db_type = $("#db" ).val() ? $("#db" ).val() : '';
            var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
            var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
            var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
            var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
            var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
            var cpu_type = $("#cpuval" ).val();
            if(cpu_type<=264){
                cpu_type = $("#cpuval" ).val();
            }
            else{
                $("#cpuval" ).val(264);
                cpu_type = $("#cpuval" ).val();
            }
            var memory_type = $("#memval" ).val();
            var disc_type = $("#discval" ).val();
            var input = parseInt(this.value);
            if(cpu_type<=264){
                price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
            }
    });

    $('#memval').change(function () {
            var widget_id = 'chart_widget1';
            var widget_loader_id = 'loaderDiv1';
            var region = $("#region" ).val();
            var os_type = $("#os" ).val() ? $("#os" ).val() : '';
            var db_type = $("#db" ).val() ? $("#db" ).val() : '';
            var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
            var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
            var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
            var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
            var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
            var cpu_type = $("#cpuval" ).val();
            var memory_type = $("#memval" ).val();
            if(memory_type<=3904){
                memory_type = $("#memval" ).val();
            }
            else{
                $("#memval" ).val(3904);
                memory_type = $("#memval" ).val();
            }
            var disc_type = $("#discval" ).val();
            if(memory_type<=3904){
                price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
            }
    });

    $('#discval').change(function () {
        var widget_id = 'chart_widget1';
        var widget_loader_id = 'loaderDiv1';
        var region = $("#region" ).val();
        var os_type = $("#os" ).val() ? $("#os" ).val() : '';
        var db_type = $("#db" ).val() ? $("#db" ).val() : '';
        var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
        var cpu_type = $("#cpuval" ).val();
        var memory_type = $("#memval" ).val();
        var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
        var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
        var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
        var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
        var disc_type = $("#discval" ).val();
        if(disc_type<=10000){
            disc_type = $("#discval" ).val();
        }
        else{
            $("#discval" ).val(10000);
            disc_type = $("#discval" ).val();
        }
        if(disc_type<=10000){
            price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
        }
    });
    
    $('#storageval').change(function () {
            var widget_id = 'chart_widget1';
            var widget_loader_id = 'loaderDiv1';
            var region = $("#region" ).val();
            var os_type = $("#os" ).val() ? $("#os" ).val() : '';
            var db_type = $("#db" ).val() ? $("#db" ).val() : '';
            var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
            var cpu_type = $("#cpuval" ).val() ? $("#cpuval" ).val() : '';
            var memory_type = $("#memval" ).val() ? $("#memval" ).val() : '';
            var disc_type = $("#discval" ).val() ? $("#discval" ).val() : '';
            var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
            var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
            var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
            var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
            if(storage<=1000000){
                storage = $("#storageval" ).val();
            }
            else{
                $("#storageval" ).val(1000000);
                storage = $("#storageval" ).val();
            }
            if(storage<=1000000){
                price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
            }
    });
    
    $('#transferval').change(function () {
        var widget_id = 'chart_widget1';
        var widget_loader_id = 'loaderDiv1';
        var region = $("#region" ).val();
        var os_type = $("#os" ).val() ? $("#os" ).val() : '';
        var db_type = $("#db" ).val() ? $("#db" ).val() : '';
        var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
        var cpu_type = $("#cpuval" ).val() ? $("#cpuval" ).val() : '';
        var memory_type = $("#memval" ).val() ? $("#memval" ).val() : '';
        var disc_type = $("#discval" ).val() ? $("#discval" ).val() : '';
        var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
        var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
        var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
        var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
        if(transfer<=10240){
                transfer = $("#transferval" ).val();
        }
        else{
                $("#transferval" ).val(1000000);
                transfer = $("#transferval" ).val();
        }
        if(storage<=1000000){
                price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
        }
    });
    
    $('#getval').change(function () {
        var widget_id = 'chart_widget1';
        var widget_loader_id = 'loaderDiv1';
        var region = $("#region" ).val();
        var os_type = $("#os" ).val() ? $("#os" ).val() : '';
        var db_type = $("#db" ).val() ? $("#db" ).val() : '';
        var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
        var cpu_type = $("#cpuval" ).val() ? $("#cpuval" ).val() : '';
        var memory_type = $("#memval" ).val() ? $("#memval" ).val() : '';
        var disc_type = $("#discval" ).val() ? $("#discval" ).val() : '';
        var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
        var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
        var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
        var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
        if(get_request<=10000000){
                get_request = $("#getval" ).val();
        }
        else{
                $("#getval" ).val(10000);
                get_request = $("#getval" ).val();
        }
        if(get_request<=10000000){
                price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
        }
    });
    
    $('#putval').change(function () {
        var widget_id = 'chart_widget1';
        var widget_loader_id = 'loaderDiv1';
        var region = $("#region" ).val();
        var os_type = $("#os" ).val() ? $("#os" ).val() : '';
        var db_type = $("#db" ).val() ? $("#db" ).val() : '';
        var lb_type = $("#lb" ).val() ? $("#lb" ).val() : '';
        var cpu_type = $("#cpuval" ).val() ? $("#cpuval" ).val() : '';
        var memory_type = $("#memval" ).val() ? $("#memval" ).val() : '';
        var disc_type = $("#discval" ).val() ? $("#discval" ).val() : '';
        var transfer = $("#transferval" ).val() ? $("#transferval" ).val() : '';
        var get_request = $("#getval" ).val() ? $("#getval" ).val() : '';
        var post_request = $("#putval" ).val() ? $("#putval" ).val() : '';
        var storage = $("#storageval" ).val() ? $("#storageval" ).val() : '';
        if(post_request<=10000000){
                post_request = $("#putval" ).val();
        }
        else{
                $("#putval" ).val(10000);
                post_request = $("#putval" ).val();
        }
        if(post_request<=10000000){
                price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request);
        }
    });
    
    $( ".openerwishlist" ).click(function(event) {		
        $('#wishlist').dialog({
                modal: true,
                title: 'Wishlist',
                width : '80%',
                resizable : 'FALSE',
                position:'center',
                draggable : 'FALSE',
                dialogClass : 'reservedPrice',
                open: function( event, ui ) {$('.wishlistWrapperScroll').jScrollPane();}
        });
    });
});


function price_compare_ajax_request(widget_id, widget_loader_id, region, os_type, db_type, lb_type, cpu_type , memory_type, disc_type, page_type, storage, transfer, get_request, post_request){
    var fields = {region: region, os_type: os_type, db_type: db_type, lb_type: lb_type, cpu_type: cpu_type, memory_type: memory_type, disc_type: disc_type, storage: storage, transfer: transfer, get_request: get_request, post_request: post_request};
    var filename = '';
    if(page_type == 'vm'){
        filename = 'process_request.php';
    }
    else if(page_type == 'rds'){
        filename = 'process_request_rds.php';
    }
    else if(page_type == 'storage'){
        filename = 'process_request_storage.php';
    }
    else{
        filename = 'process_request_elb.php';
    }
    $.ajax({  
        type: "POST",  
        url: filename,
        data: fields,
        beforeSend: function(){
            jQuery("#"+widget_loader_id).show();
            jQuery("#"+widget_id).hide();
        },
        error: function(error){
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).show();
        },
        success: function(chart_result) {
            jQuery("#"+widget_id).show();
            jQuery("#"+widget_loader_id).hide();
            jQuery("#"+widget_id).html(chart_result);
            jQuery('.border-dark').equalHeights();
            setTimeout(function(){$('.left').height($('.right').height());}, 100);
        }
    });
}