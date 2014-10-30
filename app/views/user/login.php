<h1>Connexion</h1>

<form method="POST" action="<?= URL::to('/Login') ?>">
    <span class="form-error"><?= $errorMsg['login']?></span>
    <div class="form-group">
        <label for="email">Adresse mail :</label><input type="email" name="email" id="email" placeholder="Adresse mail" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label><input type="password" name="password" id="password" placeholder="Mot de passe" required>
    </div>
    <div class="form-group">
        <label for="submit"> </label><input type="submit" name="Connexion" value="Connexion"> <a class="btn" href="<?= Url::route('UserController@resetPassword')?>">Mot de passe oublié</a>
    </div>
</form>
