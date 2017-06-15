Pour installer le projet il est tout d’abord nécessaire de posséder plusieurs logiciels.
Il est nécessaire de posséder une plateforme de développement web tel que WAMP ou MAMP.
 
Les logiciels sont téléchargeables içi:
WAMP: http://www.wampserver.com/  (Windows)
MAMP: https://www.mamp.info/en/ (Windows & Mac OSx)
 
en ce qui concerne linux il est nécessaire d’installer des logiciels libres tel que Apache MySQL et PHP. Les instructions sont situés içi http://olange.developpez.com/articles/debian/installation-serveur-dedie/?page=page_2 
 
Il est également nécessaire de posséder le logiciel Composer qui est est un gestionnaire de paquets libre écrit en PHP. Pour installer composer sur les différents systèmes d'exploitation il suffit de suivre les instructions (en anglais) décrites içi https://getcomposer.org/doc/00-intro.md 
 
Et bien sûr laravel, le framework PHP, cependant ce dernier sera fourni en même temps que le projet.
 
Pour installer le projet laravel il est ensuite nécessaire qu’il vous soit fournit sous un format de fichier zip.
 
Dézippez le fichier zip dans le dossier www de votre installation de WAMP ou dans le htdocs de votre MAMP.
 
Une fois le projet dans le bon répertoire, il est nécessaire d’installer les requis de composer pour cela ouvrez l’invite de commande Windows (en tappant cmd dans la barre de recherche) ou terminal sur Mac Osx. déplacer vous jusqu’au dossier est tapez la ligne de commande suivante :
 
composer install
 
une fois le dossier vendor installer 
 
vous pouvez démarrer le serveur en faisant cette ligne de commande:
 
php artisan serve
 
Si le résultat est: “Information : impossible de trouver des fichiers pour le(s) modèle(s) spécifié(s).”, alors il faut modifier votre PATH.
 
Pour ceci sur windows il faut:
 
Ouvrez le panneau de configuration
Accédez à Système et sécurité > Système
Cliquez sur Paramètres système avancés
Dans la nouvelle fenêtre, cliquez sur le bouton Variables d'environnement...
Dans la nouvelle fenêtre, double-cliquez sur l'entrée Path du cadre Variables systèmes
Dans la nouvelle fenêtre, cliquez sur le bouton Nouveau et tapez php, puis appuyer sur la touche Enter
Sélectionnez la nouvelle entrée php puis cliquez sur Parcourir
Naviguer jusqu'au dossier où vous avez installé WAMP
Naviguez ensuite dans bin > php
Cliquez sur le dernier dossier commençant par php7.0. puis cliquez sur OK
Cliquez sur OK
Cliquez sur OK
Cliquez sur OK
 
A ce stade là votre serveur est en état de démarrer, mais il vous retournera forcément un site incomplet, car il est nécessaire d’installer la base de donnée.
 
Pour ça démarrer MAMP ou WAMP si ce n’est pas déjà fait. Une fois démarrer vous pouvez effectuer un Ctrl+C pour arrêter le serveur laravel.
 
Les configurations ont été faits de tel sorte à ce que le framework puisse installer, et peupler la base de donnée pour vous. il suffit pour ça d’effectuer quelques lignes de commandes.
 
Il ne devrait pas y avoir de problème en ce qui concerne le mapping des classes toutefois nosus allons effectuer ces premières lgnes de commandes pour s’en assuer.
 
Tout d’abord
composer dump-autoload
 
Ensuite nous allons générer une nouvelle clé d’application en faisant:
php artisan key:generate
 
Puis donnez un “boost” au framework en mettant tout ça en cache
php artisan config:cache
 
 
Une fois ces précautions prises nous pouvons enfin créer la base de données.
 
Pour cela effectuer la ligne de commande:
php artisan migrate
 
Il faut ensuite peupler la base de données en effectuant un:
php artisan db:seed
 
Une fois cela fait on peut de nouveau démarrer le framework en effectuant un
 
php artisan serve
 
Le site web est maintenant fonctionnel.
