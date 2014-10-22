<?php

/**
* search controller
*/
class SearchController
{
    
    function search($start, $end, $date)
    {
        //var_dump($start, $end, $date);
        Database::connect();

        $data   = Offers::getByCity($start, $end);

        var_dump($data);
        Database::disconnect();
    }
}