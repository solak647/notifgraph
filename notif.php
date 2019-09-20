<?php


require_once 'vendor/autoload.php';

$botKey = "612232584:AAEZgo3KTP9RO3iH2vIHHtDGL5ZCOqxCNgY";

$requestFactory = new Http\Factory\Guzzle\RequestFactory();
$streamFactory = new Http\Factory\Guzzle\StreamFactory();
$client = new Http\Adapter\Guzzle6\Client();

$apiClient = new \TgBotApi\BotApiBase\ApiClient($requestFactory, $streamFactory, $client);
$bot = new \TgBotApi\BotApiBase\BotApi($botKey, $apiClient, new \TgBotApi\BotApiBase\BotApiNormalizer());

$userId = '430774199';

if (isset($_GET['validationToken']))
{
    http_response_code(200);
    echo $_GET['validationToken'];
    return;
}

$get = "GET\r\n";
foreach($_GET as $key => $value){
$get = $get . $key . " : " . $value . "\r\n";
}
$get = $get . "\r\n";

$post = "POST\r\n";
foreach($_POST as $key => $value){
$post = $post . $key . " : " . $value . "\r\n";
}
$post = $post . "\r\n";
$bot->send(\TgBotApi\BotApiBase\Method\SendMessageMethod::create($userId, $get));
$bot->send(\TgBotApi\BotApiBase\Method\SendMessageMethod::create($userId, $post));
?>