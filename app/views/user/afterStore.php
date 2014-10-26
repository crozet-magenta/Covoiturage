<h1>Inscription enregistrée</h1>
<p class="center-t">Un mail contenant un code de confirmation a été envoyé à l'adresse <?= $email ?>. <br>
Cliquez sur le lien contenu dans le mail pour valider votre inscripton</p>
<p class="center-t"><a href="<?= Url::route('MainController@home')?>">Accueil</a>&nbsp;•&nbsp;<a href="<?= Url::route('UserController@login')?>">Connexion</a></p>