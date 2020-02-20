<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


$instanceID=$_POST['instanceID'];
$network_ip=$_POST['network_ip'];


$resourceGroup = $_SESSION['inventory_resources'];
$subscriptionID = $_SESSION['subscriptionId'];
$vm_details = instances_vm_details($resourceGroup, $subscriptionID,$instanceID);
$time = $vm_details[1];
$status = $vm_details[0];


function instances_vm_details($resourceGroup, $subscriptionID, $instanceID){
    // Implementation to get the VM Details //
    $url_vm_details = "https://management.azure.com/subscriptions/".$subscriptionID."/resourceGroups/".$resourceGroup."/providers/Microsoft.Compute/virtualMachines/".$instanceID."/InstanceView?api-version=2015-06-15";
    $ch = curl_init();
    $curlConfig = array(
            CURLOPT_URL            => $url_vm_details,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 500,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$_SESSION['azure_Token'],
    ));
    curl_setopt_array($ch, $curlConfig);
    $inventory_azure_details = curl_exec($ch);
    curl_close($ch);

    if ($inventory_azure_details === false) {
        $error = curl_error($ch);
        curl_close($ch);
    }
    $inventory_azure_details = json_decode($inventory_azure_details, true);
    foreach($inventory_azure_details['statuses'] as $inventory_azure){
        if($inventory_azure['displayStatus'] == "VM running"){
            $status = t("Running");
        }
        elseif($inventory_azure['displayStatus'] == "VM deallocated"){
            $status = t("Stopped");
        }
        else{
            $status = $inventory_azure['displayStatus'];
        }
        $time = $inventory_azure_details['statuses'][0]['time'];
    }
    return array($status, $time);
}


if(empty($time) && empty($status) && !empty($_SESSION['clientid']) && !empty($_SESSION['clientsecret']) && !empty($_SESSION['msSubDomain'])){
    $windowsazure_body = 'grant_type=client_credentials&client_id='.$_SESSION['clientid'].'&client_secret='.$_SESSION['clientsecret'].'&resource=https://management.azure.com/';
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => "https://login.windows.net/".$_SESSION['msSubDomain'].".onmicrosoft.com/oauth2/token",
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 500,
        CURLOPT_POSTFIELDS     => $windowsazure_body
    );
    curl_setopt_array($ch, $curlConfig);
    $result = curl_exec($ch);
    curl_close($ch);
    $arraytocken = json_decode($result, true);
    $_SESSION['azure_Token'] = $arraytocken["access_token"];
    $vm_details = instances_vm_details($resourceGroup, $subscriptionID,$instanceID);
    $time = $vm_details[1];
    $status = $vm_details[0];
}

// Implementation to get the Elastic IP //
$url_ip_details = "https://management.azure.com".$network_ip."?api-version=2015-06-15";
$ch = curl_init();
$curlConfig = array(
    CURLOPT_URL            => $url_ip_details,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 500,
);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.$_SESSION['azure_Token'],
));
curl_setopt_array($ch, $curlConfig);
$inventory_details = curl_exec($ch);
curl_close($ch);


$inventory_ip_details = json_decode($inventory_details, true);

$privateIPAddress = $inventory_ip_details['properties']['ipConfigurations'][0]['properties']['privateIPAddress'];
$IpId = $inventory_ip_details['properties']['ipConfigurations'][0]['properties']['publicIPAddress']['id'];

$InstanceData=$_SESSION['inventory_azure_resources'];
foreach($InstanceData as $instances){
    if(($instanceID==$instances['name']) && $instanceID != ''){
        $currentVolumeData = $instances['properties']['storageProfile']['dataDisks'];
        $currentVolumeOs = array($instances['properties']['storageProfile']['osDisk']);
        $currentVolume = array_merge($currentVolumeData, $currentVolumeOs);
        $imageUri = $instances['properties']['storageProfile']['osDisk']['vhd']['uri'];
        $snapshotId = $instances['properties']['storageProfile']['osDisk']['managedDisk']['id'];
    }
}

foreach($currentVolume as $volume){
     if(!empty($volume['managedDisk']['id'])){
        $volumename = $volume['name'];
        foreach($_SESSION['inventory_azure_volumes'] as $volume1){
            if($volume1['name'] == $volumename){
                $currentResourceVolumes[] = $volume1;
            }
        }
    }
    else{
        $currentVolumes[] = $volume;
    }
}

$ipaddresses=$_SESSION['inventory_azure_elastic'];
foreach ($ipaddresses as $ip) {
    if($IpId==$ip['id']){
        $ipArray[]=$ip;
    }
}

$snapshots=$_SESSION['inventory_azure_snapshot'];
foreach($snapshots as $snaps){
    $sourceResourceId = $snaps['properties']['creationData']['sourceResourceId'];
    if(strtoupper($snapshotId) == strtoupper($sourceResourceId)){
        $currentSnapShots[]=$snaps;
    }
}
$images=$_SESSION['inventory_azure_images'];

foreach($images as $image){
    $imageSnapIds=$image['properties']['osDisk']['blobUri'] ;
    if($imageUri == $imageSnapIds){
        @$currentImages[] = $image;
    }
}

?> 
<tr class="inventory_app border_bottom asso-resources" id="data_tr_<?php echo $instanceID?>">
<td colspan="9"> 
<div>
    <p class="inven_bottom_p"><span class="bold_label"><?php print t('Status');?>: </span>  <?php echo $status;?></p>
    <p class="inven_bottom_p"><span class="bold_label"><?php print t('Created Time');?>: </span> <span class="created_time"><?php echo $time;?></span></p>
    <script>
        var created_time = jQuery('.created_time').html();
        var created_convert_time = moment.utc(''+created_time+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
        jQuery('.created_time').html(created_convert_time);
    </script>
</div>
<?php if(@$currentVolumes || $currentResourceVolumes){?>
    <div  id="inv_vol" class="slider volume">
        <p id="p_top"><?php print t('Attached Volumes');?></p>
        <ul>
        <?php 
        $totalResourceVolumes=count($currentResourceVolumes);
        if($totalResourceVolumes){
            foreach($currentResourceVolumes as $v=>$volumeData){ ?>
                <li> 
                    <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume ID');?>: </span><span title="<?php echo $volumeData['id'];?>"><?php echo mb_strimwidth( $volumeData['id'], 0, 30 ,"...");?></span></p>
                    <p class="inven_bottom_p"><span class="bold_label"> <?php print t('Size');?>: </span> <?php echo $volumeData['properties']['diskSizeGB'] ? $volumeData['properties']['diskSizeGB']. 'GB' : '';?></p>
                    <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume Name');?>: </span><span title="<?php echo $volumeData['name'];?>"><?php echo mb_strimwidth( $volumeData['name'], 0, 25 ,"...");?></span></p>
                    <p class="inven_bottom_p"><span class="bold_label"><?php print t('Location');?>: </span><span title="<?php echo $volumeData['location'];?>"><?php echo mb_strimwidth( $volumeData['location'], 0, 25 ,"...");?></span></p>
                    <p class="inven_bottom_p"><span class="bold_label"><?php print t('State');?>: </span><span title="<?php echo $volumeData['properties']['diskState'];?>"><?php echo mb_strimwidth( $volumeData['properties']['diskState'], 0, 30 ,"...");?></span></p>
                    <p class="inven_bottom_p"><span class="bold_label"><?php print t('Created Time');?>: </span> <span class="vol-<?php echo @$volumeData['name'];?>"><?php echo $volumeData['properties']['timeCreated'];?></span></p>
                    <script>
                        var imagedatetoconvert = jQuery('.vol-<?php echo @$volumeData['name'];?>').html();
                        var imageconvertedDate = moment.utc(''+imagedatetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
                        jQuery('.vol-<?php echo @$volumeData['name'];?>').html(imageconvertedDate);
                    </script>
                    <?php if($totalResourceVolumes > 1){?><div class="countData"> <?php print t('Volumes');?> : <span><?php echo $v+1?> / <?php echo $totalResourceVolumes?></span><?php }?></div>
                </li> 
        <?php }}?>
            
        <?php 
        $totalVolumes=count($currentVolumes);
        if($totalVolumes){
            foreach($currentVolumes as $v=>$volumeData){ ?>
                <li> 
                    <p class="inven_bottom_p"><?php if(isset($volumeData['managedDisk']['id'])) {?><span class="bold_label"><?php print t('Volume ID');?>: </span><span title="<?php echo $volumeData['managedDisk']['id'];?>"><?php echo mb_strimwidth( $volumeData['managedDisk']['id'], 0, 30 ,"..."); }?></span></p>
                    <p class="inven_bottom_p"><?php if(isset($volumeData['diskSizeGB'])) {?><span class="bold_label"> <?php print t('Size');?>: </span> <?php echo $volumeData['diskSizeGB'] ? $volumeData['diskSizeGB']. 'GB' : '';}?></p>
                    <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume Name');?>: </span><span title="<?php echo $volumeData['name'];?>"><?php echo mb_strimwidth( $volumeData['name'], 0, 25 ,"...");?></span></p>
                    <?php if($totalVolumes > 1){?><div class="countData"> <?php print t('Volumes');?> : <span><?php echo $v+1?> / <?php echo $totalVolumes?></span><?php }?></div>
                </li> 
        <?php }}?>
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
            <p class="inven_bottom_p"><?php if(isset($IPData['properties']['ipAddress'])) {?><span class="bold_label"><?php print t('Public IP');?>: </span> <?php echo $IPData['properties']['ipAddress']; }?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Name');?>: </span> <?php echo $IPData['name'];?></p>
            <p class="inven_bottom_p"><?php if(isset($privateIPAddress)) {?><span class="bold_label"><?php print t('Private IP');?>: </span> <?php echo $privateIPAddress; }?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Allocation Method');?>: </span> <?php echo $IPData['properties']['publicIPAllocationMethod'];?></p>
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
            $status = $snapshot['properties']['diskState'];
            if($status == 'Succeeded'){
                $status = 'Completed';
            }
            ?>
            <li>
                <p class="inven_bottom_p"><span class="bold_label"><?php print t('Snapshot ID');?>: </span> <span title="<?php echo @$snapshot['id'];?>"><?php echo mb_strimwidth( @$snapshot['id'], 0, 30 ,"...");?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Name');?>: </span> <span title="<?php echo @$snapshot['name'];?>"><?php echo mb_strimwidth( @$snapshot['name'], 0, 30 ,"...");?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Created Time');?>: </span> <span class="<?php echo @$snapshot['name'];?>"><?php echo $snapshot['properties']['timeCreated'];?></span></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Volume Size');?>: </span> <?php echo $snapshot['properties']['diskSizeGB'] ? $snapshot['properties']['diskSizeGB'].'GB' : '';?> </p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('State');?>: </span> <?php echo @$status;?></p>
            <p class="inven_bottom_p"><span class="bold_label"><?php print t('Location');?>: </span> <span title="<?php echo $snapshot['location'];?>"><?php echo $snapshot['location'];?></span></p>
            <?php if($totalSnapshots > 1){?><div class="countData"> <?php print t('Snapshots');?> : <span><?php echo $s+1?> / <?php echo $totalSnapshots?></div></span><?php }?> </li>
                <script>
                var snapdatetoconvert = jQuery('.<?php echo $snapshot['name'];?>').html();
                var snapconvertedDate = moment.utc(''+snapdatetoconvert+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
                jQuery('.<?php echo @$snapshot['name'];?>').html(snapconvertedDate);
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
        <li>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Image ID');?>: </span> <span title="<?php echo $cIm['id'];?>"><?php echo mb_strimwidth( $cIm['id'], 0, 30 ,"...");?></span></p>       
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Name');?>: </span> <?php echo @$cIm['name'];?></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Image Type');?>: </span> <?php echo @$cIm['type'];?></p>
        <p class="inven_bottom_p"><span class="bold_label"><?php print t('Location');?>:</span> <span title="<?php echo $cIm['location'];?>"><?php echo mb_strimwidth( $cIm['location'], 0, 30 ,"...");?></span></p>
        <?php if($totalImages > 1){?><div class="countData"> <?php print t('Images');?> : <span><?php echo $c+1?> / <?php echo $totalImages?></div> </span><?php }?></li>		
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
