#Mini documentation
Le code suit la structure [MVC](http://www.wikiwand.com/fr/Mod%C3%A8le-vue-contr%C3%B4leur) ce qui permet une bonne organisation du code.

##1. Le modele MVC
###1.1. Les Models
Les Models servent d'interface avec la base de donnée. Ils ne font que de la selection de données pour ensuite les retourner au Controller pour qu'elles soient traitées ou de l'insersion de données déjà validées fournies par le Controller

###1.2. Les Vues
Les vues ne contiennent aucun traitement de donnée. Elles ne font que de l'affichage à partir des données fournies par le Controller. Il n'y a donc que du HTML et un peu de code php très simple (boucles, structures conditionnelles et echo)

###1.3. Les Controllers
Le Controller gère les requêtes des utilisateurs : il attend des requêtes, vérifie leur validité, traite les données récupérées par le Model, pour finalement déléguer le processus d’affichage à la Vue.

##2. Cycle d'une requête
Le point d'entrée du site est le fichier index.php qui se trouve à la racine.
1. L'utilisateur demande une page
2. Le routeur traite l'URL demandée et appelle le controller correspondant
3. Le controller traite la requête et interagit avec le model pour récupérer ou stocker des informations dans la BDD
4. le controlleur demande le rendu de la vue en lui fournissant les données traitées
5. la vue est envoyée à l'utilisateur

##3. Conventions de codage
- un controlleur = une classe = un fichier PHP
- un model = une classe = un fichier PHP
- les fichiers de controllers ont le nom du controller suivi de 'Controller'  (`NameController.php`)
- les fichiers de models ont le nom du model suivi de 'Model' (`NameModel.php`)

##4. les classes
- **App :** La classe app inclut les fichiers nécessaires au coeur de l'application
- **Config :** La classe config permet de lire le fichier de configuration (fichier ini)
- **Request :** la classe request permet de connaitre des paramètres relatifs à la requête reçue
- **Router :** La classe router permet d'enregistrer les routes pour relier les URL aux actions de controlleurs et de générer des URL
