<?php

/**
* model for table cities
*/
class Cities
{
    
    static public function getCompletion($search)
    {
        if (ctype_digit($search)) {
            $request = Database::$PDO->prepare('SELECT full_name, zip_code, id FROM `cities`  WHERE `zip_code` like ? ORDER BY `full_name` LIMIT 10');
        } else {
            $search = str_replace('-', ' ', $search);
            $search = str_replace('+', ' ', $search);
            $request = Database::$PDO->prepare('SELECT full_name, zip_code, id FROM `cities`  WHERE `simple_name` like ? ORDER BY `full_name` LIMIT 10');
        }
        $request->execute([$search . '%']);
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
}