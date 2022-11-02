<?php
    define('FACEBOOK_SDK_V4_SRC_DIR', 'Facebook/');
    require_once('Facebook/autoload.php');
              
    $appid = "631757735286744";
    $appsecret = "3f1270408649125a1edf2e3d0d1e83a4";
    $pageAccessToken = "EAAIZBlI9lV9gBAL3fZCQdx7moOoEMx6nzkxVCIg7qQZAIu07kVYSEvkzDc2idVtWvNMMOPgrRVjNMnfYGVMadGzzhkvub9vxEl8NXaKWP2HR0NPskLZCeZBFCSk4z80W5N5qTRrIagGmCrPNztL8OeXA11wr7PFB6vs7fUS2ZANkekevkAU3qN";
    $pageFeed = "/me/feed";//https://www.facebook.com/profile.php?id=100087160574634
    
    $pagTitulo="Samuel Arreortua";
    $pagURL = "https://images2.alphacoders.com/564/564835.jpg";

$fb = new Facebook\Facebook([
    'app_id' => $appid,
    'app_secret' => $appsecret
]);
$linkData = [
    'link' => $pagURL,
    'message' => $pagTitulo
];
try {
    $response = $fb->post($pageFeed, $linkData, $pageAccessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: '.$e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: '.$e->getMessage();
    exit;
}
$graphNode = $response->getGraphNode();



?>