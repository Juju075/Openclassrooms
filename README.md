## P5_blog_MVC

Project 5 du "parcours développeur d'application PHP/Symfony" d'Openclassrooms.
Ce projet consite à la création d'un blog professionnel avec de nombreuse fonctionnalités.

Vous pouvez les retrouver ici

[Pages Visiteurs](https://github.com/Juju075/Openclassrooms/issues/83)
[Pages Administrateur](https://github.com/Juju075/Openclassrooms/issues/84).

![Symfony Insight] Lien direct [Here](https://insight.symfony.com/projects/403dd71c-1a0a-494d-a6c9-6ff6ad861691/analyses/88).

## Table des matières.

1. [Pre required](#Pré-requis)
2. [Installation](#Instalation)
3. [How to use](#How-to-use)
4. [Fait avec](#Fait-avec)
5. [Auteur](#Auteur)

## Pré requis

Environnement

- _PHP_ (7.4.12)
- _Apache_ (2.4.46)
- _MySQL_ (8.0.22)
- _Composer_ (2.0.9)

## Installation

- Get sources files / Cloner le repository du projet. [Here](https://github.com/Juju075/Openclassrooms)
  > Make sure the `www` repository, is at the root of your server, you can also create a virtual host that redirect the visitors to the `www` directory.

_Go with a console to the repository and do thoses commands_

- `composer install`
- `composer update`

- Créer la database.
- Charger le script sql dans phpmyadmin (creation de la base de données et du jeux de donees.)
- http://localhost/phpmyadmin/server_sql.php
- app_blog_mvc.sql (à la racine du projet)

## Logins

- LOGINS de demonstration

  [MEMBRE]

- login : username
- password : identique

  [ADMIN]

- login : Admin
- password : identique
- don't forget to check "administrateur" to be granted as [ADMIN_ROLE]

## fait avec

- [twig](https://twig.symfony.com/) - génerateur de template
- [codeguy/upload 1.3.2] https://github.com/brandonsavage/Upload.git - telechargement de fichier
- [phpmailer/phpmailer v6.5.1] https://github.com/PHPMailer/PHPMailer.git - sending e-mails from PHP applications

### Auteur

- **Bempime KHEVE** (https://github.com/Juju075)
