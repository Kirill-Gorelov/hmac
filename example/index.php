<?php
require_once __DIR__.'/../src/php/hmac.php';
// use kirill\hmac;

$hmac = new kirill\hmac\Hmac;
// var_dump($hmac);

define('PUBLIC_KEY','test_key');
define('PRIVATE_KEY','test_key_private');

$arr = array('login'=>'My_login',
             'password'=>'My_pass',
             'email'=>'My_email');

var_dump($hmac->make_data_hmac($arr, PRIVATE_KEY));
$signature = $hmac->make_data_hmac($arr, PRIVATE_KEY);
var_dump($signature);
var_dump($hmac->check_data_hmac($arr, PRIVATE_KEY,$signature));

?>