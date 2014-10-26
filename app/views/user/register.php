<h1>Inscription</h1>

<form method="POST" action="<?= URL::to('/Register') ?>">
    <span class="form-expired"><?= $errorMsg['CSRF']?></span>
    <div class="form-group">
        <label for="surname" <?= $errorClass['surname'] ?>>Nom :</label><input type="text" name="surname" id="surname" placeholder="Nom" required>
        <span class="error-msg"><?= $errorMsg['surname'] ?></span>
    </div>
    <div class="form-group">
        <label for="name" <?= $errorClass['name'] ?>>Prénom :</label><input type="text" name="name" id="name" placeholder="prénom" required>
        <span class="error-msg"><?= $errorMsg['name'] ?></span>
    </div>
    <div class="form-group">
        <label for="email" <?= $errorClass['email'] ?>>Adresse mail :</label><input type="email" name="email" id="email" placeholder="Adresse mail" required>
        <span class="error-msg"><?= $errorMsg['email'] ?></span>
    </div>
    <div class="form-group">
        <label for="password" <?= $errorClass['password'] ?>>Mot de passe :</label><input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <span class="error-msg"><?= $errorMsg['password'] ?></span>
    </div>
    <div class="form-group">
        <label for="password_c" <?= $errorClass['password_c'] ?>>Confirmez :</label><input type="password" name="password_c" id="password_c" placeholder="Confirmation" required>
        <span class="error-msg"><?= $errorMsg['password_c'] ?></span>
    </div>
    <div class="form-group">
        <input type="hidden" name="_CSRF" id="CSRF" value="<?= APP::getCSRF() ?>">
        <label for="submit"> </label><input type="submit" name="S'inscrire" value="S'inscrire">
    </div>
    
</form>