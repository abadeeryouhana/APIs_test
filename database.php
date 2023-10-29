<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'petralab');
define('NAME', 'api_test');

$db = new mysqli(HOST ,USER ,PASS ,NAME);
if ($db->connect_errno) {
	die("Database connection error:" . $db->connect_errno);
}
$db -> set_charset("utf8");

define('SECRET_KEY', "apitest");

function createToken($data)
{
    $tokenGeneric = SECRET_KEY.$_SERVER["SERVER_NAME"]; 

    $token = hash('sha256', $tokenGeneric.$data);

    return array('token' => $token);
}

?>