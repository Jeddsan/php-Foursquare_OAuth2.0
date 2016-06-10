<?php
//Values
$client_id="CLIENT_ID"; //Go to https://foursquare.com/developers/apps
$client_secret="CLIENT_SECRET"; //Got to https://foursquare.com/developers/apps
$redirect_uri="REDIRECT_URI"; //You must add this url as well at https://foursquare.com/developers/apps

if(isset($_GET["code"])){
  $auth_code="$client_id:$client_secret";
  $auth_code=base64_encode($auth_code);
  $redirect_uri=urldecode($redirect_uri);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://foursquare.com/oauth2/access_token?client_id=$client_id&grant_type=authorization_code&redirect_uri=$redirect_uri&code=".$_GET['code']);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $headers = array();
  $headers[] = "Authorization: Basic $auth_code";
  $headers[] = "Content-Type: application/x-www-form-urlencoded";

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $server_output = curl_exec ($ch);

  curl_close ($ch);

  $auth = json_decode($server_output, true);
  var_dump($auth);
  //For every query, now you need the access_token.
}
echo "<a href='https://foursquare.com/oauth2/authenticate?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri'>
Login with Foursquare
</a>";
