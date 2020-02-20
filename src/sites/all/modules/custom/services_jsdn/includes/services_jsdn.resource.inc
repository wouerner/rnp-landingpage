<?php
/**
 * [housing_schemes_services_resource_retrieve] definition.
 * Returns the information about a housing scheme.
 * @param $nid
 *   The nid of the housing_scheme node.
 * @return array
 *	The node processed information array.
 */
function services_jsdn_resource_retrieve($node) {
    //Create return object
    watchdog('jsdnapi', 'Request %exception.', array('%exception' => json_encode($node)));  
    $publish = $node['publish'];
    if($node['publish'] === 'true'){
        $return_obj = array();
        $serviceList = $node['Services']['serviceList'];
        foreach($serviceList as $services){
            unset($_SESSION['storeurl']);
            $service_name = $services['name'];
            $service_code = $services['code'];
            $service_data = $services;

            $is_exits = services_jsdn_check_service_name($service_code);
            if(!empty($is_exits)){
                $service_data['nid'] = $is_exits;
            }
            $_SESSION['storeurl'] = $node['storeurl'];
            $result = services_jsdn_node_data_object_create($service_data, $publish);
            if($result->nid) {
                $return_obj[] = array(
                    'message' => t('Success'),
                    'code' => 200,
                    'nid' => $result->nid,
                );
            }  else {
                $return_obj[] = services_error('Unsuccessful product creation.', 5201, array(
                    'error' => t('Unsuccessful product creation'),
                    'code' => 5201,
                ));
            }
        }
    }
    else{
        $service_name = $node['ServiceName'];
        $service_code = $node['ServiceName'];
        $is_exits = services_jsdn_check_service_name($service_code);
        if(!empty($is_exits)){
            $service_data['nid'] = $is_exits;
        }
        $_SESSION['storeurl'] = $node['storeurl'];
        $result = services_jsdn_node_data_object_create($service_data, $publish);
        if($result->nid) {
            $return_obj = array(
                'message' => t('Success'),
                'code' => 200,
                'nid' => $result->nid,
            );
        }  else {
            $return_obj = services_error('Unsuccessful product creation.', 5201, array(
                'error' => t('Unsuccessful product creation'),
                'code' => 5201,
            ));
        }
    }
    
  return $return_obj;
}
/**
 * Create or Update the product page data.
 * 
 * @return
 *   NODE data.
 */
function services_jsdn_node_data_object_create($service_data, $publish) {
    $domains = domain_domains();
    $domain = domain_lookup_simple($_SESSION['storeurl']); 
    if(isset($service_data) && empty($service_data['nid']) && $publish === "true"){
        $node = new stdClass();
        $node->title = $service_data['name'];
        $node->body['und'][0]['value'] = $service_data['description']."<br><br>".$service_data['moreInfo'];;
        $node->body['und'][0]['format'] = 'full_html';
        $node->field_offer_details['und'][0]['value'] = $service_data['requirements'];
        $node->field_offer_details['und'][0]['format'] = 'full_html';
        $node->field_case_studies['und'][0]['value'] = $service_data['faqs'];
        $node->field_case_studies['und'][0]['format'] = 'full_html';
        if(!empty($service_data['mediaSet']['serviceMedia'][0]['mediaName'])){ 
            $node->field_features['und'][0]['value'] = services_jsdn_supplymentary_materials($service_data['mediaSet']['serviceMedia']);
            $node->field_features['und'][0]['format'] = 'full_html';
        }
        $node->field_service_id['und'][0]['value'] = $service_data['code'];
        $image_url = $service_data['mediaSet']['serviceMedia'][0]['logoList'][0]['urn'];
		$image_extension = $service_data['mediaSet']['serviceMedia'][0]['logoList'][0]['mimeType'];
        if(!empty($image_url)){ $image_logo = services_jsdn_save_image_local($image_url, $image_extension);}
        if(isset($image_logo)){$node->field_logo['und'][0] = $image_logo;}
        $node->type = "product_page";
        $node->language = 'en'; // Or e.g. 'en' if locale is enabled
        $node->status = 1; //(1 or 0): published or not
        $node->promote = 0; //(1 or 0): promoted to front page
        $node->comment = 2; // 0 = comments disabled, 1 = read only, 2 = read/write
      // Term reference (taxonomy) field
        if($service_data['serviceCategories']['categoryList'][0]['name'] == 'IaaS'){
          $term_array = taxonomy_get_term_by_name('IaaS');
          $term = reset($term_array);
          $node->field_service_type['und'][0]['tid'] = $term->tid;
          $term_name_category = $service_data['serviceCategories']['categoryList'][0]['serviceSubCategories'][0]['name'];
          $term_name_category_array = taxonomy_get_term_by_name($term_name_category);
          $term_category = reset($term_name_category_array);
          if(!empty($term_category->tid)){
              $node->field_category['und'][0]['tid'] = $term_category->tid;
          }
        }
        else{
          $term_array = taxonomy_get_term_by_name('SaaS');
          $term = reset($term_array);
          $node->field_service_type['und'][0]['tid'] = $term->tid;
          for($i=0;$i<count($service_data['serviceCategories']['categoryList']);$i++){
              $term_name_category = $service_data['serviceCategories']['categoryList'][$i]['name'];
              $term_name_category_array = taxonomy_get_term_by_name($term_name_category);
              $term_category = reset($term_name_category_array);
              if(!empty($term_category->tid)){
                  $node->field_category['und'][$i]['tid'] = $term_category->tid;
              }
          }
        } 
        $node->domains = array();
        foreach ($domains as $key=>$id) {
            if($domain['domain_id'] == $key){
                 $node->domains[$key] = $key;
            }
            else {
                $node->domains[$key] = 0;
            } 
        }
        $node->domain_site = 0;
        $node->subdomains[] = $domain['sitename'];
        node_object_prepare($node); // Sets some defaults. Invokes hook_prepare() and hook_node_prepare().
        $node->uid = 1; 
        $node = node_submit($node); // Prepare node for saving
    }
    else if(isset($service_data) && !empty($service_data['nid']) && $publish === "true") {
        $node = node_load($service_data['nid']);
        $domain_key = array_search( $domain['domain_id'], $node->domains );
        if($domain_key == false) 
        {
            $node->domains[ $domain['domain_id'] ] = $domain['domain_id'];   
            $node->subdomains[] = $domain['sitename'];
        }
    }
    else if(isset($service_data) && !empty($service_data['nid']) && $publish === "false"){
	
		watchdog('jsdnapi', 'Request %exception.', array('%exception' => 'false condition'));  

	
        $node = node_load($service_data['nid']);
		
        $domain_key = array_search( $domain['domain_id'], $node->domains );
        $subdomains_key = array_search( $domain['sitename'], $node->subdomains );
        if( $domain_key !== false ) 
        {
            $node->domains = array_diff($node->domains, array($domain_key));
            $node->subdomains = array_diff($node->subdomains, array($domain['sitename']));
        }
    }
    else{
        $node = new stdClass();
    }
    node_save($node);
    return $node;
}
/**
 *  function to construct the supplymentary data
*/
function services_jsdn_supplymentary_materials($supplymentary_materials){
    $html_data = '<ul>';
    foreach($supplymentary_materials as $supplymentary){
         if($supplymentary['mediaUrn'] == null){
            $html_data .= '<li><a href="'.$supplymentary['mediaName'].'" name="'.$supplymentary['mediaName'].'" target="_blank">'.$supplymentary['mediaName'].'</a></li>';
        }
        else{
            $html_data .= '<li><a href="/jsdn'.$supplymentary['mediaUrn'].'" name="'.$supplymentary['mediaName'].'" target="_blank">'.$supplymentary['mediaName'].'</a></li>';
        }
    }
    $html_data .= '</ul>';
    return $html_data;
}
/**
 * Api function to fetch a url and save image locally
*/
function services_jsdn_save_image_local($url = '', $image_extension = '') {
  $data = get_services_jsdn_image_api_call($url, $image_extension);
  $filename = jsdnapi_fetch_filename($data);
  if(isset($data) && !empty($filename)) {
    $file = file_save_data($data['body'], 'public://'.$filename,FILE_EXISTS_REPLACE);
    return (array)$file;
  }
  else{
    return;
  }
}
/**
 * Retrieve service image from jsdn server.
 * 
 * @return
 *   JSON data.
 */
function get_services_jsdn_image_api_call($api_url, $image_extension = '') {
    if (!empty($_SERVER['HTTPS'])) {
        $JSDN_MARKETPLACE_HOST = 'https://'.$_SESSION['storeurl'];
    }
    else {
        $JSDN_MARKETPLACE_HOST = 'http://'.$_SESSION['storeurl'].':8080';
    }
    
    $url = str_replace('http://', '', $JSDN_MARKETPLACE_HOST);
    $url = str_replace('https://', '', $url);
    $url = str_replace(':8080', '', $url);
    return jsdnapi_api_call($JSDN_MARKETPLACE_HOST, $url, $api_url, true, $image_extension);
}
/**
 * Api function to check whether service id exits or not
*/
function services_jsdn_check_service_name($services_name) {

	watchdog('jsdnapi', 'Request %exception.', array('%exception' => $services_name));  

    $is_available = db_select('field_data_field_service_id', 'n')
          ->fields('n')
          ->condition('field_service_id_value', $services_name, '=')
          ->execute()
          ->fetchAssoc();
    return $is_available['entity_id'];
}
