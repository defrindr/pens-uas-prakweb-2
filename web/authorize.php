<?php
include_once '../helpers/HttpHelper.php';

define("GCLIENT_ID","793113128601-f5d7ro24m6ktd2sbdue1t44b834f8o27.apps.googleusercontent.com");
define("GCLIENT_SECRET","ASPmtGj_OIfpzZVoyFzEMzV_");

$response = HttpHelper::postApi("https://www.googleapis.com/oauth2/v4/token",[
    "code"=> $_GET['code'],
    "client_id"=> GCLIENT_ID,
    "client_secret"=> GCLIENT_SECRET,
    "redirect_uri"=> 'http://localhost:8085/uts_web/web/authorize.php',
    "grant_type"=> 'authorization_code'
]);

// var_dump("https://www.googleapis.com/oauth2/v1/userinfo?access_token=".$response->access_token);
// die;

$info = HttpHelper::getApi("https://www.googleapis.com/oauth2/v1/userinfo",[
    "access_token"=>$response->access_token
],[
    'Authorization'=>"Bearer ".$response->access_token
]);

