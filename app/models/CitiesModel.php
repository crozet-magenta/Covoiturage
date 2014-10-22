<?php

/**
* model for table cities
*/
class Cities
{
    
    static public function getCompletion($search)
    {
        if (ctype_digit($search)) {
            $request = Database::$PDO->prepare('SELECT slug FROM `cities`  WHERE `zip_code` like ? ORDER BY `name` LIMIT 10');
        } else {
            $search = str_replace('-', ' ', $search);
            $search = str_replace('+', ' ', $search);
            $request = Database::$PDO->prepare('SELECT slug FROM `cities`  WHERE `name` like ? ORDER BY `name` LIMIT 10');
        }
        $request->execute([$search . '%']);
        return $request->fetchAll(PDO::FETCH_NUM);
    }

    static public function getAll()
    {
        $request = Database::$PDO->prepare('SELECT * FROM `cities` ORDER BY `name`');
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getIdBySlug($slug)
    {
        $request = Database::$PDO->prepare('SELECT id FROM `cities` WHERE slug = ?');
        $request->execute([$slug]);
        return $request->fetch(PDO::FETCH_NUM);
    }
}