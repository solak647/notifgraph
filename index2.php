<?php

require_once 'vendor/autoload.php';

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;

$settings = include('./Settings.php');
try {
	$authCtx = new AuthenticationContext($settings['Url']);
	$resource = 'c3ef7b84-2588-4f84-bc6e-e5366eb3da47';
	//$resource = '57541037-94a5-4d2d-96ab-969663e85b11';
	//$resource = '00000002-0000-0000-c000-000000000000';
	$credi = (object) [
		'ClientId'=> $settings['ClientId'],
		'ClientSecret'=> $settings['ClientSecret']
	];
	$user = (object) [
		'Username'=> $settings['UserName'],
		'Password'=> $settings['Password']
	];
	$authCtx->acquireTokenForPassword($resource, $credi, $user);
	$ctx = new ClientContext('https://omnisoftory.sharepoint.com',$authCtx);
	readUserProfiles($ctx);
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}

function getSiteUsers(ClientContext $ctx){
    $web = $ctx->getWeb();
    $users = $web->getSiteUsers();
    $ctx->load($users);
    $ctx->executeQuery();
    foreach( $users->getData() as $user ) {
        print "User title: '{$user->Title}'\r\n";
    }
}

function readUserProfiles(ClientRuntimeContext $ctx){
    #read my user profile properties
    $peopleManager = new \Office365\PHP\Client\SharePoint\UserProfiles\PeopleManager($ctx);
    $properties = $peopleManager->getMyProperties();
    $ctx->load($properties);
    $ctx->executeQuery();
    print "Account Name '{$properties->AccountName}' \r\n";
    #print properties
    foreach( $properties->UserProfileProperties as $p ) {
        print "{$p->Key}: '{$p->Value}'\r\n";
    }
}