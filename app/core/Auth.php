<?php

/**
* Authentification class
*/
class Auth
{
    /**
     * try to connect a user with given credentials
     *
     * @param string $email email to use for login attempt
     * @param string $pass  pass to use for login attempt
     *
     * @return bool result of the login attempt
     */
    static public function attempt($email, $pass)
    {
        Database::connect();
        if (!Users::existEmail($email)) return false;
        if (password_verify($pass, Users::getPassword($email))){
            $_SESSION['loggedUser'] = Users::getUser($email);
            Database::Disconnect();
            return true;
        }
        Database::Disconnect();
        return false; 
    }
}