<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$instanceID=$_POST['instanceID'];
$InstanceData=$_SESSION['instances'];
foreach($InstanceData as $instance){
    if($instanceID==$instance['Instances'][0]['InstanceId']){
        $instanceArray=$instance;
    }
    if(@$instanceArray['Instances'][0]['BlockDeviceMappings']){
        foreach($instanceArray['Instances'][0]['BlockDeviceMappings'] as $instanceVolume){
            $volumeIDs[]=$instanceVolume['Ebs']['VolumeId'];
        }
    }
}  
$volumeIDs=array_unique($volumeIDs); 
foreach($_SESSION['Volumes'] as $volume){
    if(in_array($volume['VolumeId'],$volumeIDs)){
        $currentVolumes[]=$volume;
    }
}     
$ipaddresses=$_SESSION['ipaddresses'];
foreach ($ipaddresses as $ip) {
    if($instanceID==$ip['InstanceId']){
        $ipArray[]=$ip;
    }
}
$snapshots=$_SESSION['snapshots'];
foreach($snapshots as $snaps){
    if(in_array($snaps['VolumeId'], $volumeIDs)){
        $currentSnapShots[]=$snaps;
        $currentSnapshotIds[]=$snaps['SnapshotId'];
    }
}
$images=$_SESSION['images'];
foreach($images as $image){
    $imageSnapIds=$image['BlockDeviceMappings'];
    if(@$imageSnapIds){
        foreach($imageSnapIds as $imSID){
            if(@$currentSnapShots){
                if(in_array($imSID['Ebs']['SnapshotId'], @$currentSnapshotIds)){
                    $currentImages[]=$image;
                }
            }
        }
    }
}

?> 
<tr class="inventory_app border_bottom asso-resources" id="data_tr_<?php echo $instanceID?>">
<td colspan="9"> 
<?php if(@$currentVolumes){?>
    <div  id="inv_vol" class="slider volume">
        <p id="p_top"><?php print t('Attached Volumes');?></p>
        <ul>
        <?php 
        $totalVolumes=count($currentVolumes);
        foreach($currentVolumes as $v=>$volumeData){ ?>
            <li> 
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Volume ID');?>: </span> <?php echo @$volumeData['VolumeId']?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Size');?>: </span> <?php echo $volumeData['Size'] ? $volumeData['Size']. 'GB' : '';?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Volume Type');?>: </span> <?php echo @$volumeData['VolumeType']?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('IOPS');?>: </span> <?php echo @$volumeData['Iops']?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Availability Zone');?>: </span> <?php echo @$volumeData['AvailabilityZone']?></p> 
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Status');?>: </span> <?php echo @$volumeData['State']?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Created Time');?>: </span> <span class="<?php echo @$volumeData['VolumeId']?>"><?php $createTime = casttoclass('stdClass', @$volumeData['CreateTime']); echo $createTime->date;?></span></p> 
				<script>
				var datetoconvert = jQuery('.<?php echo @$volumeData['VolumeId']?>').html();
				var convertedDate = moment.utc(''+datetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
				jQuery('.<?php echo @$volumeData['VolumeId']?>').html(convertedDate);
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
            <li><p class="inven_bottom_p"><span class="bold_label"><?php print t('Public IP');?>: </span> <?php echo @$IPData['PublicIp'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Scope');?>: </span> <?php echo @$IPData['Domain'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Allocation ID');?>: </span> <?php echo @$IPData['AllocationId'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Private IP');?>: </span> <?php echo @$IPData['PrivateIpAddress'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Association ID');?>: </span> <?php echo @$IPData['AssociationId'];?> </p></li> 
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
            $startTime = casttoclass('stdClass', $snapshot['StartTime']);
            ?>
            <li><p class="inven_bottom_p"><span class="bold_label"><?php print t('Snapshot ID');?>: </span> <?php echo @$snapshot['SnapshotId'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume ID');?>: </span> <?php echo @$snapshot['VolumeId'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Start Time');?>: </span> <span class="<?php echo @$snapshot['SnapshotId'];?>"><?php echo $startTime->date;?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume Size');?>: </span> <?php echo $snapshot['VolumeSize'] ? $snapshot['VolumeSize'].'GB' : '';?> </p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Status');?>: </span> <?php echo @$snapshot['State'];?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Description');?>: </span> <span title="<?php echo $snapshot['Description'];?>"><?php echo mb_strimwidth( $snapshot['Description'], 0, 30 ,"...");?></span></p>
            <?php if($totalSnapshots > 1){?><div class="countData"><?php print t('Snapshots');?> : <span><?php echo $s+1?> / <?php echo $totalSnapshots?></div></span><?php }?> </li>
				<script>
				var snapdatetoconvert = jQuery('.<?php echo @$snapshot['SnapshotId'];?>').html();
				var snapconvertedDate = moment.utc(''+snapdatetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
				jQuery('.<?php echo @$snapshot['SnapshotId'];?>').html(snapconvertedDate);
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
