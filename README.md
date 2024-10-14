# Excursion - Site du restaurant

Ce projet est un site web pour le restaurant **Excursion**, situé à la plage de Contis, développé avec le framework Symfony. Le site permet de gérer les produits proposés par le restaurant, notamment les catégories comme les entrées, plats, desserts et boissons, et offre un back-office pour la gestion des produits.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP >= 8.1
- Composer
- Symfony CLI
- MySQL ou un autre système de gestion de base de données compatible avec Doctrine ORM
- Node.js et npm (pour gérer les assets si nécessaire)

## Installation

1. **Clonez le dépôt :**

   ```bash
   git clone https://github.com/DimitriMaurand/restaurant.git
   cd restaurant
Installez les dépendances PHP :
composer install

Installez les dépendances JavaScript (si nécessaire) :
npm install

Configurez les variables d'environnement :
Copiez le fichier .env pour créer votre propre fichier d'environnement local :
cp .env .env.local

Modifiez le fichier .env.local pour ajouter vos informations de connexion à la base de données et autres paramètres :
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/restaurant"

Créez la base de données :

Après avoir configuré la connexion à la base de données, créez la base et exécutez les migrations :
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

Lancez le serveur de développement :

Démarrez le serveur Symfony avec la commande suivante :
symfony serve
Le site sera disponible sur http://localhost:8000.
