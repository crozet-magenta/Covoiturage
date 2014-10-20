<?php

/**
* various tools 
*/
class ToolsController
{
    
    function autocomplete()
    {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
            header("HTTP/1.0 405 Not Allowed method");
            die();
        }
        Database::connect();
        $data = Cities::getCompletion($_GET['term']);
        Database::disconnect();

        for ($i=0; $i < sizeof($data); $i++) { 
            $cities[$i] = str_replace("\r", '', $data[$i]['full_name'] . ' (' . $data[$i]['zip_code'] . ')');
        }

        header('Content-Type: application/json');
        echo json_encode($cities);
        die();
    }
}