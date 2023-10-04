# Popcorner

# TODO

- [ ] Entités
    - [x] Création de Library
    - [x] Création de Movie
    - [ ] Création de Collection
    - [x] Création de Member
    - [x] Association entre Library et Movie
    - [x] Association entre Library et Member
    - [ ] Association entre Movie et Collection
    - [ ] Association entre Collection et Member
    - [ ] Ajout des propriétés non-essentielles des objets
- [ ] Fixtures
    - [x] Fixtures pour Library
    - [x] Fixtures pour Movie
    - [ ] Fixtures pour Collection
    - [x] Fixtures pour Member
- [ ] Interface Admin avec EasyAdmin
    - [x] CRUD Library
    - [x] CRUD Movie
    - [ ] CRUD Collection
    - [x] CRUD Member
    - [x] Navigation entre une bibliothèque et un film
    - [ ] Navigation entre une bibliothèque et une collection
    - [ ] Navigation entre une collection et un film
- [ ] Front-office
    - [x] Consultation de toutes les bibliothèques
    - [x] Consultation d'une bibliothèque
    - [x] Consultation d'un film
    - [x] Navigation entre une bibliothèque et un film et inversement
    - [x] Passage sur Twig
    - [x] Intégration de Bootstrap
    - [x] Intégration de menus de navigation
    - [ ] Consultation d'une collection
    - [ ] Navigation entre une collection et un film
    - [ ] Affichage des consultations publiques avec navigation vers les films
    - [ ] Ajout d'un film à une collection
    - [ ] Ajout d'une collection à un membre
    - [ ] Ajout d'un film à une bibliothèque
    - [ ] Création de la bibliothèque à un membre
    - [ ] Gestion de la suppression
    - [ ] Gestion de la mise en ligne d'images pour les films
    - [ ] Gestion de marque-pages/panier
- [ ] Utilisateurs
    - [ ] Création de l'entité User
    - [ ] Association entre User et Member
    - [ ] Authentification
    - [ ] Protection des routes interdites aux membres
    - [ ] Protection des données aux seuls propriétaires
    - [ ] Contextualisation du chargement des données en fonction de l'utilisateur connecté
- [ ] Utilisation des messages flash pour les CRUDs



# Entités

## Entité Member

### Propriétés
- `nickname` **`[string:255]`** : pseudo du membre
- `description` **`[text]`** : description du membre
- `role` **`[TBD]`** : role du membre
- `library` **`[relation:OneToOne]`** : bibliothèque de l'utilisateur


## Entité Library

### Propriétés
- `description` **`[text]`** : description de la bibliothèque
- `movies` **`[relation:OneToMany]`** : films contenus dans la bibliothèque de l'utilisateur
- `member` **`[relation:OneToOne]`** : utilisateur propriétaire de la bibliothèque

## Entité Movie
Un objet représentant un film que l'utilisateur a éventuellement vu

### Propriétés
- `title` **`[string:255]`** : titre officiel du film
- `year` **`[smallint]`** : année de sortie du film
- `imdbId` **`[integer]`** : identifiant du film sur la base de donnée IMDB
- `watched` **`[boolean]`** : l'utilisateur a-t-il regardé le film
- `rating` **`[smallint]`** : note de l'utilisateur sur le film
- `review` **`[text]`** : critique du film par l'utilisateur
- `library` **`[relation:ManyToOne]`** : bibliothèque dans laquelle se trouve le film


## Entité Collection
L'utilisateur peut créer des collections de ses films selon ses envies. Une collection peut être les films préférées d'un utilisateur, ou une liste de recommandations pour un genre en particulier.

### Propriétés
- `name` **`[string:255]`** : nom de la collection
- `description` **`[text]`** : description de la collection
- `private` **`[boolean]`** : visibilité de la collection


# Commandes utiles

## Symfony

- Démarrage du serveur : `symfony server:start`

## Doctrine

- Suppression de la BDD : `symfony console doctrine:database:drop`
- Création de la BDD : `symfony console doctrine:database:create`
- Création du schéma : `symfony console doctrine:schema:create`
- MAJ du schéma : `symfony console doctrine:schema:update`
- Chargement des données de test présentes dans src/DataFixtures : `symfony console doctrine:fixtures:load`

## Entité

- Création d'une entité : `symfony console make:entity`
- Création de la migration : `symfony console make:migration`
- Exécution de la migration : `symfony console doctrine:migrations:migrate`

## Controller

- Création d'un controller : `symfony console make:controller`
