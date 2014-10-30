<?php

/**
* user controller
*/
class UserController
{
    
    public function register()
    {
        $title = 'Enregistrement';
        View::addTemplate('baseView', compact('title'));

        $err = $errMsg = array();
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $key => $value) {
                $err[$key] = 'class="has-error"';
                $errMsg[$key] = $value;
            }
            unset($_SESSION['errors']);
        }

        $errorClass = new Collection($err);
        $errorMsg = new Collection($errMsg);
        View::render('user.register', compact('errorClass', 'errorMsg'));
    }

    public function store()
    {
        Database::connect();
        unset($_SESSION['errors']);

        if ($_POST['_CSRF'] != APP::getCSRF()) {
            $_SESSION['errors']['CSRF'] = 'Le formulaire a expiré';
            Url::redirect('/Register');
        }


        if ($_POST['password'] != $_POST['password_c']) {
            $_SESSION['errors']['password_c'] = 'Les mots de passe ne correspondent pas';
        }
        if (preg_match("#.*^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $_POST['password'])) {
            $validated['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        } else {
            $_SESSION['errors']['password'] = 'Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre et avoir une longueur supérieure à 8 caractères';
        }
        if (preg_match('/^[a-zA-Z\-\ ]{2,40}$/', $_POST['name'])) {
            $validated['name'] = $_POST['name'];
        } else {
            $_SESSION['errors']['name'] = 'Le nom doit avoir 2 à 40 caractères';
        }
        if (preg_match('/^[a-zA-Z\-\ ]{2,40}$/', $_POST['surname'])) {
            $validated['surname'] = $_POST['surname'];
        } else {
            $_SESSION['errors']['surname'] = 'Le prénom doit avoir 2 à 40 caractères';
        }
        if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $validated['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if (Users::existEmail($validated['email'])) {
                $_SESSION['errors']['email'] = 'Cette adresse mail est déjà utilisée';
            }
        } else {
            $_SESSION['errors']['email'] = 'L\'adresse mail n\'est pas valide';
        }

        
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            Database::disconnect();
            Url::redirect('/Register');
        } else {
            $validated['validation_code'] = sha1(microtime(true));
            $validation_code = $validated['validation_code'];
            $user = $validated['name'];

            App::sendmail('noreply@vroom.ovh', $validated['email'], 'Confirmation d\'inscription', 'email.register', compact('user', 'validation_code'));
            Users::add($validated);
            $_SESSION['newEmail'] = $validated['email'];
            

            Database::disconnect();
            Url::redirect('/Register/Success');
        }
    }

    public function afterStore()
    {
        $email = $_SESSION['newEmail'];
        
        unset($_SESSION['newEmail']);
        $title = 'Inscription effectuée';
        View::addTemplate('baseView', compact('title'));
        view::render('user.afterStore', compact('email'));
    }

    public function validate($code)
    {
        View::addTemplate('baseView', compact('title'));
        Database::connect();
        $data = Users::validate($code);
        if ($data !== false) {
            $email = $data['email'];
            $user = $data['name'];
            App::sendMail('noreply@vroom.ovh', $email, 'Inscription validée', 'email.validate', compact('user'));
            view::render('user.validateOK');
        } else {
            View::render('user.validateFail');
        }
        Database::disconnect();
    }

    public function login()
    {
        $title = 'Connexion';
        View::addTemplate('baseView', compact('title'));
        $errMsg = array();
        if (isset($_SESSION['errors'])) {
            $errMsg['login'] = $_SESSION['errors']['login'];
            unset($_SESSION['errors']);
        }
        $errorMsg = new Collection($errMsg);
        View::render('user.login', compact('errorMsg'));
    }

    public function loginCheck()
    {
        $email = $_POST['email'];
        $pass  = $_POST['password'];
        if (!Auth::attempt($email, $pass)) {
            $_SESSION['errors']['login'] = 'La combinaison email / mot de passe n\'a pas été reconnue';
            URL::redirect('/Login');
        } else {
            Url::redirect('/');
        }
    }

    public function resetPassword()
    {

    }
}