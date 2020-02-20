<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$instanceID=$_POST['instanceID'];
$InstanceData=$_SESSION['google_cloud_instances'];


foreach($InstanceData as $instance){
    if($instanceID==$instance['id']){
        $instanceArray=$instance;
        foreach($instance['disks'] as $disk){
            $devices_source = $disk[source];
			$devices_source = explode('/', $devices_source);
			$devices[] = $devices_source[10];
            if($disk['boot']){
                $source = $disk['source'];
            }
        }
    }
}  

foreach($_SESSION['google_cloud_volumes'] as $volume){
    foreach($devices as $device){
        if($volume['name'] == $device){
            $currentVolumes[]=$volume;
        }
    }
} 


$ipaddresses=$_SESSION['google_cloud_ipaddresses'];
$ip_address = $instanceArray['networkInterfaces'][0]['accessConfigs'][0]['natIP'];
foreach ($ipaddresses as $ip) {
    if($ip_address==$ip['address']){
        $ipArray[]=$ip;
    }
}
$ipArray[0]['elastic_ip'] = $instanceArray['networkInterfaces'][0]['accessConfigs'][0]['natIP'];
$ipArray[0]['private_ip'] = $instanceArray['networkInterfaces'][0]['networkIP'];

$snapshots=$_SESSION['google_cloud_snapshots'];
foreach($snapshots as $snaps){
    if($snaps['sourceDisk'] == $source){
        $currentSnapShots[]=$snaps;
    }
}

$images=$_SESSION['google_cloud_images'];


?> 
<tr class="inventory_app border_bottom asso-resources" id="data_tr_<?php echo $instanceID?>">
<td colspan="9"> 
<?php if(@$currentVolumes){?>
    <div  id="inv_vol" class="slider volume">
        <p id="p_top"><?php print t('Attached Volumes');?></p>
        <ul>
        <?php 
        $totalVolumes=count($currentVolumes);
        foreach($currentVolumes as $v=>$volumeData){ 
            $volumetype = explode('/', $volumeData['type']);
            $volumezone = explode('/', $volumeData['zone']);
            ?>
            <li>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Volume Name');?>: </span> <?php echo $volumeData['name']?></p> 
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Volume ID');?>: </span> <?php echo @$volumeData['id']?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Size');?>: </span> <?php echo $volumeData['sizeGb'] ? $volumeData['sizeGb']. 'GB' : '';?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Volume Type');?>: </span> <?php echo $volumetype[10]?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Status');?>: </span> <?php echo ucfirst(strtolower($volumeData['status']));?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Created Time');?>: </span> <span class="<?php echo @$volumeData['id']?>"><?php echo @$volumeData['creationTimestamp'];?></span></p> 
                <p class="inven_bottom_p"><span class="bold_label"><?php if(@$volumeData['description']) {?><?php print t('Description');?>: </span> <span title="<?php echo @$volumeData['description'];?>"><?php echo mb_strimwidth( @$volumeData['description'], 0, 30 ,"...");}?></span></p>
                <script>
                    var datetoconvert = jQuery('.<?php echo @$volumeData['id']?>').html();
                    var convertedDate = moment.utc(''+datetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
                    jQuery('.<?php echo @$volumeData['id']?>').html(convertedDate);
                </script>
            <?php if($totalVolumes > 1){?><div class="countData"> <?php print t('Volumes');?> : <span><?php echo $v+1?> / <?php echo $totalVolumes?></span><?php }?></div>
            </li> 
        <?php }?>
        </ul>
        <?php if($v>0){?>
        <div class="bottom-icons"> 
            <div class="volumeCount count-element"></div> 
            <a class="control_prev" rel="volume"></a>
            <a  class="control_next" rel="volume"></a>
        </div>
        <?php }?>
    </div> 
<?php }?>
<?php if(@$ipArray){?>
    <div  class="inv_voldiv slider">
        <p  id="p_top"><?php print t('Public IP');?></p>
        <ul>
        <?php foreach($ipArray as $i=>$IPData){ ?>
            <li>
            <p class="inven_bottom_p"><span class="bold_label"><?php if($IPData['elastic_ip']) {?><?php print t('Public IP');?>: </span> <?php echo @$IPData['elastic_ip'];}?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Private IP');?>: </span> <?php echo @$IPData['private_ip'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php if($IPData['name']) {?><?php print t('Name');?>: </span> <?php echo @$IPData['name'];}?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php if($IPData['description']) {?><?php print t('Description');?>: </span> <?php echo @$IPData['description'];}?></p>
        <?php }?>
        </ul>
    </div> 
<?php }?>
<?php if(@$currentSnapShots){?>
    <div class="inv_voldiv slider snapshot" >
        <p id="p_top"><?php print t('Snapshots');?></p>
        <ul>
        <?php 
        $totalSnapshots=count($currentSnapShots);
        foreach($currentSnapShots as $s=>$snapshot){
            $startTime = $snapshot['creationTimestamp'];
            ?>
            <li><p class="inven_bottom_p"><span class="bold_label"><?php print t('Snapshot ID');?>: </span> <?php echo @$snapshot['id'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Name');?>: </span> <?php echo @$snapshot['name'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Description');?>: </span> <span title="<?php echo $snapshot['description'];?>"><?php echo mb_strimwidth( $snapshot['description'], 0, 30 ,"...");?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Created Time');?>: </span> <span class="<?php echo @$snapshot['id'];?>"><?php echo $startTime;?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume Size');?>: </span> <?php echo $snapshot['diskSizeGb'] ? $snapshot['diskSizeGb'].'GB' : '';?> </p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('State');?>: </span> <?php echo ucfirst(strtolower(@$snapshot['status']));?></p>
            <?php if($totalSnapshots > 1){?><div class="countData"><?php print t('Snapshots');?> : <span><?php echo $s+1?> / <?php echo $totalSnapshots?></div></span><?php }?> </li>
            <script>
            var snapdatetoconvert = jQuery('.<?php echo @$snapshot['id'];?>').html();
            var snapconvertedDate = moment.utc(''+snapdatetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
            jQuery('.<?php echo @$snapshot['id'];?>').html(snapconvertedDate);
            </script>
        <?php }?>
        </ul>
        <?php if($s > 0){?>
        <div class="bottom-icons"> 
            <div class="snapshotCount count-element"></div>  
            <a class="control_prev" rel="snapshot"></a>
            <a  class="control_next" rel="snapshot"></a>
        </div>
        <?php }?>
    </div>
<?php }?>
<?php if(@$currentImages){?>
    <div class="inv_voldiv slider image" >
    <p id="p_top"><?php print t('Images');?></p>
    <ul>
    <?php 
     $totalImages=count($currentImages);
    foreach($currentImages as $c=>$cIm){?>
        <li><p class="inven_bottom_p"><span class="bold_label"><?php print t('Image ID');?>: </span> <?php echo @$cIm['ImageId'];?></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Image Type');?>: </span> <?php echo @$cIm['ImageType'];?></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Name');?>: </span> <span title="<?php echo $cIm['Name'];?>"><?php echo mb_strimwidth( $cIm['Name'], 0, 30 ,"...");?></span></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Creation Date');?>: </span><span class="<?php echo @$cIm['ImageId'];?>"><?php echo @$cIm['CreationDate'];?></span></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Kernal ID');?>: </span> <?php echo @$cIm['KernelId'];?></p>    
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Location');?>:</span> <span title="<?php echo $cIm['ImageLocation'];?>"><?php echo mb_strimwidth( $cIm['ImageLocation'], 0, 30 ,"...");?></span></p>
        <?php if($totalImages > 1){?><div class="countData"> <?php print t('Images');?> : <span><?php echo $c+1?> / <?php echo $totalImages?></div> </span><?php }?></li>
		<script>
		var imagedatetoconvert = jQuery('.<?php echo @$cIm['ImageId'];?>').html();
		var imageconvertedDate = moment.utc(''+imagedatetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
		jQuery('.<?php echo @$cIm['ImageId'];?>').html(imageconvertedDate);
		</script>		
    <?php }?>
    </ul>
    <?php if($c>0){?>
    <div class="bottom-icons">  
            <div class="imageCount count-element"></div> 
            <a class="control_prev" rel="image"></a>
            <a  class="control_next" rel="image"></a>
        </div>
    </div>
    <?php }?>
<?php }?>
<?php 
if((count($ipArray) == 0) && (count($currentImages) == 0) && (count($currentSnapShots) == 0) && (count($currentVolumes) == 0)){
?>  
<div class="noData"><?php print t('No resources available for this Instance');?></div>
<?php
}
?>
</td>
<script type="text/javascript">
    jQuery(document).ready(function ($) { 
  
    var slideCount = $('.volume.slider ul li').length;
    var slideWidth = '290';
    var slideHeight = '250';
    var sliderUlWidth = slideCount * slideWidth;
    $('.volume.slider').css({ width: slideWidth, height: slideHeight }); 
    $('.volumeCount').html($('.volume .countData').html());
    $('.snapshotCount').html($('.snapshot .countData').html());
    $('.imageCount').html($('.image .countData').html());

    function moveLeft(a) { 
        $('.'+a+'.slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('.'+a+'.slider ul li:last-child').prependTo('.'+a+'.slider ul');
            $('.'+a+'.slider ul').css('left', '');  
            $('.'+a+' .'+a+'Count').html($('.'+a+' .countData').html());
        });
        
    };

    function moveRight(a) {
        $('.'+a+'.slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('.'+a+'.slider ul li:first-child').appendTo('.'+a+'.slider ul');
            $('.'+a+'.slider ul').css('left', '');
            $('.'+a+' .'+a+'Count').html($('.'+a+' .countData').html());
        });
        
    };

    $('a.control_prev').click(function () {
        var rel=$(this).attr('rel');
        moveLeft(rel); 
    });

    $('a.control_next').click(function () {
        var rel=$(this).attr('rel');
        moveRight(rel);
    });

});    


</script>
</tr>
<?php
function casttoclass($class, $object){
  return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
}
?>
