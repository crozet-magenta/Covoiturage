<h1>Connexion</h1>

<form method="POST" action="<?= URL::to('/Login') ?>">
    <div class="form-group">
        <label for="email" <?= $errorClass['email'] ?>>Adresse mail :</label><input type="email" name="email" id="email" placeholder="Adresse mail" required>
        <span class="error-msg"><?= $errorMsg['email'] ?></span>
    </div>
    <div class="form-group">
        <label for="password" <?= $errorClass['password'] ?>>Mot de passe :</label><input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <span class="error-msg"><?= $errorMsg['password'] ?></span>
    </div>
    <div class="form-group">
        <label for="submit"> </label><input type="submit" name="Connexion" value="Connexion">
    </div>
    
</form>