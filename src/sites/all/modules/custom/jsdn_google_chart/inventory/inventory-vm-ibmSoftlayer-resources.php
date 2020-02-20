<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
$path = DRUPAL_ROOT . 'sites/all/modules/custom/jsdn_google_chart/lib/ibm_softlayer/vendor/autoload.php';
include ($path);
$apiUsername = $_SESSION['ibm_apiUsername'];
$apiKey = $_SESSION['ibm_apiKey'];
    
$vsi_id =$_POST['instanceID'];
$InstanceData=$_SESSION['ibm_softlayer_instances'];

$client_guest = \SoftLayer\SoapClient::getClient('SoftLayer_Virtual_Guest', $vsi_id, $apiUsername, $apiKey);
$network_volumes = $client_guest->getAttachedNetworkStorages();
$volumes = $client_guest->getBlockDevices();

foreach($InstanceData as $instance){
    if($vsi_id==$instance->id){
        $instanceArray = $instance;
    }
} 

$currentSnapShots = array();
foreach($network_volumes as $network_volume){
    $currentVolumes[] = $network_volume;
    $storageid = $network_volume->id;
    $client_snapshot = \SoftLayer\SoapClient::getClient('SoftLayer_Network_Storage', $storageid, $apiUsername, $apiKey);
    $snaps = $client_snapshot->getSnapshotsForVolume();
    if(!empty($snaps)){
       $currentSnapShots = array_merge($currentSnapShots, $snaps);
    }
}

foreach($volumes as $volume){
    foreach($_SESSION['ibm_softlayer_volumes'] as $ibm_softlayer_volumes){
        if($ibm_softlayer_volumes->id == $volume->diskImageId){
            $currentVolumes[] = $ibm_softlayer_volumes;
        }
    }
}

$ipaddresses=$_SESSION['ibm_softlayer_ipaddresses'];
$ip_address = $instanceArray->primaryIpAddress;
foreach ($ipaddresses as $ip) {
    if($ip_address==$ip->ipAddress){
        $ipArray[]=$ip;
    }
}
$ipArray[0]->elastic_ip = $instanceArray->primaryIpAddress;
$ipArray[0]->private_ip = $instanceArray->primaryBackendIpAddress;


// get images allocated to a device
$images = $client_guest->getBlockDeviceTemplateGroup();
if (is_object($images)) {
    $currentImages[] = $images;
}

?> 
<tr class="inventory_app border_bottom asso-resources" id="data_tr_<?php echo $vsi_id?>">
<td colspan="9"> 
<?php if(@$currentVolumes){?>
    <div  id="inv_vol" class="slider volume">
        <p id="p_top"><?php print t('Attached Volumes');?></p>
        <ul>
        <?php 
        $totalVolumes=count($currentVolumes);
        foreach($currentVolumes as $v=>$volumeData){ 
            $name = $volumeData->username ? $volumeData->username:$volumeData->name;
            $capacity = $volumeData->capacity ? $volumeData->capacity:$volumeData->capacityGb;
            $diskType = $volumeData->nasType ? $volumeData->nasType:'';
            ?>
            <li>
                <p class="inven_bottom_p"><span class="bold_label"><?php if($name) {?><?php print t('Volume Name');?>: </span> <span title="<?php echo $name;?>"><?php echo mb_strimwidth( $name, 0, 30 ,"...");}?></span></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Volume ID');?>: </span> <?php echo $volumeData->id?></p>
                <p class="inven_bottom_p"><span class="bold_label"><?php if($capacity) {?> <?php print t('Size');?>: </span> <?php echo $capacity.'GB';}?></p>
                <p class="inven_bottom_p"><span class="bold_label"><?php if($diskType) {?> <?php print t('NAS Type');?>: </span> <?php echo $diskType;}?></p>
                <p class="inven_bottom_p"><span class="bold_label"><?php if($volumeData->uuid) { print t('UUID');?>: </span> <?php echo $volumeData->uuid; }?></p>
                <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Created Time');?>: </span> <span class="<?php echo @$volumeData->id?>"><?php echo @$volumeData->createDate;?></span></p> 
                <p class="inven_bottom_p"><span class="bold_label"><?php if($volumeData->description) {?><?php print t('Description');?>: </span> <span title="<?php echo @$volumeData->description;?>"><?php echo mb_strimwidth( @$volumeData->description, 0, 30 ,"...");}?></span></p>
                <script>
                    var datetoconvert = jQuery('.<?php echo $volumeData->id?>').html();
                    var convertedDate = moment.utc(''+datetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
                    jQuery('.<?php echo $volumeData->id?>').html(convertedDate);
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
            <p class="inven_bottom_p"><span class="bold_label"><?php if($IPData->elastic_ip) {?><?php print t('Public IP');?>: </span> <?php echo @$IPData->elastic_ip;}?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Private IP');?>: </span> <?php echo @$IPData->private_ip;?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php if($IPData->isBroadcast) {?><?php print t('Broadcast');?>: </span> <?php echo t('Broadcast');}?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php if($IPData->isGateway) {?><?php print t('Gateway');?>: </span> <?php print t('Gateway');}?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php if($IPData->isNetwork) {?><?php print t('Network');?>: </span> <?php print t('Network');}?></p>
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
            $startTime = $snapshot->createDate;
            ?>
            <li><p class="inven_bottom_p"><span class="bold_label"><?php print t('Snapshot ID');?>: </span> <?php echo @$snapshot->id;?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php if($snapshot->notes) {?><?php print t('Name');?>: </span> <span title="<?php echo $snapshot->notes;?>"><?php echo mb_strimwidth( $snapshot->notes, 0, 30 ,"...");}?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Created Time');?>: </span> <span class="<?php echo @$snapshot->id;?>"><?php echo $startTime;?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume Size');?>: </span> <?php echo $snapshot->capacityGb ? $snapshot->capacityGb.'GB' : '';?> </p>
            <?php if($totalSnapshots > 1){?><div class="countData"><?php print t('Snapshots');?> : <span><?php echo $s+1?> / <?php echo $totalSnapshots?></div></span><?php }?> </li>
            <script>
            var snapdatetoconvert = jQuery('.<?php echo @$snapshot->id?>').html();
            var snapconvertedDate = moment.utc(''+snapdatetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
            jQuery('.<?php echo @$snapshot->id;?>').html(snapconvertedDate);
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
<?php if(@$currentImages && count($currentImages)){?>
    <div class="inv_voldiv slider image" >
    <p id="p_top"><?php print t('Images');?></p>
    <ul>
    <?php 
     $totalImages=count($currentImages);
    foreach($currentImages as $c=>$cIm){?>
        <li>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Image ID');?>: </span> <?php echo @$cIm->id;?></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Name');?>: </span> <span title="<?php echo $cIm->name;?>"><?php echo mb_strimwidth( $cIm->name, 0, 30 ,"...");?></span></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Creation Date');?>: </span><span class="<?php echo @$cIm->id;?>"><?php echo @$cIm->createDate;?></span></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Identifier');?>:</span> <span title="<?php echo $cIm->globalIdentifier;?>"><?php echo mb_strimwidth( $cIm->globalIdentifier, 0, 30 ,"...");?></span></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Description');?>:</span> <span title="<?php echo $cIm->note;?>"><?php echo mb_strimwidth( $cIm->note, 0, 30 ,"...");?></span></p>
        <?php if($totalImages > 1){?><div class="countData"> <?php print t('Images');?> : <span><?php echo $c+1?> / <?php echo $totalImages?></div> </span><?php }?>
        </li>
		<script>
		var imagedatetoconvert = jQuery('.<?php echo @$cIm->id;?>').html();
		var imageconvertedDate = moment.utc(''+imagedatetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
		jQuery('.<?php echo @$cIm->id;?>').html(imageconvertedDate);
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
