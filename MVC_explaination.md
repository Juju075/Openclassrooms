# MVC / Organisation des dossiers.

--- Contenu dans des dossiers.

# Controllers

Chaque controlleurs correspond à la gestion des fonctionnalités necessaire pour le bon fonctionnement de la page.

Controller . Accueil , Admin , Contact , Login , Post , Register .php

---

# Framework (custom).

Contient des classes basic reutilisable plus tard dans le code.

- Entity.php |
- Model.php | Fonctionnalité basic pour se connecter à la BDD (Reusable)
- Routeur.php | Routeur pour diriger l'utilisateur selon les parametres de l'url (page&action) > vers le controllers approprié.

---

# Models

- ENTITY | (Répectorie l'ensemble des entités de l'app).

- MANAGER | (Contient l'ensemble des fonctionnalités de chaque entité).

---

# Public

tous nos fichiers statiques publics. On pourra y mettre à l'intérieur un dossier css/, images/, js/, etc.

---

# View

C les pages rendu par les controlleurs.

- La class View.php est utilisé en permanence vas permettre de genere le contenu selon les parametres de l'url.

- template templateSingle ect... sont les pages Html qui contiendra le contenu genrere par view.ph.
  chaque template est un model pour la route.

- Admin / Contact / Form / Login / Registration

--- Fichiers à la racine.

# .htaccess

Permet la réecriture de l'url. (Elle vas préfixer automatiquement le nom de la route pour forcer l'appel au routeur).

eg:
Saisie utilisateur > réecriture de l'url + page par defaut si erreur utilisateur.
http://localhost/Blog_MVC/accueil > http://localhost/Blog_MVC/index.php?url=accueil

# index.php

C la page d'entree à l'app elle servira d'appel au routeur.
