<?php
$timeoffset = json_decode($_SESSION['MenuJSON'])->locale->offset;
$filters = $filter_type;
$info = date('Y-m-d H:i:s');
$style = '';
if(empty($filters)){
    $style = 'style="display: none"';
}
?>
<select id="spend_provider_private" <?php echo $style;?>>           
    <?php  foreach ($filters as $providers){  ?>
    <option value="<?php echo $providers['key'];?>"><?php echo $providers['value'];?></option>
    <?php }?>
</select>
<script type="text/javascript">
    (function( $ ) {
        $( document ).ready(function() { 	
            $( "#spend_provider_private" ).change(function() {
                private_cloud_account = $("#spend_provider_private").val();
                spend_provider_refresh_private_widget();
        });
    });
})( jQuery );

function spend_provider_refresh_private_widget() {  
    jQuery( "div#homebox div.homebox-column-wrapper .private_cloud" ).each(function() {
        var widget_name = jQuery( this ).attr("id");
        var code = widget_name+"(5)";
        eval(code);
    });
}

</script>