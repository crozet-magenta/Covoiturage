<?php

/**
* users class
*/
class Users
{
    
    static public function add(array $data)
    {
        try {
            $request = Database::$PDO->prepare("INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `password`, `validation_code`, `validated`, `register_date`) 
                                                             VALUES ('', ?, ?, ?, ?, ?, ?, ?)");
            $request->execute([$data['name'],
                               $data['surname'],
                               $data['email'],
                               $data['password'],
                               $data['validation_code'],
                               0,
                               time()
                              ]);
        } catch (PDOException $e) {
            $e->getMessage();
            die();
        }
    }

    static public function existEmail($value)
    {
        $request = Database::$PDO->prepare("SELECT count(*) num from `users` WHERE  email = ?");
        $request->execute([$value]);
        $num = $request->fetch()['num'];
        return (intval($num) === 1);
    }
}