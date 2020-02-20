<?php

function services_jsdn_resource() {  
  $resources = array(
    'api' => array(
      'actions' => array(
        'create' => array(
      	'help' => 'Create products from external site.',
      	'file' => array(
        	'type' => 'inc',
        	'module' => 'services_jsdn',
                'name' => 'includes/services_jsdn.resource',
      	),
      	'callback' => 'services_jsdn_resource_retrieve',
      	'access callback' => 'user_access',
      	'access arguments' => array('access content'),
      	'access arguments append' => FALSE,
        'args' => array(
            array(
              'name' => 'node',
              'optional' => FALSE,
              'source' => 'data',
              'description' => 'The node data to create',
              'type' => 'array',
            ),
          ),
    	),
      ),
    ),
  );
  return $resources;
}
