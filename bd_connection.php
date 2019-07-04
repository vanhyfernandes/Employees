<?php

    /*set oracle user login and password info */
    $dbuser="";	    //Database username
    $dbpass="";	//Datadase password  
    $db="SSID";
    $connect=ocilogon($dbuser, $dbpass, $db);
    
    if (!$connect)
    {
        $response=array(
            'status' => 400,
            'status_message' => ocierror($connect)['message']
        );
        exit;
    }

?>




