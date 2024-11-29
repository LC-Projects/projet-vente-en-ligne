# Membres
- Mathieu
- Jonathan
- Lucky

# Commandes

## Installation des dépendences
```cmd
composer install
```
Puis
```cmd
composer dump-autoload
```

## Créer des tables

Copier et coller tout le code du fichier `balance_ton_sql.sql` dans votre requête SQL afin de créer les tables utilisées dans ce projet.

Si jamais vous rencontrez une erreur de type "#1071 - Specified key was too long; max key length is 767 bytes";
Il vous suffit de remplacer la longeur des `varchar(255)`par une valeur plus petite (ex: `varchar(254)` ou `varchar(191)` selon votre version).

## Pour lancer des tests
```cmd
vendor/bin/phpunit --testdox
```