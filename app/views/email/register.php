<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Confirmation d'inscription</title>
</head>
<body>
    <div style="margin: auto;max-width: 700px; font-family:serif">
        <h1 style="text-align: center;margin: 0 auto;margin-top: 50px;">Bienvenue <?= $user ?>,</h1>
        <span style="margin-top: 25px; content: ' '; background-image : linear-gradient(to right, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 20%,rgba(100,100,100,1) 50%,rgba(0,0,0,0) 80%,rgba(0,0,0,0) 100%); display: block; height: 1px;"></span>
        <p>Vous venez de vous inscrire sur le site vroom.ovh.<br>
        Vous pouvez activer votre compte en cliquant sur le lien :</p>
        <p><a style="text-decoration:none; color:#000; font-weight:bold; font-family:sans-serif; font-size:90%" href="https://vroom.ovh/Validate/<?= $validation_code ?>">https://vroom.ovh/Validate/<?= $validation_code ?></a></p>
        <p>A bientôt sur <a style="text-decoration:none; color:#000; font-weight:bold; font-family:sans-serif; font-size:90%" href="https://vroom.ovh">vroom.ovh</a></p>
    </div>
</body>
</html>