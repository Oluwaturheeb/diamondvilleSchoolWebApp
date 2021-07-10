<?php
// facebook setup
$fb = new Facebook\Facebook([
	'app_id' => config('social/fAppId'), // change this to you app id
	'app_secret' => config('social/fAppSecret'), // change this to app secret 
	'graph_api_version' => 'v5.0',
]);

// get uri
$u = $fb->getRedirectLoginHelper();
$fURL = $u->getLoginUrl(HOST. config('social/fRedirect'));

// get user profile from facebook
if (isset($_GET['code'], $_GET['state'])) {
	$r = $fb->get('/me', config('social/fToken'));
	$fProfile =  $r->getGraphUser();
} else $fProfile = null;
// facebook ends here

// Google setup
$g = new Google_Client();
$g->setClientId(config('social/gAppId')); // change this to you app id
$g->setClientSecret(config('social/gAppSecret')); // change this to app secret 
$g->setRedirectUri(HOST. config('social/gRedirect')); //change this to where you want to redirect to after authentication
$g->addScope('email');
$g->addScope('profile');
$g->setPrompt('consent');
// $g->addScope('https://www.googleapis.com/auth/user.phonenumbers.read');


if (isset($_GET['code'], $_GET['prompt'])) {
	$auth = $g->authenticate($_GET['code']);
	if (isset($auth['access_token'])) {
	    $aCT = $auth['access_token'];
    	$g->setAccessToken($aCT);
    	$gs = new Google_Service_Oauth2($g);
    	$gProfile = $gs->userinfo->get();
	}
} else $gProfile = null;
	
$gLogout = $g->revokeToken();
$gURL = $g->createAuthUrl();