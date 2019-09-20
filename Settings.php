<?php

$project_env = explode(";",getenv("phpSPO"));

$settings = array(
    'TenantName' => "omnisoftory",
    'TenantId' => "ce5a8951-8195-4f16-a90a-2aa20833eac4",
	'Url' => "https://login.microsoftonline.com/ce5a8951-8195-4f16-a90a-2aa20833eac4",
    'OneDriveUrl' => "https://omnisoftory.sharepoint.com",
    'Password' => 'S0leil2019',
    'UserName' => 'thscha@omnisoftory.onmicrosoft.com',
   // 'ClientId' => "c3ef7b84-2588-4f84-bc6e-e5366eb3da47",
   // 'ClientSecret' => 'sWrGfuhjRezjYwp9z3zPwd725Tuhu1lay8hjp1TQebg=',
    'ClientId' => "3767ec97-7513-4d1e-b373-f099843fcaa4",
    'ClientSecret' => '7a4mTW:TqO9Als9X.ADsGlMTvhuM:s]7',
    'RedirectUrl' => "https://omnisoftory.sharepoint.com"
);

return $settings;







