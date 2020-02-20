<?php
$server_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
define("JSDN_OAUTH_HOST", $server_url);

require_once DRUPAL_ROOT . 'includes/bootstrap.inc';

// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);



$company_acronym = rawurlencode($_POST['company_acronym']);
$count = $_POST['count'];
$provider = urlencode($_POST['provider']);
$type = $_POST['type'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$date_type = $_POST['date_type'];
$reset = $_POST['reset'];
$start = strtotime($startdate);
$end = strtotime($enddate);
$days_between = ceil(abs($end - $start) / 86400);
$product = urlencode($_POST['product']);
$tagname = urlencode($_POST['tagname']);
$tagvalue = urlencode($_POST['tagvalue']);
$chart_type = $_POST['chart_type'];
$dataCenter = urlencode($_POST['dataCenterValue']);
$showAll = false;


if(empty($company_acronym) || ($company_acronym == 'All')){
    $JSDN_TENANT_ORG_ACRONYM = $_SESSION['companyacronym'];
    $_SESSION['changed_acronym'] = '';
}
else{
    $JSDN_TENANT_ORG_ACRONYM = $company_acronym;
    $_SESSION['changed_acronym'] = $company_acronym;
}

if($company_acronym == 'All'){
    $showAll = true;
}


    switch ($type) {
        case 'provider-usage':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/provider-usage?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
            break;
            
        case 'products-usage':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-products-spend-by-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
                
        case 'daily-trend':
            if(($days_between > 92) || ($date_type == 'YTD')){
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-ytd?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
            }
            else{
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
            }
            break;
            
        case 'daily-trend-provider':
            if(($days_between > 92) || ($date_type == 'YTD')){
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-ytd-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
            }
            else{
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
            }
            break;
            
        case 'cost-resources':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-resources-spend-by-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
            
        case 'cost-summary':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/cost-summary?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate;
            break;
            
        case 'products':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/products?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate;  
            break;
            
        case 'product-trend':   
            if(($days_between > 92) || ($date_type == 'YTD')){
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-ytd-by-product?cstype=IAAS&provider=".$provider."&product=".$product."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;  
            }
            else{
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-by-product?cstype=IAAS&provider=".$provider."&product=".$product."&startdate=".$startdate."&enddate=".$enddate;  
            }
            break;
            
        case 'vm-count-by-instance-type':
            $api_url1 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-flavor-count-by-provider?cstype=IAAS&provider=".$provider."&fetchCount=1000000000000000000&startdate=".$startdate."&enddate=".$enddate;
            $api_url2 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-flavor-spend-by-provider?cstype=IAAS&provider=".$provider."&fetchCount=".$count."&startdate=".$startdate."&enddate=".$enddate;
            $multiple_url = true;
            break;
            
        case 'resource-count':
            $api_url1 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-region-count-by-provider?cstype=IAAS&provider=".$provider."&fetchCount=1000000000000000000&startdate=".$startdate."&enddate=".$enddate;
            $api_url2 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-region-spend-by-provider?cstype=IAAS&provider=".$provider."&fetchCount=".$count."&startdate=".$startdate."&enddate=".$enddate;
            $multiple_url = true;
            break;
            
        case 'vm-count-by-source':
            $api_url1 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/vm-count-by-source-of-creation?cstype=IAAS&provider=".$provider."&fetchCount=1000000000000000000&startdate=".$startdate."&enddate=".$enddate;
            $api_url2 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/vm-spend-by-source-of-creation?cstype=IAAS&provider=".$provider."&fetchCount=".$count."&startdate=".$startdate."&enddate=".$enddate;
            $multiple_url = true;
            break;
            
        case 'cost-by-iaas-usage':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-usagetype-spend-by-provider?cstype=IAAS&provider=".$provider."&fetchCount=".$count."&startdate=".$startdate."&enddate=".$enddate; 
            break;
            
        case 'cost-by-platform':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-platform-spend-by-provider?cstype=IAAS&provider=".$provider."&fetchCount=".$count."&startdate=".$startdate."&enddate=".$enddate;
            break;
            
        case 'cost-by-tags':
            $api_url1 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-vm-count-by-tags?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=1000000000000000000";
            $api_url2 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-tags-spend-by-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            $multiple_url = true;
            break;
                
        case 'top-untagged-resource-by-cost':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-untagged-resource-by-cost?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
            
        case 'product-associated-to-tags':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-tags-spend-by-product?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count."&tagname=".$tagname."&tagvalue=".$tagvalue;
            break;
            
        case 'vm-cost-tag-key':
            $api_url1 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-tags-vm-count-by-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=1000000000000000000&tagname=".$tagname;
            $api_url2 = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-tags-vm-spend-by-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count."&tagname=".$tagname;
            $multiple_url = true;
            break;
            
        case 'tag-cost-trend':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-by-tag?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count."&tagname=".$tagname."&tagvalue=".$tagvalue;
            break;
            
        case 'instance-type-tags':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-flavor-spend-by-tagvalue?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count."&tagname=".$tagname."&tagvalue=".$tagvalue;
            break;
            
        case 'tag-keys':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/tag-keys?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate;
            break;
            
        case 'tag-values-of-tag-name':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/tag-values-of-tag-name?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&tagname=".$tagname;
            break;
        
        case 'orders-at-glance':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/jsdn/orders-at-glance?cstype=SAAS";
            break;
        
        case 'iaas-providers':   
            $api_url = JSDN_OAUTH_HOST .'/api/2.0/'.$JSDN_TENANT_ORG_ACRONYM.'/datafeed/report/providers?cstype=IAAS';
            break;
        
        case 'saas-provider-usage':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/provider-usage-saas?cstype=SAAS&provider=All&startdate=".$startdate."&enddate=".$enddate; 
            break;
            
        case 'saas-products-usage':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/top-products-spend-by-provider-saas?cstype=SAAS&provider=All&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
                    
        case 'saas-products':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/products-saas?cstype=SAAS&provider=All&startdate=".$startdate."&enddate=".$enddate;  
            break;
        
        case 'saas-product-trend':   
            if(($days_between > 92) || ($date_type == 'YTD')){
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-ytd-by-product-saas?cstype=SAAS&provider=All&product=".$product."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;  
            }
            else{
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-by-product-saas?cstype=SAAS&provider=All&product=".$product."&startdate=".$startdate."&enddate=".$enddate;  
            }
            break;
            
        case 'saas-providers':   
            $api_url = JSDN_OAUTH_HOST .'/api/2.0/'.$JSDN_TENANT_ORG_ACRONYM.'/datafeed/report/providers-saas?cstype=SAAS';
            break;

        case 'saas-daily-trend-provider':
            if($provider === 'All'){
                if(($days_between > 92) || ($date_type == 'YTD')){
                    $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-ytd-saas?cstype=SAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
                }
                else{
                    $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-saas?cstype=SAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
                }
            }
            else{
                if(($days_between > 92) || ($date_type == 'YTD')){
                    $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-ytd-provider-saas?cstype=SAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
                }
                else{
                    $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-provider-saas?cstype=SAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
                }
            }
            break;
            
        case 'saas-licence-status':   
            $api_url = JSDN_OAUTH_HOST .'/api/2.0/'.$JSDN_TENANT_ORG_ACRONYM.'/datafeed/jsdn/subscrption-usage?cstype=SAAS';
            break;  
        
        case 'storage-usage':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/storage-spend-by-provider?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
        
        case 'cost-by-department':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/cost-spend-by-ea-department?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
        
        case 'cost-by-account':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/cost-spend-by-ea-account?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
        
        case 'cost-by-subscriptions':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/cost-spend-by-ea-subscrption?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&fetchCount=".$count;
            break;
        
        case 'private-resource-summary':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_Datacenter_Summary?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
            break;
        
        case 'public-resource-summary':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/Vm_Count-by-provider?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate; 
            break;
        
        case 'physical-memory-count':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_Physical_Machine_Count_by_CPU?&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break;
   
        case 'virtualized-host-memory':   
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_Host_mem_Utilization?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break; 
        
        case 'virtualized-host-cpu':   
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_Host_CPU_Utilization?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break;
        
        case 'virtualized-host-count-cpu':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_VHost_Count_by_CPU?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break;
        
        case 'migration-status-private':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_VM_count_by_Migratoin_status?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break;
        
        case 'vm-distribution-os-private':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_VM_count_by_GuestOS?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break;
        
        case 'vm-count-by-cpu-private':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_VM_count_by_CPU?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break;
        
        case 'migration-status-public':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/vm-count-by-source-of-creation?cstype=IAAS&provider=".$provider."&fetchCount=".$count."&startdate=".$startdate."&enddate=".$enddate;
            break;
        
        case 'vm-distribution-os-public':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/VMCount-by-platform-for-tagvalue?startdate=".$startdate."&enddate=".$enddate."&provider=".$provider."&tagname=".$tagname."&tagvalue=".$tagvalue;
            break;
        
        case 'vm-count-by-flavors-public':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/VMCount-by-flavor-for-tagvalue?startdate=".$startdate."&enddate=".$enddate."&provider=".$provider."&tagname=".$tagname."&tagvalue=".$tagvalue;
            break;
        
        case 'data-center-filter':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_datacenter_list?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate;
            break;
        
        case 'tag-keys-private':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/tag-keys-by-datacenter?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&datacenter_name=".$dataCenter; 
            break;
        
        case 'tag-keys-public':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/tag-keys?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate;
            break;
        
        case 'tag-values-of-tag-name-private':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/tag-values-of-tag-name-by-datacenter?provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&tagname=".$tagname."&datacenter_name=".$dataCenter;
            break;
        
        case 'tag-values-of-tag-name-public':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/tag-values-of-tag-name?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&tagname=".$tagname;
            break;
        
        case 'tag-cost-trend-private':
             if(($days_between > 92) || ($date_type == 'YTD')){
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_datacenter_monthly_trend_cost?startdate=".$startdate."&enddate=".$enddate."&provider=".$provider."&datacenter_name=".$dataCenter."&tagname=".$tagname."&tagvalue=".$tagvalue;
            }
            else{
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/migration_datacenter_trend_cost?startdate=".$startdate."&enddate=".$enddate."&provider=".$provider."&datacenter_name=".$dataCenter."&tagname=".$tagname."&tagvalue=".$tagvalue;
            }
            break;
        
        case 'tag-cost-trend-public':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-by-tag?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&tagname=".$tagname."&tagvalue=".$tagvalue;
            break;
        
        case 'ri-owned-vs-burned-down':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ri-owned-vs-burned-down?cstype=IAAS&enddate=".$enddate."&startdate=".$startdate."&provider=".$provider."&fetchCount=10000";
            break;
        
        case 'instance-type-by-reservation':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/instance-type-by-reservation?cstype=IAAS&enddate=".$enddate."&startdate=".$startdate."&provider=".$provider."&fetchCount=10000";
            break;
        
        case 'instance-type-by-ondemand':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/instance-type-by-ondemand?cstype=IAAS&enddate=".$enddate."&startdate=".$startdate."&provider=".$provider."&fetchCount=10000";
            break;
        
        case 'ondemand-vs-reservation-count':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ondemand-vs-reservation-count?cstype=IAAS&enddate=".$enddate."&startdate=".$startdate."&provider=".$provider."&fetchCount=10000";
            break;
        
        case 'ondemand-vs-reserved-hours':
            if(($days_between > 92) || ($date_type == 'YTD')){
                $granularity = 'MONTHLY';
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ri-ondemand-hours-trend?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&granularity=".$granularity;
            }
            else{
                $granularity = 'DAILY';
                $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ri-ondemand-hours-trend?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&granularity=".$granularity;
            }
            break;
    }
    if($showAll){
        $api_url .= "&showAll=All"; 
    }
    if($multiple_url == false){
        $output  = jsdn_google_chart_curl_call_api($api_url);
        $out = jsdn_google_chart_build_js_data_api($output, $type, $chart_type, $date_type, $JSDN_TENANT_ORG_ACRONYM, $provider, $startdate, $enddate, $days_between);
    }
    else{    
        for($i=1;$i<=2;$i++){
            if($showAll){
                ${"api_url" . $i} .= "&showAll=All"; 
            }
            $output[$i]  = jsdn_google_chart_curl_call_api(${"api_url" . $i});
        }
        $out = jsdn_google_chart_build_multiple_data_api($output, $type);
    }
    print $out;
    exit;
	
	/**
 * Get the resonse for to prepare the chart from JSDN.
 *
 * @param $api_url
 *   The api url identifier.
 */
function jsdn_google_chart_curl_call_api($url) { 
    $cmsMenu = json_decode($_SESSION['MenuJSON']);
    $isProxied = json_decode($_SESSION['MenuJSON'])->profile->isProxied;
    $compacronym = json_decode($_SESSION['MenuJSON'])->profile->storecompanyacronym;
    $endcustcompacronym=json_decode($_SESSION['MenuJSON'])->profile->companyacronym;
	
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 500,
        CURLOPT_USERAGENT      => "CMS", // who am i
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPGET        => 1
    );
    if ($isProxied){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Token:'.$_SESSION['authToken'],
            'Content-Type: application/json',
            'Accept: application/json',
            'xoauth-jsdn-loginUrl:'.$_SERVER['HTTP_HOST'],
            'proxy-store:'.$compacronym,
            'proxy-end-customer:'.$endcustcompacronym,
        ));
    }
    else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Token:'.$_SESSION['authToken'],
            'Content-Type: application/json',
            'Accept: application/json',
            'xoauth-jsdn-loginUrl:'.$_SERVER['HTTP_HOST'],
        ));

    }
    curl_setopt_array($ch, $curlConfig);
    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
    } 
    curl_close($ch);
    return $result;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_build_js_data_api($chart_data, $data_type, $chart_type, $date_type, $JSDN_TENANT_ORG_ACRONYM, $provider, $startdate, $enddate, $days_between) {
    global $tagvalue;
    $json_data = json_decode($chart_data, true);
    if($data_type == 'provider-usage'){
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Provider'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'products-usage') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Products'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-resources') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Resource Details'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-summary') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $provider_data){
            $provider_php[$provider_data['key']] = (float) $provider_data['value'];
        }
        array_push($provider_php_arr , $provider_php);
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'daily-trend') {
        $days_between = $days_between+1;
        $startdate = date('Ymd', strtotime("-".$days_between." day", strtotime($startdate)));
        $enddate = date('Ymd', strtotime("-".$days_between." day", strtotime($enddate)));
        if(($days_between > 92) || ($date_type == 'YTD')){
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend-ytd?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&showAll=All"; 
        }
        else{
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/daily-trend?cstype=IAAS&provider=".$provider."&startdate=".$startdate."&enddate=".$enddate."&showAll=All"; 
        }
        $output  = jsdn_google_chart_curl_call_api($api_url);
        $json_previous_period = json_decode($output, true);
        $OverallPreviousCost = isset($json_previous_period['OverallCurrentCost']) ? $json_previous_period['OverallCurrentCost'] : 0; 
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array(t('Resource Details'), t('Cost'));
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
        $out = json_decode($out);
        $overallCurrentCost = isset($json_data['OverallCurrentCost']) ? $json_data['OverallCurrentCost'] : 0;
        if($OverallPreviousCost && $overallCurrentCost){
            $overallDifference = (($overallCurrentCost  - $OverallPreviousCost) / $OverallPreviousCost) * 100;
        }
        $overallDifference = !empty($overallDifference) ? number_format($overallDifference, 2) : '';
        array_unshift($out , array("overallEstimatedCostDR" =>  $overallDifference));
        array_unshift($out , array("overallCurrentCost" =>  number_format($overallCurrentCost, 2)));
        array_unshift($out , array("overallEstimatedCost" => number_format($OverallPreviousCost, 2)));
        $out = json_encode($out);
    }
    elseif($data_type == 'daily-trend-provider') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array();
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'products') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'tag-keys') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'tag-values-of-tag-name') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'product-trend') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array();
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
        $out = json_decode($out);
        $overallCurrentCost = isset($json_data['OverallCurrentCost']) ? $json_data['OverallCurrentCost'] : '';
        $overallEstimatedCost = isset($json_data['OverallEstimatedCost']) ? $json_data['OverallEstimatedCost'] : '';
        $overallEstimatedCostDR = isset($json_data['OverallEstimatedCostDR']) ? $json_data['OverallEstimatedCostDR'] : '';
        array_unshift($out , array("overallEstimatedCostDR" =>  $overallEstimatedCostDR));
        array_unshift($out , array("overallCurrentCost" =>  number_format($overallCurrentCost, 2)));
        array_unshift($out , array("overallEstimatedCost" => number_format($overallEstimatedCost, 2)));
        $out = json_encode($out);
    }
    elseif($data_type == 'vm-count-by-instance-type') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Instance Type/Size/Flavor'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'resource-count') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Resource Region'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'resource-cost') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Resource Region'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'vm-cost-by-source') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('VM Type'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'vm-count-by-source') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('VM Type'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-by-iaas-usage') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('IaaS Usage Type'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-by-platform') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Platform'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-by-tags') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Tags'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'top-untagged-resource-by-cost') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Resource details'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'product-associated-to-tags') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Product'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'tag-cost-trend') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array(t('Time Duration'), $tagvalue);
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'instance-type-tags') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Instance Type/Size/Flavor'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'orders-at-glance') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array(t('Order/Request Status'), t('Count'));
        $out = jsdn_google_chart_json_array_three_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'iaas-providers') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    } 
    elseif($data_type == 'saas-provider-usage'){
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Provider'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'saas-products-usage') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Service Offer'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'saas-products') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'saas-product-trend') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array();
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'saas-providers') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['value'];
            $provider_php_arr[$k]['value'] = $provider_data['key'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'saas-daily-trend-provider') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array();
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
        $out = json_decode($out);
        $overallCurrentCost = isset($json_data['OverallCurrentCost']) ? $json_data['OverallCurrentCost'] : '';
        $overallEstimatedCost = isset($json_data['OverallEstimatedCost']) ? $json_data['OverallEstimatedCost'] : '';
        $overallEstimatedCostDR = isset($json_data['OverallEstimatedCostDR']) ? $json_data['OverallEstimatedCostDR'] : '';
        array_unshift($out , array("overallEstimatedCostDR" =>  $overallEstimatedCostDR));
        array_unshift($out , array("overallCurrentCost" =>  number_format($overallCurrentCost, 2)));
        array_unshift($out , array("overallEstimatedCost" => number_format($overallEstimatedCost, 2)));
        $out = json_encode($out);
    }
    elseif($data_type == 'saas-licence-status') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        if($chart_type == 'stack'){
            $columns = array(t('Service Offer'), t('Quantity Available'), t('In-use'));
            $stack = true;
        }
        else{
            $columns = array(t('Service Offer'), t('Quantity Available'), t('In-use'));
            $stack = false;
        }
        
        $out = jsdn_google_chart_json_array_stacked_dimensional_api($provider, $columns, $stack);
    }
    elseif($data_type == 'storage-usage') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Storage'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-by-department') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Department'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-by-account') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Account'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'cost-by-subscriptions') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Subscriptions'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'private-resource-summary'){
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Provider'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'public-resource-summary'){
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Provider'), ('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'physical-memory-count'){
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('CPU'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api_append_text($provider, $columns, 'CPU');
        $out = json_decode($out);
        $totalHost = isset($json_data['totalHosts']) ? $json_data['totalHosts'] : '';
        $noCPU = isset($json_data['totalCPUS']) ? $json_data['totalCPUS'] : '';
        array_unshift($out , array("totalHost" =>  $totalHost));
        array_unshift($out , array("noCPU" => $noCPU));
        $out = json_encode($out);
    }
    elseif($data_type == 'virtualized-host-memory') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        if($chart_type == 'stack'){
            $columns = array(t('Host'), t('Memory (Utilized)'), t('Memory (Un-utilized)'));
            $stack = true;
        }
        else{
            $columns = array(t('Host'), t('Memory (Utilized)'), t('Memory (Un-utilized)'));
            $stack = false;
        }
        $out = jsdn_google_chart_json_array_stacked_dimensional_api($provider, $columns, $stack);
    }
    elseif($data_type == 'virtualized-host-cpu') {
	$provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        if($chart_type == 'stack'){
            $columns = array(t('Host'), t('CPU (Utilized)'), t('CPU (Un-utilized)'));
            $stack = true;
        }
        else{
            $columns = array(t('Host'), t('CPU (Utilized)'), t('CPU (Un-utilized)'));
            $stack = false;
        }
        $out = jsdn_google_chart_json_array_stacked_dimensional_api($provider, $columns, $stack);
    }
    elseif($data_type == 'virtualized-host-count-cpu'){
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('No. of CPU'), t('Host Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api_append_text($provider, $columns, 'CPU');
        $out = json_decode($out);
        $totalHost = isset($json_data['totalHosts']) ? $json_data['totalHosts'] : '';
        $noCPU = isset($json_data['totalCPUS']) ? $json_data['totalCPUS'] : '';
        array_unshift($out , array("totalHost" =>  $totalHost));
        array_unshift($out , array("noCPU" => $noCPU));
        $out = json_encode($out);
    }
    elseif($data_type == 'migration-status-private') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Migration Status'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'vm-distribution-os-private') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Operating System'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'vm-count-by-cpu-private') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('CPU'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api_append_text($provider, $columns, 'CPU');
    }
    elseif($data_type == 'migration-status-public') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('VM Type'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'vm-distribution-os-public') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Operating System'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'vm-count-by-flavors-public') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Flavor'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'data-center-filter') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'tag-keys-private') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'tag-values-of-tag-name-private') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'tag-keys-public') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'tag-values-of-tag-name-public') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['key'];
            $provider_php_arr[$k]['value'] = $provider_data['value'];
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'tag-cost-trend-private') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array(t('Time Duration'), $tagvalue);
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
        $out = json_decode($out);
        $dataCenterCost = isset($json_data['dataCenterCost']) ? $json_data['dataCenterCost'] : '';
        array_unshift($out , array("dataCenterCost" => number_format($dataCenterCost, 2)));
        $out = json_encode($out);
    }
    elseif($data_type == 'tag-cost-trend-public') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array(t('Time Duration'), $tagvalue);
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'ri-owned-vs-burned-down') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array(t("Instance Type"),t("Owed"),t("Burndown"));
        $stack = false;
        $provider_php_arr = array();
        foreach($provider as $provider_data){
            $provider_php = array();
            if($provider_data != null){
                $provider_php[] = $provider_data['key'];
                foreach($provider_data['datafeedData'] as $providers){
                    $provider_php[] = (float) $providers['value'];
                    $provider_php[] = (float) $providers['key'];

                }
                array_push($provider_php_arr , $provider_php);
            }
        }
        array_unshift($provider_php_arr , $columns);
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'ondemand-vs-reservation-count') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Instance Type'), t('Count'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'instance-type-by-reservation') {
        $provider = empty($json_data['DataFeedList'][0]['datafeedData']) ? array() : $json_data['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Instance Type'), t('Cost'));
        $out = jsdn_google_chart_json_array_one_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'instance-type-by-ondemand') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array(t("Instance Type"),t("Cost"),t("Hours"));
        $out = jsdn_google_chart_json_array_stacked_dimensional_api($provider, $columns, $stack);
    }
    elseif($data_type == 'ondemand-vs-reserved-hours') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array();
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
    }
    return $out;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_json_array_one_dimensional_api($provider, $columns = array()) { 
    $provider_php_arr = array();
    foreach($provider as $provider_data){
        $provider_php = array();
        $provider_php[] = $provider_data['key'];
        $provider_php[] = (float) $provider_data['value'];
        array_push($provider_php_arr , $provider_php);
    }
    array_unshift($provider_php_arr , $columns);
    $result = json_encode($provider_php_arr);
    return $result;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_json_array_two_dimensional_api($provider, $columns = array()) { 
    $provider_php_arr = array();
    if(count($columns) == 0){
        $provider_columns = array(t('Time Duration')); 
        foreach($provider[0]['datafeedData'] as $provider_column){
           if($provider_column['key'] == null){
               $provider_columns = $columns;
           }
           elseif($provider_column['key'] == 'SAAS'){
               array_push($provider_columns , t('All Providers'));
           }
           else{
               array_push($provider_columns , $provider_column['key']);
           }    
        }
        if(count($provider_columns) == 1){
             $provider_columns = array(t('Time Duration'), t('IaaS')); 
        }
    }
    else{
        $provider_columns = $columns; 
    }

    foreach($provider as $key=>$provider_data){
        $provider_php = array();
        $provider_php[] = $provider_data['key'];
        $provider_array = $provider_data['datafeedData'];
        if($provider_array != null){
            foreach($provider_array as $provider_array_data){
                $provider_php[] = (float) $provider_array_data['value'];
            }     
            array_push($provider_php_arr , $provider_php);
        }
    }
    array_unshift($provider_php_arr , $provider_columns);
    $result = json_encode($provider_php_arr);
    return $result;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_json_array_three_dimensional_api($provider, $columns = array()) { 
    $provider_php_arr = array();
    foreach($provider as $provider_data){
        $provider_php = array();
        if($provider_data != null){
            $provider_php[] = $provider_data['datafeedData'][0]['key'];
            $provider_php[] = (float) $provider_data['datafeedData'][0]['value'];
            array_push($provider_php_arr , $provider_php);
        }
        
    }
    array_unshift($provider_php_arr , $columns);
    $result = json_encode($provider_php_arr);
    return $result;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_json_array_stacked_dimensional_api($provider, $columns = array(), $stack) { 
    $provider_php_arr = array();
    foreach($provider as $provider_data){
        $provider_php = array();
        if($provider_data != null){
            $provider_php[] = $provider_data['key'];
            foreach($provider_data['datafeedData'] as $providers){
                $provider_php[] = (float) $providers['key'];
                $provider_php[] = (float) $providers['value'];
            }
            array_push($provider_php_arr , $provider_php);
        }
    }
    array_unshift($provider_php_arr , $columns);
    $result = json_encode($provider_php_arr);
    return $result;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_json_array_one_dimensional_api_append_text($provider, $columns = array(), $append_text = '') { 
    $provider_php_arr = array();
    foreach($provider as $provider_data){
        $provider_php = array();
        $provider_php[] = $provider_data['key'].' '.$append_text;
        $provider_php[] = (float) $provider_data['value'];
        array_push($provider_php_arr , $provider_php);
    }
    array_unshift($provider_php_arr , $columns);
    $result = json_encode($provider_php_arr);
    return $result;
}

function jsdn_google_chart_build_multiple_data_api($data, $type){  
    $json_data1 = json_decode($data[1], true);
    $json_data2 = json_decode($data[2], true);
    if($type == 'vm-count-by-instance-type') {
        $provider1 = empty($json_data1['DataFeedList'][0]['datafeedData']) ? array() : $json_data1['DataFeedList'][0]['datafeedData'];
        $provider2 = empty($json_data2['DataFeedList'][0]['datafeedData']) ? array() : $json_data2['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Instance Type/Size/Flavor'), t('Cost'), t('Count'));
        $out = jsdn_google_chart_multiple_json_array_one_dimensional_api($provider1, $provider2, $columns);
    }
    if($type == 'vm-count-by-source') {
        $provider1 = empty($json_data1['DataFeedList'][0]['datafeedData']) ? array() : $json_data1['DataFeedList'][0]['datafeedData'];
        $provider2 = empty($json_data2['DataFeedList'][0]['datafeedData']) ? array() : $json_data2['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Source of Creation'), t('Cost'), t('Count'));
        $out = jsdn_google_chart_multiple_json_array_one_dimensional_api($provider1, $provider2, $columns);
    }
    if($type == 'resource-count') {
        $provider1 = empty($json_data1['DataFeedList'][0]['datafeedData']) ? array() : $json_data1['DataFeedList'][0]['datafeedData'];
        $provider2 = empty($json_data2['DataFeedList'][0]['datafeedData']) ? array() : $json_data2['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Resource Region'), t('Cost'), t('Count'));
        $out = jsdn_google_chart_multiple_json_array_one_dimensional_api($provider1, $provider2, $columns);
    }
    if($type == 'cost-by-tags') {
        $provider1 = empty($json_data1['DataFeedList'][0]['datafeedData']) ? array() : $json_data1['DataFeedList'][0]['datafeedData'];
        $provider2 = empty($json_data2['DataFeedList'][0]['datafeedData']) ? array() : $json_data2['DataFeedList'][0]['datafeedData'];
        $columns = array(t('Tags'), t('Cost'), t('Count'));
        $out = jsdn_google_chart_multiple_json_array_one_dimensional_api($provider1, $provider2, $columns);
    }
    if($type == 'vm-cost-tag-key') {
        $provider1 = empty($json_data1['DataFeedList'][0]['datafeedData']) ? array() : $json_data1['DataFeedList'][0]['datafeedData'];
        $provider2 = empty($json_data2['DataFeedList'][0]['datafeedData']) ? array() : $json_data2['DataFeedList'][0]['datafeedData'];
        $columns = array(t('VM'), t('VM Cost'), t('VM Count'));
        $out = jsdn_google_chart_multiple_json_array_one_dimensional_api($provider1, $provider2, $columns);
    }
    
    return $out;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_multiple_json_array_one_dimensional_api($provider1, $provider2, $columns = array()) { 
    $provider_php_arr1 = array();
    $provider_php_arr2 = array();
    foreach($provider1 as $provider_data){
        $provider_php1 = array();
        $provider_php1[] = $provider_data['key'];
        $provider_php1[] = (float) $provider_data['value'];
        array_push($provider_php_arr1 , $provider_php1);
    }
    foreach($provider2 as $provider_data){
        foreach($provider_php_arr1 as $provider){
                $provider_php2 = array();
                if($provider[0] == $provider_data['key']){
                        $provider_php2[] = $provider_data['key'];
                        $provider_php2[] = (float) $provider_data['value'];
                        $provider_php2[] = $provider[1];
                        array_push($provider_php_arr2 , $provider_php2);
                }

        }
    }
    array_unshift($provider_php_arr2 , $columns);
    $result = json_encode($provider_php_arr2);
    return $result;
}
