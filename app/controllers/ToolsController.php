<?php

/**
* various tools 
*/
class ToolsController
{
    /* // for datalist only 
    function autocomplete()
    {
        Database::connect();
        $data = Cities::getCompletion($_GET['term']);
        Database::disconnect();

        for ($i=0; $i < sizeof($data); $i++) { 
            echo '<option value="' . $data[$i]['full_name'] . ' (';
            echo str_pad(trim($data[$i]['zip_code']), 5, '0', STR_PAD_LEFT);
            echo ')"></option>';
        }

        die();
    }
    */

    // for jquery autocomplete
    function autocomplete()
    {
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