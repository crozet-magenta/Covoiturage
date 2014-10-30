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

    static public function validate($code)
    {
        $request = Database::$PDO->prepare("SELECT email, name from `users` WHERE  validation_code = ? AND validated = 0");
        $request->execute([$code]);
        $data = $request->fetch();
        $newCode = sha1(microtime(true));
        $request = Database::$PDO->prepare("UPDATE `users` SET `validated` = 1, validation_code = ? WHERE  email = ? AND validation_code = ?");
        $request->execute([$newCode, $data['email'], $code]);
        if ($request->rowCount() == 1) {
            return $data;
        } else {
            return false;
        }
    }

    static public function getPassword($email)
    {
        $request = Database::$PDO->prepare("SELECT password from `users` WHERE email = ?");
        $request->execute([$email]);
        return $request->fetch()['password'];
    }

    static public function getUser($email)
    {
        $request = Database::$PDO->prepare("SELECT * from `users` WHERE email = ?");
        $request->execute([$email]);
        return $request->fetch(PDO::FETCH_ASSOC);
    }
}