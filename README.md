# Lina

Ce repo contient une application de location de robe de soirée.

## Prérequis

- Linux, MacOS ou Windows
- Bash
- PHP 8
- Composer
- symfony-CLI
- Mariadb 10
- Docker (optionnel)

## Installation

```
git clone https://github.com/Hamid-Git7/Lina
cd Lina
composer install
```

Créez une base de données et un utilisateur dédié pour cette base de données.

## Configuration

Créez un fichier `.env` à la racine du projet :

```
APP_ENV=dev
APP_DEBUG=true
APP_SECRET=249d006c80d74ceadf5cb19e9c2b5899
DATABASE_URL="mysql://Lina:123@127.0.0.1:3306/Lina?serverVersion=mariadb-10.6.12&charset=utf8mb4"
```

Pensez à changer la variable `APP_SECRET` et les codes d'accès dans la variable `DATABASE_URL`.

**ATTENTION : `APP_SECRET` doit être une chaine de caractère de 32 caractères en hexadecimal.**

## Migration et fixtures

Pour que l'application soit utilisable, vous devez créer le schéma de BDD et charger les données :

```
bin/dofilo.sh
```

## Utilisation

Lancez le serveur web de developpement

```
symfony serve
```

Puis ouvrez la page suivante : [https://localhost:8000](https://localhost:8000).

## Mentions légales

Ce projet est sous licence MIT.

La licence est disponible ici [MIT LICENCE](LICENCE).