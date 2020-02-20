<?php
/**
 * @file
 * features_store.rules_defaults.inc
 */

/**
 * Implements hook_default_rules_configuration().
 */
function features_store_default_rules_configuration() {
  $items = array();
  $items['rules_create_jsdn_session'] = entity_import('rules_config', '{ "rules_create_jsdn_session" : {
      "LABEL" : "Create JSDN Session",
      "PLUGIN" : "reaction rule",
      "OWNER" : "rules",
      "TAGS" : [ "jsdn" ],
      "REQUIRES" : [ "php", "rules" ],
      "ON" : { "user_login" : [] },
      "DO" : [
        { "php_eval" : { "code" : "\\u003Cscript\\u003E\\r\\nalert(\\u0027Jubin\\u0027);\\r\\n\\/\\/activateJSDNSession();\\r\\nurl=\\u0027http:\\/\\/store1.tgtmkt76.com:8080\\/jsdn\\/login\\/doCMSPostLogin.action\\u0027;\\r\\n\\t$(\\u0027#logintoJSDN\\u0027).attr(\\u0027action\\u0027,url);\\r\\n\\t$(\\u0027#logintoJSDN\\u0027).submit();\\r\\n\\u003C\\/script\\u003E" } }
      ]
    }
  }');
  $items['rules_re_flag_node_recently_viewed'] = entity_import('rules_config', '{ "rules_re_flag_node_recently_viewed" : {
      "LABEL" : "Re-flag node recently_viewed",
      "PLUGIN" : "reaction rule",
      "OWNER" : "rules",
      "REQUIRES" : [ "flag", "rules" ],
      "ON" : { "node_view--product_page" : { "bundle" : "product_page" } },
      "DO" : [
        { "flag_unflagnode" : {
            "flag" : "recently_viewed",
            "node" : [ "node" ],
            "flagging_user" : [ "site:current-user" ],
            "permission_check" : 1
          }
        },
        { "flag_flagnode" : {
            "flag" : "recently_viewed",
            "node" : [ "node" ],
            "flagging_user" : [ "site:current-user" ],
            "permission_check" : 1
          }
        }
      ]
    }
  }');
  return $items;
}
