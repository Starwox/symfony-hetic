# Symfony - LBC Project

## Les commandes:

Initialisation du projet: 

    composer install

CSS (Bootstrap):

    yarn install
    yarn encore dev
  
Docker SQL:

    docker-compose up -d
    
Data:

    php bin/console doc:mig:mig
    php bin/console doctrine:fixtures:load

Pour se connecter en administrateur:
    
    Email: root@gmail.com
    Mot de passe: root
