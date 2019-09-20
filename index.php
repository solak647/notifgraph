<?php

require_once 'vendor/autoload.php';

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;


$settings = include('./Settings.php');


$guzzle = new \GuzzleHttp\Client();
$url = 'https://login.microsoftonline.com/' . $settings['TenantId'] . '/oauth2/v2.0/token?api-version=1.0';
$token = json_decode($guzzle->get($url, [
    'form_params' => [
        'client_id' => $settings['ClientId'],
        'client_secret' => $settings['ClientSecret'],
        'scope' => 'https://graph.microsoft.com/.default',
        'grant_type' => 'client_credentials',
    ],
])->getBody()->getContents());
$accessToken = $token->access_token;

$graph = new Graph();
$graph->setAccessToken($accessToken);



function find_in_docs($graph, $docs)
{
    echo '<ul>';
    foreach ($docs as $doc)
    {
        echo '<li><a href="'.$doc->getProperties()['@microsoft.graph.downloadUrl'].'">'.$doc->getName().'</a></li>';
        if ($doc->getFolder() != null)
        {
            $docs2 = $graph->createCollectionRequest("GET", "/groups/e26d60f7-2eb5-42b2-8306-094f0ec89d65/drive/items/".$doc->getId()."/children")
                        ->setReturnType(Model\DriveItem::class)
                        ->execute();
            find_in_docs($graph, $docs2);
        }
    }
    echo '</ul>';
}
function print_files($graph)
{
    $docs = $graph->createCollectionRequest("GET", "/groups/e26d60f7-2eb5-42b2-8306-094f0ec89d65/drive/root/children")
                    ->setReturnType(Model\DriveItem::class)
                    ->execute();
    find_in_docs($graph, $docs);
}








print_files($graph);

?>