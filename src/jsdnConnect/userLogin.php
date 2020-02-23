<?php
$server_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
#define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
define("JSDN_OAUTH_HOST", $server_url);
// echo DRUPAL_ROOT . 'teste';
// die;
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';

// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
global $language;
$username = urldecode($_POST['username']);
$password = urldecode($_POST['password']);
$result = ajax_login_validate( $username, $password);
print drupal_json_encode($result);
die();


function ajax_login_validate( $username, $password )
{
    global $role;
    global $rolecode;
    global $user;
    global $fname;
    global $lname;
    global $language;

    // In our case we're assuming that any username with an '@' sign is an e-mail address,
    // hence we're going to check the credentials against our external system.
    if ( strpos( $username, '@' ) !== false ) {
        $result = validateExternalUserAjax( $username, $password );
        if($result == 'true'){
			if ( $rolecode == 'End User' ){
				$roleval = user_role_load_by_name('end user')->rid;
			}
			elseif($rolecode == 'Enterprise Admin' ){
				$roleval = user_role_load_by_name('Enterprise Admin')->rid;
			}
            else {
				$roleval = user_role_load_by_name('customer admin')->rid;
            }
                $account = user_external_load($username);
                $userlanguage=$account->language;
		if ($language == 'pt'){$language = 'pt-br';}
                if (!$account) {
                // Register this new user.
                    $userinfo = array(
                        'name' => $username,
                        'pass' => user_password(),
                        'mail' => $username,
                        'init' => $username,
                        'language'=>$language,
                        'roles'=>array(
                              $roleval => 'authenticated user',
                            ),
                        'status' => 1,
                        'access' => REQUEST_TIME,
                        'field_first_name' => array(
                            'und' => array(
                                0 => array(
                                    'value' => $fname,
                                ),
                            )),
                        'field_last_name' => array(
                               'und' => array(
                                    0 => array(
                                    'value' => $lname,
                                ),
                            ))
                    );
                    $account = user_save('', $userinfo);
                    // Terminate if an error occurred during user_save().
                    if (!$account) {
                      return array('message' => t("Error saving user account"), 'errorMsg' => t("Error saving user account."));
                    }
                    user_set_authmaps($account, array("authname_extauth" => $username));
		}
                else {
                        $userinfo = array(
                            'language'=>$language,
                            'roles'=>array(
                              $roleval => 'authenticated user',
                            ),
                        );
                        user_save($account, $userinfo);
                }
                // Log user in.
                $account_user = array('uid' => $account->uid); //existing uid
                user_login_submit(array(), $account_user);
                $cart = jsdn_cart_get_cart();
				$node_url = '';
                if(empty($cart)){
                    $cart_Url = JSDN_OAUTH_HOST ."/jsdn/dashboard/dashboardHome.action";
                    $cart_count = 0;
                }elseif((count($cart) == 1) && ($rolecode == 'End User')){
                    $cart_Url = jsdn_cart_external_cart($cart);
					$cart = array_values($cart);
					$node_url = drupal_get_path_alias('node/' . $cart[0]->nid);
                    $cart_count = count($cart);
                }else{
                    $cart_Url = jsdn_cart_external_cart($cart);
                    $cart_count = count($cart);
                }
                return array('message' => $_SESSION['authToken'], 'errorMsg' => t("external_logged_in_successfully"), 'role' => $rolecode, 'cart_url' => $cart_Url, 'node_url' => $node_url,  'cart_count' => $cart_count);
        }
        else{
            return $result;
        }
    }
    else {
        $uid = user_authenticate($username, $password);
        if($uid){
            $account_user = array('uid' => $uid); //existing uid
            user_login_submit(array(), $account_user);
            return array('message' => $uid, 'errorMsg' => t("Logged In Successfully."));
        }
        else{
            drupal_set_message(t('Sorry, unrecognized username or password.'), 'error');
            return array('message' => t("Failed login."), 'errorMsg' => t("Logged In Successfully."));
        }
    }
}
/**
* This is the helper function that you will need to modify in order to invoke your external
* authentication mechanism.
*/
function validateExternalUserAjax( $username, $password ){
    global $fname;
    global $lname;
    global $authToken;
    global $companyID;
    global $role;
    global $rolecode;
    global $language;
    global $jsdnURL;
    global $cAcronym;
    global $_domain;
    $domain_is_store = domain_conf_variable_get($_domain['domain_id'], 'domain_is_store');

    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => JSDN_OAUTH_HOST."/jsdn/login/doCMSLogin.action",
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 500,
        CURLOPT_USERAGENT      => "CMS", // who am i
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_POSTFIELDS     => array(
            'loginEmail' => $username,
            'password' => $password,
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 500);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt_array($ch, $curlConfig);
    $result = curl_exec($ch);
    curl_close($ch);
    $array = json_decode($result, true);
    $loginStatus = $array["status"];
    $errorMsg = $array["errorMsg"];
    if ( $loginStatus == 1 ){
            $fname=$array["profile"]["firstname"];
            $lname=$array["profile"]["lastname"];
            $role=$array["profile"]["roleName"];
            $rolecode=$array["profile"]["roleCode"];
            $currencySymbol=$array["profile"]["currencySymbol"];
            $cAcronym=$array["profile"]["companyacronym"];
            $departmentName=$array["profile"]["departmentName"];
            if(!empty($departmentName)){
                $serviceIds=$array["servicesList"];
                $_SESSION['serviceIds'] = $serviceIds;
            }
            $languagecode=$array["profile"]["language"];
            list($language, $b) = explode('_', $languagecode);
            $jsdnHelpLink=$array["HelpLink"];
            $companyID=$array["profile"]["compId"];
            $_SESSION['companyID']=$companyID;
            $_SESSION['firsttimelogin']=$array["firsttimelogin"];
            $authToken=$array["authToken"];
            $_SESSION['authToken']=$authToken;
            $_SESSION['companyacronym'] = rawurlencode($cAcronym);
            $_SESSION['currencySymbol'] = $currencySymbol;
            $_SESSION['departmentName'] = $departmentName;
            $_SESSION['username'] = $fname.' '.$lname ;
            $_SESSION['companyname'] = $array["profile"]["companyname"];
            $_SESSION['useremail'] = $array["profile"]["email"];

            if(isset($array["cartItemCount"])){
                $cartCount=$array["cartItemCount"];
                $_SESSION['cartCount']=$cartCount;
            }
            $_SESSION['MenuJSON']=json_encode($array);
            $_SESSION['jsdnHelpURL']=$jsdnHelpLink;
            return 'true';
    }
    else{
        return array('message' => 'external_login_fail', 'errorMsg' => urlencode($errorMsg),'enterprisestore' => $domain_is_store);
    }
}
