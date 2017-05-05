<?php
	include 'config/config.php';
	define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
	require_once __DIR__ . '/facebook-sdk-v5/autoload.php';
	ini_set('display_errors',1);
	$app_id = "1348764941859694";
	$app_secret = "c8fb3adb5443de8af1b568e11d863b2e";
  $fb = new Facebook\Facebook([
	'app_id' => $app_id, // Replace {app-id} with your app id
	'app_secret' => $app_secret,
	'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($app_id); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;
$fb->setDefaultAccessToken($_SESSION['fb_access_token']);

try {
  $response = $fb->get('/me?fields=id,name,email');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$_SESSION['name'] = $userNode->getName();
$_SESSION['email'] = $userNode->getField('email');
$data = array('ql' => "select * where email='".$_SESSION['email']."'");		
//reading data ruangan
$users = $client->get_collection('users',$data);
//do something with the data
if($users->has_next_entity()) {
	$user = $users->get_next_entity();
	$_SESSION['uuid'] = $user->get('uuid');
}else{	
	$endpoint = 'users';
	$query_string = array();
	$body = array(
		"name" => $_SESSION['name'],
		"email" => $_SESSION['email'],
		"username" => strtolower(str_replace(" ","",$_SESSION['name'])),
		"password" => strtolower(str_replace(" ","",$_SESSION['name']))
		);
	$result = $client->post($endpoint, $query_string, $body);
	if ($result->get_error()){
		echo "error creating";
	} else {
		sleep(1);
		$data = array('ql' => "select * where email='".$_SESSION['email']."'");		
		//reading data ruangan
		$users = $client->get_collection('users',$data);
		//do something with the data
		$user = $users->get_next_entity();	
		$_SESSION['uuid'] = $user->get('uuid');
	}
}

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
header('Location: http://pinopi.com/booking/?page=dashboard');
?>