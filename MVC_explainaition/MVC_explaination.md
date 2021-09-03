# MVC / Organisation des dossiers.

## Contenu dans des dossiers.

---

# Controllers

Chaque controlleurs correspond à la gestion des fonctionnalités necessaire pour le bon fonctionnement de la page.

Controller _._ Accueil , Admin , Contact , Login , Post , Register \_.\_php

---

# Framework (custom).

Contient des classes basic reutilisable plus tard dans le code.

- _Entity.php_ |
- _Model.php_ | Fonctionnalités basic pour se connecter à la BDD et faire du repository (Reusable)
- _Routeur.php_ | Routeur pour diriger l'utilisateur selon les parametres de l'url (page&action) > vers le controllers approprié.

---

# Models

- _ENTITY_ | (Répectorie l'ensemble des entités de l'app).

- _MANAGER_ | (Contient l'ensemble des fonctionnalités de chaque entité).

---

# Public

Tous nos fichiers statiques publics. On pourra y mettre un dossier css/, images/, js/, etc.

---

# View

_C les pages rendu par les differents controlleurs._

- La class View.php est utilisé en permanence vas permettre de génerer le contenu selon les parametres de l'url.

- template.php, templateSingle.php ect... sont les pages Html qui contiendront le contenu génerer par la vue (view.php).
  chaque template est un model pour la route souhaité.

  eg: La page d'un article sera différent visuellement de la page détail d'un article.

- Admin / Contact / Form / Login / Registration permettront d'organiser les fichiers par section.

---

## Fichiers à la racine.

# .htaccess

_Permet la réecriture de l'url._ (Elle vas préfixer automatiquement le nom de la route pour forcer l'appel au routeur).

eg:
Saisie utilisateur > réecriture de l'url.

http://localhost/Blog_MVC/accueil > http://localhost/Blog_MVC/index.php?url=accueil

# index.php

## C la page d'entrée à l'app elle servira d'appel au routeur.

---

Visualisé le cheminement (resumé) des données dans le systeme. [GRAPHIC CODE](MVC_explainaition/graphic_code.png)
