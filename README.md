# API_Stage_Etudiant

API qui permet le suivi de stage d'étudiants en symfony


# Importation du projet

git pull https://github.com/Aimericv/API_Stage_Etudiant.git


# Ajouter les dépendances

Uniquement en environnement de dev, un bundle facilitant la création d'éléments dans Symfony

composer require symfony/maker-bundle --dev

Si vous utilisez un serveur Apache :

composer require symfony/apache-pack

Pour la base de données :

composer require doctrine/annotations

composer require orm	

composer require symfony/serializer-pack

# Installation des dépendances

composer install

# Configuration

Ajoutez vos informations dans le fichier .env

APP_ENV= 

APP_SECRET=


# Créer une entité

symfony console make:entity

# Migration

Génération de fichiers de migration :

symfony console make:migration

Application des migrations dans la base :

symfony console doctrine:migration:migrate

# Création d'un controlleur 

symfony console make:controller NomController

# Normalisation / Sérialization

composer require symfony/serializer-pack

# Ajout de données avec Postman

Exemple :

{
    "name":"aimeric",
    "firstname":"vermesse",
    "picture": "img",
    "date_of_birth": "08-10-2003",
    "grade": "eleve"
}
