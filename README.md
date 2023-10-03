# Popcorner

# TODO

- [x] Initialisation du projet Symfony
- [ ] Créations d'entités
    - [x] Entité objet "Movie"
    - [x] Entité inventaire "Library"
    - [ ] Entité utilisateur "Member"
    - [ ] Entité gallerie "Collection"
- [ ] Création des associations entre entités
    - [x] Association 1-N entre "Library" et "Movie"
    - [ ] Association 1-1 entre "Member" et "Library"
    - [ ] Assoication 1-N entre "Member" et "Collection"
    - [ ] Association N-N entre "Collection" et "Movie"
- [ ] Ajout de données tests
    - [ ] Ajout de données tests pour "Movie"
    - [ ] Ajout de données tests pour "Library"
    - [ ] Ajout de données tests pour "Member"
    - [ ] Ajout de données tests pour "Collection"
- [ ] Interface administration
    - [x] Ajout de EasyAdmin
    - [ ] Controller CRUD pour "Movie"
    - [ ] Controller CRUD pour "Library"
    - [ ] Navigation entre Library et Movie
    - [ ] Controller CRUD pour "Collection"
    - [ ] Navigation entre Collection et Movie
- [ ] Création des pages du front end
    - [ ] Consultation de toutes les Libraries
    - [ ] Consultation d'une library
    - [ ] Consultation d'un film
- [ ] Utilisation de gabarits pour les pages de consultation du front-office
	- [ ] Consultation d'un "Movie"
 	- [ ] consultation de la liste des "Movie" d'un "Library"
 	- [ ] Navigation d'une "Library" vers la consultation de ses "Movie"
- [ ] Intégration d'une mise en forme CSS avec Bootstrap dans les gabarits Twig
- [ ] Intégration de menus de navigation



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
